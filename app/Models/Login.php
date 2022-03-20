<?php 
namespace App\Models;

use CodeIgniter\Model;

class Login extends Model{
    protected $table = 'usuarios';
    //protected $primaryKey='id';
    protected $allowedFields=['nombre','apellidos','email','password','tipo_doc','num_doc','idRol','estado']; 
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    public function buscarUsuarioPorEmail($email){
        $builder=$this->db->table($this->table)->where('email',$email);
        return $builder->get()->getResultArray();
    }
}