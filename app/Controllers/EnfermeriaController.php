<?php

namespace App\Controllers;

use App\Models\Mesapartes;

class EnfermeriaController extends BaseController
{
    //inicilizar session en ci4
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('Enfermeria/enfermeria');
    }
   
    //BANDEJAAAAAA
    function fetch_all(){
        // Mi primer query builder  JOIN:)
        //Fetch area de user actual
        $idAreaUser=$_SESSION['idArea'];
        $idRol=$_SESSION['idRol'];

        $qb=$this->db->table('historia_clinica h');
        $qb->select('c.id,h.idUsuario, h.nombres_comp,h.apellidos_comp,h.edad,c.datetime_creacion,h.num,c.anotacion_enfermera,c.etapa,c.idEspecialidad');
        $qb->join('citas c','h.id = c.idHistorial');
        if($idRol!=1){
            $qb->where('c.etapa',1);
            $qb->where('c.idEspecialidad',$idAreaUser);
        }
        
        $data=$qb->get()->getResultArray();

        $output=array();
        foreach($data as $row){
            
            $etapa='';
            if($row['etapa']==1){//pendiente
                $etapa='<span class="badge badge-warning">Etapa 1</span>';
            }else if($row['etapa']==2){
                $etapa='<span class="badge badge-primary">Etapa 2</span>';
            }else if($row['etapa']==3){
                $etapa='<span class="badge badge-success">Etapa 3</span>';
            }

            //id -> solicitud
            $options='<div class="text-center">
            <button type="button" name="edit" class="btn btn-warning btn-sm edit" data-id="'.$row['id'].'" title="Editar"><i class="fas fa-edit"></i></button>
            </div>';

            

            $sub_array=[
                'id'=>$row['id'],
                'nombre'=>$row['nombres_comp'],
                'apellidos'=>$row['apellidos_comp'],
                'edad'=>$row['edad'],
                'num'=>$row['num'],
                'anotacion_enfermera'=>$row['anotacion_enfermera'],
                'created_at'=>humanDatetime($row['datetime_creacion']),
                'etapa'=>$etapa,
                //'estado'=>$estado,
                'options'=>$options
            ];

            $output[]=$sub_array;
        }

        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    function fetch_single_data(){
        if ($this->request->getVar('id')) {
            $crudModel = new Mesapartes();
            $data = $crudModel->where('id', $this->request->getVar('id'))->first();
            echo json_encode($data);
        }
    }

    function action()
    {
        if ($this->request->getVar('action')) {
            helper(['form', 'url']);
            $nombre_error = '';
            $apellidos_error = '';
            $email_error = '';
            $password_error = '';
            $rol_error = '';
            $error = 'no';
            $success = 'no';
            $message = '';
            // validate: Metodo de validacion propio de CI4
            //OJO: $error_bool return "TRUE" si todos los campos son CORRECTOS !!
            $error_bool = $this->validate(
                [
                    'nombre'    =>    'required',
                    'email'    =>    'required|valid_email',
                    'password' =>    'required',
                    'rol' =>    'required',
                ],
                [   // Errors Custom
                    'nombre' => [
                        'required' => 'El nombre es obligatorio',
                        //'min_length'=> 'Muy corto'
                    ]
                ]
            );
            // !$error_bool //hay un error en la validacion
            if ($error_bool == false) {
                $error = 'yes';
                $validation = \Config\Services::validation();

                if ($validation->getError('nombre')) {
                    $nombre_error = $validation->getError('nombre');
                }

                if ($validation->getError('email')) {
                    $email_error = $validation->getError('email');
                }

                if ($validation->getError('password')) {
                    $password_error = $validation->getError('password');
                }
                if ($validation->getError('rol')) {
                    $rol_error = $validation->getError('rol');
                }
            } else {
                //NO HAY ERROR
                $success = 'yes';
                if ($this->request->getVar('action') == 'Add') { //Agregar
                    $crudModel = new Mesapartes();
                    // ========== INSERT INTO NOMBRE DE TABLA========== 
                    $crudModel->save([
                        'nombre'      =>  $this->request->getVar('nombre'),
                        'apellidos'      =>  $this->request->getVar('apellidos'),
                        'email'       =>  $this->request->getVar('email'),
                        'password'    =>  $this->request->getVar('password'),
                        'idRol'    =>  $this->request->getVar('rol'),
                        'estado'    =>  $this->request->getVar('estado'),
                    ]);
                    $message = 'Guardado Correctamente!';
                }

                if ($this->request->getVar('action') == 'Edit') { //Editar
                    $crudModel = new Mesapartes();

                    $id = $this->request->getVar('hidden_id');
                    $data = [
                        'nombre'      =>  $this->request->getVar('nombre'),
                        'apellidos'      =>  $this->request->getVar('apellidos'),
                        'email'     =>  $this->request->getVar('email'),
                        'password'    =>  $this->request->getVar('password'),
                        'idRol'    =>  $this->request->getVar('rol'),
                        'estado'    =>  $this->request->getVar('estado'),
                        'updated_at'    =>  getDatetimeDB(),
                    ];
                    // ========= UPDATE USUARIO ========= 
                    $crudModel->update($id, $data);
                    $message = 'Actualizado Correctamente!';
                }
            }

            //data salida -> Array
            $data = array(
                'nombre_error'    =>    $nombre_error,
                'apellidos_error'    =>    $apellidos_error,
                'email_error'    =>    $email_error,
                'password_error'    =>    $password_error,
                'rol_error'    =>    $rol_error,

                'error'            =>    $error,
                'success'        =>    $success,
                'message'        =>    $message
            );
            //Array -> JSON
            echo json_encode($data);
        }
    }


    function saveDatosSolicitud()
    {
        $crudModel = new Mesapartes();
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

    function fetchDatosMesapartes(){
        $userMe=$_SESSION['idUsuario'];
        $qb=$this->db->table('usuarios');
        $qb->where('id',$userMe);
        $data=$qb->get()->getResultArray();
        echo json_encode($data);
    }
    function updateMesa(){
        $estado_mesa=$this->request->getPost('estado_mesa');
        $observacion=$this->request->getPost('observacion');
        $id=$this->request->getPost('hidden_id'); //ID de solicitud

        $qb=$this->db->table('solicitud_hc');
        $qb->where('id',$id);
        $qb->update([
            'estado_mesa'=>$estado_mesa,
            'observacion'=>$observacion
        ]);

        echo 'ok';
        
    }
    
}
