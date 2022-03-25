<?php

namespace App\Controllers;

use App\Models\Mesapartes;

class MedicoController extends BaseController
{
    //inicilizar session en ci4
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('Medico/medico');
    }
    //BANDEJAAAAAA
    function fetch_all(){
        // Mi primer query builder  JOIN:)
        //Fetch area de user actual
        $idAreaUser=$_SESSION['idArea'];
        $idRol=$_SESSION['idRol'];

        $qb=$this->db->table('historia_clinica h');
        $qb->select('c.id,h.idUsuario, h.nombres_comp,h.apellidos_comp,h.edad,c.datetime_creacion,h.num,c.anotacion_enfermera,c.anotacion_medico,c.etapa,c.idEspecialidad');
        $qb->join('citas c','h.id = c.idHistorial');
        if($idRol!=1){
            $qb->where('c.etapa',2);
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
                'anotacion_medico'=>$row['anotacion_medico'],
                'created_at'=>humanDatetime($row['datetime_creacion']),
                'etapa'=>$etapa,
                //'estado'=>$estado,
                'options'=>$options
            ];

            $output[]=$sub_array;
        }

        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }


    function saveAnotaciones(){
        $anotaciones=$this->request->getPost('anotaciones');
        $etapa2=$this->request->getPost('etapa2');
        $hidden_id=$this->request->getPost('hidden_id');

        //idCita
        if($etapa2!=0){
            $qb=$this->db->table('citas')->where('id',$hidden_id)->update([
                'anotacion_medico'=>$anotaciones,
                'etapa'=>3
            ]);
        }else{
            $qb=$this->db->table('citas')->where('id',$hidden_id)->update([
                'anotacion_medico'=>$anotaciones,
            ]);
        }
        
        // Si la consulta esta bien -> te retorna un 1 -> true |||| sino retorna 0
        $output='';
        if($qb){
            //echo 'ok';
            $output=[
                'rta'=>'ok',
                'etapa'=>$etapa2 //si etapa es 1 desaparece
            ];
        }
        echo json_encode($output);
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
