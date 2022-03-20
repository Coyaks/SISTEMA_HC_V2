<?php 
namespace App\Models;

use CodeIgniter\Model;

class Paciente extends Model{

    protected $table='usuarios';
    // protected $primaryKey='id';
    protected $allowedFields=['tipo_doc','num_doc','nombre','apellidos','email','celular','fijo','direccion','distrito','idRol','idArea','estado'];

    public function tablaDB(){
        $builder=$this->db->table($this->table);
        return $builder;
    }

    public function buscarPacienteCodigo(){
		$id=$_SESSION['idUsuario'];
		$sql="SELECT * FROM usuarios u JOIN
        solicitud_hc s ON
        u.id=s.idUsuario where s.idUsuario=$id ORDER by s.created_at DESC limit 1";

        $qb=$this->db->query($sql)->getResult();   
        //$qb->getResult();
        return $qb;
	}

}