<?php 
namespace App\Models;

use CodeIgniter\Model;

class Admision extends Model{

    protected $table='usuarios';
    // protected $primaryKey='id';
    protected $allowedFields=['tipo_doc','num_doc','nombre','apellidos','email','celular','fijo','direccion','distrito','idRol','idArea','estado'];

}