<?php

namespace App\Controllers;

use App\Models\Login;

class LoginController extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('login/login');
    }
    public function login()
    {
        /**
         * OJO -> $_POST['email'] (Es tradicional) | new forma en ci4 ->$this->request->getVar('email');
         * getVar('') = $_REQUEST[''] 
         * getPost('') = $_POST['']
         * get('') = $_POST['']
         */

        //capturar email y password
        $email = trim($this->request->getPost('email'));
        $password = trim($this->request->getPost('password'));
        //verificar si credenciales existen en la DB
        $login = new Login();
        //$resultadoUsuario ->te devuelve un array (registro) con todos los DATOS del usuario
        $resultadoUsuario = $login->buscarUsuarioPorEmail($email);
        // si existe el email en la DB
        $msg_salida = '';

        if (count($resultadoUsuario) > 0) { //usuario existe en la DB
            $passwordDB = $resultadoUsuario[0]['password'];
            if ($password == $passwordDB) {
                //crear sesión 
                $dataSession = [
                    'idUsuario' => $resultadoUsuario[0]['id'],
                    'nombreApellidos' => $resultadoUsuario[0]['nombre'] . ' ' . $resultadoUsuario[0]['apellidos'],
                    'email' => $resultadoUsuario[0]['email'],
                    'idRol' => $resultadoUsuario[0]['idRol'],
                    'idArea' => $resultadoUsuario[0]['idArea'],
                    'logeado'  => true
                ];
                // $session = session();
                // $session->set($dataSession);
                session()->set($dataSession);
                //$msg_salida = 'ok';
                if ($resultadoUsuario[0]['idRol'] == 1) { //admin
                    $msg_salida = 'admin';
                } else if ($resultadoUsuario[0]['idRol'] == 8) {
                    $msg_salida = 'paciente';
                } else if ($resultadoUsuario[0]['idRol'] == 7) {
                    $msg_salida = 'mesa';
                } else if ($resultadoUsuario[0]['idRol'] == 4) {
                    $msg_salida = 'fedateo';
                } else if ($resultadoUsuario[0]['idRol'] == 2) {
                    $msg_salida = 'admision';
                } else if ($resultadoUsuario[0]['idRol'] == 6) {
                    $msg_salida = 'enfermeria';
                } else if ($resultadoUsuario[0]['idRol'] == 5) {
                    $msg_salida = 'medico';
                }
            } else {
                $msg_salida = 'Password incorrecto!';
            }
        } else {
            $msg_salida = 'Email no existe!';
        }
        echo $msg_salida;
    }

    public function register()
    {
        $user = new Login();
        $email = $this->request->getVar('email');
        $rta = '';
        if ($this->emailExists($email) == false) { //No existe
            $rta = 'ok';
            $user->save([
                'nombre'      =>  $this->request->getVar('nombre'),
                'apellidos'      =>  $this->request->getVar('apellidos'),
                'email'       =>  $email,
                'password'    =>  $this->request->getVar('password'),
                'password'    =>  $this->request->getVar('password'),
                'tipo_doc'    =>  $this->request->getVar('tipo_doc'),
                'num_doc'    =>  $this->request->getVar('num_doc'),
                //perfil como paciente
                'idRol'    =>  8,
                'estado'    =>  1
            ]);

            $datosUser = $this->db->table('usuarios')->select('id,num_doc')->orderBy('id', 'DESC')->limit(1)->get()->getResultArray();
            $idUser = $datosUser[0]['id'];
            $dniUser = $datosUser[0]['num_doc'];

            //update tabla HC
            //$updateIdPaciente=$this->db->table('historia_clinica')->where('num_doc',$dniUser)->update('idUsuario',$idUser);
            $updateIdPaciente = $this->db->table('historia_clinica')->where('num_doc', $dniUser)->update([
                'idUsuario' => $idUser
            ]);

        } else {
            $rta = 'emailExists';
        }

        //$message = 'Registrado Correctamente!';
        $message = '<div class="alert alert-success" role="alert">
                    Registrado Correctamente!
                    </div>';


        $output = [
            'rta' => $rta,
            'message' => $message
        ];
        echo json_encode($output);
    }

    function emailExists($email)
    {
        $qb = $this->db->table('usuarios')->where('email', $email)->get()->getResultArray();
        //$qb=$this->db->getLastQuery();
        $emailExists = false;
        if (sizeof($qb) > 0) { //email existe
            $emailExists = true;
        }
        return $emailExists;
    }

    public function logout()
    {
        //inicializar nuevamente la session y destruirla
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }

    public function verificarNunHc()
    {
        $num_hc = $this->request->getPost('num_hc');
        $qb = $this->db->table('historia_clinica')->where('num', $num_hc)->get()->getResultArray();
        $rta = '';
        if (!empty($qb)) { //existe
            $rta = "ok";
            echo json_encode($qb);
        } else {
            echo json_encode('');
        }
    }
}
