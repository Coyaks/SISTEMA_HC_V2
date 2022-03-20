<?php

namespace App\Controllers;

use App\Models\Paciente;

class PacienteController extends BaseController
{
    //inicilizar session en ci4
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('Paciente/paciente');
    }
    public function solicitud_copia_hc()
    {
        return view('Paciente/solicitud_copia_hc');
    }
    public function visualizacion_copia_hc()
    {
        return view('Paciente/visualizacion_copia_hc');
    }

    function fetch_all()
    {
        // Mi primer query builder  JOIN:)
        $qb = $this->db->table('usuarios u');
        $qb->select('u.id, u.nombre, u.apellidos, u.email, u.password, r.nombre as idRol, u.estado');
        $qb->join('roles r', 'u.idRol = r.id');
        $data = $qb->get()->getResultArray();
        $output = array();
        foreach ($data as $row) {

            $estado = '';
            if ($row['estado'] == 1) { //activo
                $estado = '<span class="badge badge-success">Activo</span>';
            } else {
                $estado = '<span class="badge badge-danger">Inactivo</span>';
            }

            $options = '<div class="text-center">
            <button type="button" name="edit" class="btn btn-warning btn-sm edit" data-id="' . $row['id'] . '" title="Editar"><i class="fas fa-edit"></i></button>

            <button type="button" class="btn btn-danger btn-sm delete" data-id="' . $row['id'] . '" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
            </div>';

            $sub_array = [
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'apellidos' => $row['apellidos'],
                'email' => $row['email'],
                'idRol' => $row['idRol'],
                'estado' => $estado,
                'options' => $options
            ];

            $output[] = $sub_array;
        }

        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    function action()
    {
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
                if ($this->request->getVar('action') == 'Add') { //Agregar
                    $crudModel = new Paciente();
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

                if ($this->request->getVar('action') == 'Edit') { //Editar
                    $crudModel = new Paciente();

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


    function saveDatosSolicitud()
    {
        $crudModel = new Paciente();
        $apellidoCompleto=$this->request->getVar('ape_paterno')." ".$this->request->getVar('ape_materno');

        $dni_path=$_FILES['dni_path'];

        $ruta="uploads/pacientes/";
        
        $new_name_dni='';
        if($dni_path['name']!=''){
            $new_name_dni=upload_file_directorio($dni_path,$ruta);
        }

        $num_doc=$this->request->getVar('num_doc');

        $datos_solicitud_update=[
            //'nombre'      =>  $this->request->getVar('nombre'),
           // 'apellidos'      =>  $apellidoCompleto,
            //'tipo_doc'      =>  $this->request->getVar('tipo_doc'),
            //'num_doc'      =>  $this->request->getVar('num_doc'),
            //'email'       =>  $this->request->getVar('email'),
            'celular'       =>  $this->request->getVar('celular'),
            'fijo'       =>  $this->request->getVar('fijo'),
            'direccion'       =>  $this->request->getVar('direccion'),
            'distrito'       =>  $this->request->getVar('distrito')
        ];
        $idMe=$_SESSION['idUsuario'];
        $crudModel->update($idMe,$datos_solicitud_update);

        //insertar en tabla solicitud de Hc
        $datos_solicitud=[
            'email'=>$this->request->getVar('email'),
            'celular'       =>  $this->request->getVar('celular'),
            'fijo'       =>  $this->request->getVar('fijo'),
            'direccion'       =>  $this->request->getVar('direccion'),
            'distrito'       =>  $this->request->getVar('distrito'),
            'sustento'       =>  $this->request->getVar('sustento'),
            'dni_path'    =>  $new_name_dni,
            'idUsuario'    =>  $_SESSION['idUsuario']

        ];
        $qb=$this->db->table('solicitud_hc');   
        $qb->insert($datos_solicitud);
        
        $output=[
            'rta'=>'ok',
            'dni'=>$num_doc,
        ];
        //echo "ok";
        echo json_encode($output);
    }

    // function fetchDatosPaciente(){
    //     $userMe=$_SESSION['idUsuario'];
    //     $qb=$this->db->table('usuarios');
    //     $qb->where('id',$userMe);
    //     $data=$qb->get()->getResultArray();
    //     echo json_encode($data);
    // }

    function fetchDatosPaciente(){
        $userMe=$_SESSION['idUsuario'];
        $qb=$this->db->table('historia_clinica');
        $qb->where('idUsuario',$userMe);
        $data=$qb->get()->getResultArray();
        dep($data);
        exit;
        echo json_encode($data);
    }
    function buscarPacienteCodigo(){
        $ob=new Paciente();
        $data=$ob->buscarPacienteCodigo();

        echo json_encode($data);
    }
    
}
