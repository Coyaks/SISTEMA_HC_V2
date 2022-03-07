<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class DashboardController extends Controller
{
    public function index()
    {   
        //Siempre se tiene que inicializar session primero
        $session=session();
        if (isset($_SESSION['logeado'])) {
            //$this->load->view('admin/dashboard');
            return view('dashboard/index');
        } else {
            return redirect()->to(base_url('/'));
        }

    }
}
