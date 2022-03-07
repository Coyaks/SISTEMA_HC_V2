<?php 
namespace App\Models;

use CodeIgniter\Model;

class Test extends Model{

    protected $table='roles';
    // protected $primaryKey='id';
	// "$allowedFields" -> que campos quiero que se inserten y actualicen
    protected $allowedFields=['nombre','descripcion','estado'];

    public function selectDB(){
		//Ojo en el modelo tambien puedes hacer poner Querys en crudModel
		// $sql='select * from roles' -> el metodo adecuado es 'query()'

		//Examples ->   $sql="Select * from my_table where 1";    
    	//				$query = $this->db->query($SQL);
    	//				return $query->result_array();
        //$builder=$this->db->table($this->table);

		//APRENDE POR FAVOR ESTE ES CLAVE
		$sql="SELECT * FROM roles";
		$rta=$this->db->query($sql);
		return $rta->getResult(); //retorna un array
    }

	function getTable(){
		//$builder=$this->db->table($this->table);
		$builder=$this->db->query("SELECT * FROM roles");
        return $builder->getResult();
	}
}