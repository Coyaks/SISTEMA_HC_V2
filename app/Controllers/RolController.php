<?php

namespace App\Controllers;

use App\Models\Rol;

use monken\TablesIgniter;

class RolController extends BaseController{

    public function index(){
        return view('Rol/rol');
    }

    function fetch_all(){
        $crudModel = new Rol();
        $data_table = new TablesIgniter();

        $data_table->setTable($crudModel->getTablaDB())
            ->setDefaultOrder("id", "DESC") //Order by DESC
            ->setSearch(["id","nombre","descripcion", "estado"])
            ->setOrder(["id", "nombre","descripcion","estado"])
            ->setOutput(["id", "nombre","descripcion", $crudModel->estado(), $crudModel->acciones()]);
        return $data_table->getDatatable();
    }

    function action(){
        if ($this->request->getVar('action')) {
            helper(['form', 'url']);
            $nombre_error = '';
            $descripcion_error = '';
            $estado_error = '';
            $error = 'no';
            $success = 'no';
            $message = '';
            // validate: Metodo de validacion propio de CI4
            //OJO: $error_bool return "TRUE" si todos los campos son CORRECTOS !!
            $error_bool = $this->validate(
                [
                    'nombre'    =>    'required',
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
            } else {
                //NO HAY ERROR
                $success = 'yes';
                if ($this->request->getVar('action') == 'Add') {//Agregar
                    $crudModel = new Rol();
                    // ========== INSERT INTO NOMBRE DE TABLA========== 
                    $crudModel->save([
                        'nombre'      =>  $this->request->getVar('nombre'),
                        'descripcion'      =>  $this->request->getVar('descripcion'),
                        'estado'    =>  $this->request->getVar('estado'),
                    ]);
                    $message = 'Guardado Correctamente!';
                }

                if ($this->request->getVar('action') == 'Edit') {//Editar
                    $crudModel = new Rol();

                    $id = $this->request->getVar('hidden_id');
                    $data = [
                        'nombre'      =>  $this->request->getVar('nombre'),
                        'descripcion'      =>  $this->request->getVar('descripcion'),
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
                'descripcion_error'    =>    $descripcion_error,

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
            $crudModel = new Rol();
            $data = $crudModel->where('id', $this->request->getVar('id'))->first();
            echo json_encode($data);
        }
    }

    function delete(){
        if ($this->request->getVar('id')) {
            $id = $this->request->getVar('id');
            $crudModel = new Rol();
            // DELETE -> METODOS DE CODEIGNITER TIPO ORM 
            $crudModel->where('id', $id)->delete($id);
            echo 1;
        }
    }
}
