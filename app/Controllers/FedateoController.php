<?php

namespace App\Controllers;

use App\Models\Fedateo;

class FedateoController extends BaseController
{
    //inicilizar session en ci4
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('Fedateo/fedateo');
    }
    
    //BANDEJAAAAAA
    function fetch_all(){
        // Mi primer query builder  JOIN:)
        $qb=$this->db->table('usuarios u');
        $qb->select('s.id,u.nombre, u.apellidos, u.email,u.num_doc, u.celular, u.fijo, u.direccion, u.distrito, s.sustento,s.dni_path,s.created_at,s.estado_mesa,s.estado_fedateo');
        $qb->join('solicitud_hc s','u.id = s.idUsuario');
        $qb->where('s.estado_mesa',1);
        $data=$qb->get()->getResultArray();

        $output=array();

        $base_path=base_url('uploads/pacientes/');
        foreach($data as $row){
            
            $estado_fedateo='';
            if($row['estado_fedateo']==-1){//pendiente
                $estado_fedateo='<span class="badge badge-warning">Pendiente</span>';
            }else if($row['estado_fedateo']==0){
                $estado_fedateo='<span class="badge badge-danger">Desaprobado</span>';
            }else if($row['estado_fedateo']==1){
                $estado_fedateo='<span class="badge badge-success">Aprobado</span>';
            }

            //id -> solicitud
            $options='<div class="text-center">
            <button type="button" name="edit" class="btn btn-warning btn-sm edit" data-id="'.$row['id'].'" title="Editar"><i class="fas fa-edit"></i></button>
            
            </div>';

            $ver_dni='';
            if($row['dni_path']!=''){
                $ver_dni='<a href="'.$base_path.'/'.$row['dni_path'].'" target="_blank">Ver DNI</a>';
            }
            

            $sub_array=[
                'id'=>$row['id'],
                'nombre'=>$row['nombre'],
                'apellidos'=>$row['apellidos'],
                'num_doc'=>$row['num_doc'].'&nbsp&nbsp&nbsp'.$ver_dni,
                // 'password'=>$row['password'],
                'created_at'=>humanDatetime($row['created_at']),
                'estado_fedateo'=>$estado_fedateo,
                //'estado'=>$estado,
                'options'=>$options
            ];

            $output[]=$sub_array;
        }

        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    function fetch_single_data(){
        if ($this->request->getVar('id')) {
            $crudModel = new Fedateo();
            $data = $crudModel->where('id', $this->request->getVar('id'))->first();
            echo json_encode($data);
        }
    }


    function saveDatosSolicitud()
    {
        $crudModel = new Fedateo();
        $apellidoCompleto=$this->request->getVar('ape_paterno')." ".$this->request->getVar('ape_materno');

        $dni_path=$_FILES['dni_path'];

        $ruta="uploads/pacientes/";
        
        $new_name_dni='';
        if($dni_path['name']!=''){
            $new_name_dni=upload_file_directorio($dni_path,$ruta);
        }

        $num_doc=$this->request->getVar('num_doc');

        $datos_solicitud_update=[
            //'nombre'      =>  $this->request->getVar('nombre'),
           // 'apellidos'      =>  $apellidoCompleto,
            //'tipo_doc'      =>  $this->request->getVar('tipo_doc'),
            //'num_doc'      =>  $this->request->getVar('num_doc'),
            //'email'       =>  $this->request->getVar('email'),
            'celular'       =>  $this->request->getVar('celular'),
            'fijo'       =>  $this->request->getVar('fijo'),
            'direccion'       =>  $this->request->getVar('direccion'),
            'distrito'       =>  $this->request->getVar('distrito')
        ];
        $idMe=$_SESSION['idUsuario'];
        $crudModel->update($idMe,$datos_solicitud_update);

        //insertar en tabla solicitud de Hc
        $datos_solicitud=[
            'email'=>$this->request->getVar('email'),
            'celular'       =>  $this->request->getVar('celular'),
            'fijo'       =>  $this->request->getVar('fijo'),
            'direccion'       =>  $this->request->getVar('direccion'),
            'distrito'       =>  $this->request->getVar('distrito'),
            'sustento'       =>  $this->request->getVar('sustento'),
            'dni_path'    =>  $new_name_dni,
            'idUsuario'    =>  $_SESSION['idUsuario']

        ];
        $qb=$this->db->table('solicitud_hc');   
        $qb->insert($datos_solicitud);
        
        $output=[
            'rta'=>'ok',
            'dni'=>$num_doc,
        ];
        //echo "ok";
        echo json_encode($output);
    }

    function fetchDatosFedateo(){
        $userMe=$_SESSION['idUsuario'];
        $qb=$this->db->table('usuarios');
        $qb->where('id',$userMe);
        $data=$qb->get()->getResultArray();
        echo json_encode($data);
    }
    function updateFedateo(){
        $estado_fedateo=$this->request->getPost('estado_fedateo');
        // $observacion=$this->request->getPost('observacion');
        $id=$this->request->getPost('hidden_id'); //ID de solicitud

        $qb=$this->db->table('solicitud_hc');
        $qb->where('id',$id);
        $qb->update([
            'estado_fedateo'=>$estado_fedateo,
        ]);

        echo 'ok';
        
    }
    
}
