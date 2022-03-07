<?php 
namespace App\Models;

use CodeIgniter\Model;

class Usuario extends Model{

    protected $table='usuarios';
    // protected $primaryKey='id';
    protected $allowedFields=['nombre','apellidos','email','password','idRol','estado','created_at','updated_at'];

    public function tablaDB(){
        $builder=$this->db->table($this->table);
        return $builder;
    }

    public function acciones(){
		$action_button = function($row){
			
			return '
			<div class="text-center">

				<button type="button" name="edit" class="btn btn-warning btn-sm edit" data-id="'.$row['id'].'" title="Editar"><i class="fas fa-edit"></i></button>

				<button type="button" class="btn btn-danger btn-sm delete" data-id="'.$row['id'].'" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
			</div> ';
		};

		return $action_button;
	}

	public function fetchRoles(){
		//$data=$this->db->table($this->table);
		$sql=$this->db->query("SELECT id,nombre FROM roles");
		return $sql->getResult();
	}
	public function fetchAreas(){
		$sql=$this->db->query("SELECT id,nombre FROM areas");
		return $sql->getResult();
	}

	public function fetchModulos(){
		//Utilizando query builder
		// $builder=$this->db->table('modulos')->get();
		$sql=$this->db->query("SELECT id,titulo FROM modulos");
		return $sql->getResult();
	}

}