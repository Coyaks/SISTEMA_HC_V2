<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class FiltroSessionUser implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        //Evitar que se ingrese a una ruta sin haber iniciado session con session()
        // if(isset($_SESSION['idUsuario'])==false){
        //     //usuario no es admin
        //     return redirect()->to(base_url('/'));
        // }
        
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        
    }
}