<?php

namespace App\Controllers;

use App\Models\Test;

use monken\TablesIgniter;

class TestController extends BaseController{

    public function index(){
        //PASAMOS DATOS DEL CONTROLLER A LA VIEW
        $ob=new Test();
        $datos=$ob->selectDB();

        $datosTabla=$ob->getTable();
        //===enviar en array asociativo===
        $data=[
            'datos'=>$datos,
            'datos2'=>$datosTabla,
            
        ];

        return view('Test/test',$data);
    }

    function fetch_all(){
        $crudModel = new Test();
    }

}
