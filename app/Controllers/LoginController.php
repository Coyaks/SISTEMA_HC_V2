<?php

namespace App\Controllers;

use App\Models\Login;

class LoginController extends BaseController
{
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

        if (count($resultadoUsuario) > 0) {//usuario existe en la DB
            $passwordDB = $resultadoUsuario[0]['password'];
            if ($password == $passwordDB) {
                //crear sesión 
                $dataSession = [
                    'idUsuario' => $resultadoUsuario[0]['id'],
                    'nombreApellidos' => $resultadoUsuario[0]['nombre'] . ' ' . $resultadoUsuario[0]['apellidos'],
                    'email' => $resultadoUsuario[0]['email'],
                    'idRol' => $resultadoUsuario[0]['idRol'],
                    'logeado'  => true
                ];
                // $session = session();
                // $session->set($dataSession);
                session()->set($dataSession);
                $msg_salida = 'ok';
            } else {
                $msg_salida = 'Password incorrecto!';
            }
        } else {
            $msg_salida = 'Email no existe!';
        }
        echo $msg_salida;
    }

    public function register(){
        $user=new Login();
        $user->save([
            'nombre'      =>  $this->request->getVar('nombre'),
            'apellidos'      =>  $this->request->getVar('apellidos'),
            'email'       =>  $this->request->getVar('email'),
            'password'    =>  $this->request->getVar('password')
        ]);
        //$message = 'Registrado Correctamente!';
        $message = '<div class="alert alert-success" role="alert">
                    Registrado Correctamente!
                    </div>';

        $output=[
            'rta'=>'ok',
            'message'=>$message
        ];
        echo json_encode($output);
    }

    public function logout()
    {
        //inicializar nuevamente la session y destruirla
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }
}
