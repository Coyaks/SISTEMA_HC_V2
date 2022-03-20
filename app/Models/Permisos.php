<?php 
namespace App\Models;

use CodeIgniter\Model;

class Permisos extends Model{
	// public function __construct(){
	// 	$this->db = \Config\Database::connect();
	// }

    protected $table='permisos';
    protected $primaryKey='id';
	// "$allowedFields" -> que campos quiero que se inserten y actualicen
    protected $allowedFields=['idRol','idModulo','c','r','u','d'];

}