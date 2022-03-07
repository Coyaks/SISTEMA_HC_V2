<?php

namespace App\Controllers;

use App\Models\Usuario;

use monken\TablesIgniter;

class UsuarioController extends BaseController{

    public function index(){
        $arrayRoles=$this->fetchRoles();
        return view('Usuario/usuario',$arrayRoles);
    }

    function fetch_all(){
        $crudModel = new Usuario();

        $data_table = new TablesIgniter();

        $data_table->setTable($crudModel->tablaDB())
            ->setDefaultOrder("id", "DESC") //Order by DESC
            ->setSearch(["nombre","apellidos", "email", "password"])
            ->setOrder(["id", "nombre","apellidos","email", "password"])
            ->setOutput(["id", "nombre","apellidos", "email", "password", $crudModel->acciones()]);
        return $data_table->getDatatable();
    }

    function action(){
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
                if ($this->request->getVar('action') == 'Add') {//Agregar
                    $crudModel = new Usuario();
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

                if ($this->request->getVar('action') == 'Edit') {//Editar
                    $crudModel = new Usuario();

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

    function fetch_single_data(){
        if ($this->request->getVar('id')) {
            $crudModel = new Usuario();
            $data = $crudModel->where('id', $this->request->getVar('id'))->first();
            echo json_encode($data);
        }
    }

    function delete(){
        if ($this->request->getVar('id')) {
            $id = $this->request->getVar('id');
            $crudModel = new Usuario();
            // DELETE -> METODOS DE CODEIGNITER TIPO ORM 
            $crudModel->where('id', $id)->delete($id);
            echo 1;
        }
    }

    //FETCH ROLES USANDO SIN AJAX
    function fetchRoles(){
		$user=new Usuario();
        $datos=$user->fetchRoles();
        $output=[
            'roles'=>$datos
        ];
        return $output;
	}
    

    //FETCH ROLES USANDO AJAX
    function fetchRoles2(){
		$user=new Usuario();
        $datos=$user->fetchRoles();
        echo json_encode($datos);
	}

    function fetchAreas(){
		$user=new Usuario();
        $datos=$user->fetchAreas();
        echo json_encode($datos);
	}

    function fetchModulos(){
		$user=new Usuario();
        $datos=$user->fetchModulos();
        echo json_encode($datos);
	}
}
