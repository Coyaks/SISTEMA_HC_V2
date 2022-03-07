<?php 
namespace App\Models;

use CodeIgniter\Model;

class Rol extends Model{

    protected $table='roles';
    // protected $primaryKey='id';
	// "$allowedFields" -> que campos quiero que se inserten y actualicen
    protected $allowedFields=['nombre','descripcion','estado'];

    public function getTablaDB(){
        $builder=$this->db->table($this->table);
        return $builder;
    }

    public function acciones(){
		//onclick="fntPermisos(6)"
		$action_button = function($row){
			return '
			<div class="text-center">
				<button type="button" name="edit" class="btn btn-warning btn-sm edit" data-id="'.$row['id'].'" title="Editar"><i class="fas fa-edit"></i></button>

				<button type="button" class="btn btn-danger btn-sm delete" data-id="'.$row['id'].'" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
			</div> ';
		};

		return $action_button;
	}
	//Estado en badge
	public function estado(){
		$estado = function($row){
			$rta="";	
			if($row['estado']==1){
				$rta='<span class="badge badge-success">Activo</span>';
			}else{
				$rta='<span class="badge badge-danger">Inactivo</span>';
			}

			return $rta;
		};

		return $estado;
	}

}