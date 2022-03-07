<?php

namespace App\Controllers;

use App\Models\Permisos;

class PermisosController extends BaseController
{
    //public $db;
    public function __construct()
    {
        //instancia de la Clase "Query Builder"
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $permiso = new Permisos();
        // enviar al cliente como un array es obligatorio
        $datos['permisos'] = $permiso->orderBy('id', 'ASC')->findAll();
        return view('Permisos/permisos', $datos);
    }

    function fetch_all(){
        $valor_buscado = $this->request->getPost('search')['value'];
        
        $table_map = [
            0 => 'id',
            1 => 'idRol',
            2 => 'idModulo',
            3 => 'r',
            4 => 'c',
            5 => 'u',
            6 => 'd',
        ];


        $sql_count = "SELECT count(id) as total FROM permisos";
        // ==== MI CONSULTA SQL DB ==== 
        // ==== MI CONSULTA SQL DB ==== 
        $sql_data = "SELECT p.id, r.nombre as idRol, m.titulo as idModulo, p.r, p.c, p.u, p.d 
        FROM permisos p join roles r 
        ON p.idRol=r.id JOIN modulos m 
        ON p.idModulo=m.id";
        
        $condition = "";

        //BUSQUEDAS
        if (!empty($valor_buscado)) {
            foreach ($table_map as $key => $val) {
                if ($table_map[$key] === 'r.nombre') {
                    $condition .= " WHERE " .$val . " LIKE '%" . $valor_buscado . "%'";
                } else {
                    $condition .= " OR " . $val . " LIKE '%" . $valor_buscado . "%'";
                }
            }
        }
        $sql_count = $sql_count . $condition;
        $sql_data = $sql_data . $condition;

        $total_count = $this->db->query($sql_count)->getRow(); //return un object

        $sql_data .= " ORDER BY ". $table_map[$this->request->getPost('order')[0]['column']]."
        ".$this->request->getPost('order')[0]['dir']." LIMIT ".$this->request->getPost('start').",
        ".$this->request->getPost('length'). "";
        // ===== LA CONSULTA FINAL ESTA EN '$sql_data' ===== 
        $result = $this->db->query($sql_data)->getResult(); //return array
        $data = array();

        foreach($result as $row){
            $sub_array = array();
            $sub_array[] = $row->id;
            $sub_array[] = $row->idRol;
            $sub_array[] = $row->idModulo;
            if($row->r==1){
                $sub_array[] = '<h4><i class="fas fa-check-circle text-success"></i></h4>';
            }else{
                $sub_array[] = '<h4><i class="fas fa-times text-danger"></i></h4>';
            }

            if($row->c==1){
                $sub_array[] = '<h4><i class="fas fa-check-circle text-success"></i></h4>';
            }else{
                $sub_array[] = '<h4><i class="fas fa-times text-danger"></i></h4>';
            }

            if($row->u==1){
                $sub_array[] = '<h4><i class="fas fa-check-circle text-success"></i></h4>';
            }else{
                $sub_array[] = '<h4><i class="fas fa-times text-danger"></i></h4>';
            }
            if($row->d==1){
                $sub_array[] = '<h4><i class="fas fa-check-circle text-success"></i></h4>';
            }else{
                $sub_array[] = '<h4><i class="fas fa-times text-danger"></i></h4>';
            }
            
            //Aquí puedes agregar más columnas 
            $sub_array[] = '<div class="text-center">
                            <button type="button" name="edit" class="btn btn-warning btn-sm edit" data-id="'.$row->id.'" title="Editar"><i class="fas fa-edit"></i></button>

                            <button type="button" class="btn btn-danger btn-sm delete" data-id="'.$row->id.'" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                            </div>';

            $data[] = $sub_array;
        }

        $json_data = [
            'draw' => intVal($this->request->getPost('draw')),
            'recordsTotal' => $total_count->total,
            'recordsFiltered' => $total_count->total,
            'data' => $data,
            'debug_query'=>$sql_data
        ];
        //FINAL: Enviar datos de tabla al view para pintarlos
        echo json_encode($json_data);
    }

    function action()
    {
        if ($this->request->getVar('action')) {
            helper(['form', 'url']);
            $rol_error = '';
            $error = 'no';
            $success = 'no';
            $message = '';
            //OJO: $error_bool return "TRUE" si todos los campos son CORRECTOS !!
            // lo que viene del name es 'rol'
            $error_bool = $this->validate(
                [
                    'rol'    =>    'required'
                ]
            );
            // !$error_bool //hay un error en la validacion
            if ($error_bool == false) {
                $error = 'yes';
                $validation = \Config\Services::validation();

                if ($validation->getError('rol')) {
                    $rol_error = $validation->getError('rol');
                }
            } else {
                //NO HAY ERROR
                $success = 'yes';
                if ($this->request->getVar('action') == 'Add') { //Agregar
                    $crudModel = new Permisos();
                    // ========== INSERT INTO NOMBRE DE TABLA==========
                    $crudModel->save([
                        'idRol'      =>  $this->request->getVar('rol'),
                        'idModulo'      =>  $this->request->getVar('modulo'),
                        'c'    =>  $this->request->getVar('c'),
                        'r'    =>  $this->request->getVar('r'),
                        'u'    =>  $this->request->getVar('u'),
                        'd'    =>  $this->request->getVar('d')
                    ]);
                    $message = 'Guardado Correctamente!';
                }

                if ($this->request->getVar('action') == 'Edit') { //Editar
                    $crudModel = new Permisos();

                    $id = $this->request->getVar('hidden_id');
                    $data = [
                        'idRol'         =>  $this->request->getVar('rol'),
                        'idModulo'      =>  $this->request->getVar('modulo'),
                        'c'    =>  $this->request->getVar('c'),
                        'r'    =>  $this->request->getVar('r'),
                        'u'    =>  $this->request->getVar('u'),
                        'd'    =>  $this->request->getVar('d')
                    ];
                    // ========= UPDATE USUARIO =========
                    $crudModel->update($id, $data);
                    $message = 'Actualizado Correctamente!';
                }
            }

            //data salida -> Array
            $data = array(
                'rol_error'    =>    $rol_error,
                'error'            =>    $error,
                'success'        =>    $success,
                'message'        =>    $message
            );
            //Array -> JSON
            echo json_encode($data);
        }
    }

    function fetch_single_data()
    {
        if ($this->request->getVar('id')) {
            $crudModel = new Permisos();
            $data = $crudModel->where('id', $this->request->getVar('id'))->first();
            echo json_encode($data);
        }
    }

    function delete()
    {
        if ($this->request->getVar('id')) {
            $id = $this->request->getVar('id');
            $crudModel = new Permisos();
            // DELETE -> METODOS DE CODEIGNITER TIPO ORM
            $crudModel->where('id', $id)->delete($id);
            echo 1;
        }
    }
}
