<?php

namespace App\Controllers;

use App\Models\Admision;

//llamar libreria Dompdf 
use Dompdf\Dompdf;

//require base_url().'/vendor/autoload.php';
//require __DIR__.'/vendor/autoload.php';
//use Spipu\Html2Pdf\Html2Pdf;
//ini_set('memory_limit', '-1');

class AdmisionController extends BaseController
{
    //inicilizar session en ci4
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('Admision/admision');
    }
    public function index2()
    {
        return view('Admision/formCreacionHC');
    }
    public function fetchEspecialidad()
    {
        $qb = $this->db->table('areas')->get()->getResultArray();
        echo json_encode($qb);
    }

    function saveDatosSolicitud()
    {
        $crudModel = new Admision();
        $apellidoCompleto = $this->request->getVar('ape_paterno') . " " . $this->request->getVar('ape_materno');

        $dni_path = $_FILES['dni_path'];

        $ruta = "uploads/pacientes/";

        $new_name_dni = '';
        if ($dni_path['name'] != '') {
            $new_name_dni = upload_file_directorio($dni_path, $ruta);
        }

        $num_doc = $this->request->getVar('num_doc');

        $datos_solicitud_update = [
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
        $idMe = $_SESSION['idUsuario'];
        $crudModel->update($idMe, $datos_solicitud_update);

        //insertar en tabla solicitud de Hc
        $datos_solicitud = [
            'email' => $this->request->getVar('email'),
            'celular'       =>  $this->request->getVar('celular'),
            'fijo'       =>  $this->request->getVar('fijo'),
            'direccion'       =>  $this->request->getVar('direccion'),
            'distrito'       =>  $this->request->getVar('distrito'),
            'sustento'       =>  $this->request->getVar('sustento'),
            'dni_path'    =>  $new_name_dni,
            'idUsuario'    =>  $_SESSION['idUsuario']

        ];
        $qb = $this->db->table('solicitud_hc');
        $qb->insert($datos_solicitud);

        $output = [
            'rta' => 'ok',
            'dni' => $num_doc,
        ];
        //echo "ok";
        echo json_encode($output);
    }

    function fetchDatosAdmision()
    {
        $userMe = $_SESSION['idUsuario'];
        $qb = $this->db->table('usuarios');
        $qb->where('id', $userMe);
        $data = $qb->get()->getResultArray();
        echo json_encode($data);
    }

    public function verificarStock()
    {
        $idEspecialidad = $this->request->getPost('especialidadSelect');

        $qb = $this->db->table('areas')->where('id', $idEspecialidad)->get()->getResultArray();
        echo json_encode($qb);
    }
    // CLICK GUARDAR CITA
    function restarStock()
    {
        $idEspecialidad = $this->request->getPost('idEspecialidad');
        $numAtencionActual = $this->request->getPost('numAtencionActual'); //10
        //update area
        $qb = $this->db->table('areas')->where('id', $idEspecialidad)->update([
            'num_atencion' => $numAtencionActual - 1
        ]);
        echo "ok";
    }

    // GUARDAR CREACION DE CITA
    function saveHC()
    {
        //capturar datos de front
        $num = $this->request->getPost('num');
        $ieds = $this->request->getPost('ieds');

        $especialidad = $this->request->getPost('idEspecialidadHiden');
        $nombreCompleto = $this->request->getPost('nombreCompleto');
        $apellidoCompleto = $this->request->getPost('apellidoCompleto');
        $edad = $this->request->getPost('edad');
        $sexo = $this->request->getPost('sexo');
        $direccion = $this->request->getPost('direccion');
        $distrito = $this->request->getPost('distrito');
        $fecha_nac = $this->request->getPost('fecha_nac');
        $tipo_doc = $this->request->getPost('tipo_doc');
        $num_doc = $this->request->getPost('num_doc');
        $estado_civil = $this->request->getPost('estado_civil');
        $ocupacion = $this->request->getPost('ocupacion');
        $celular = $this->request->getPost('celular');
        $nombre_madre = $this->request->getPost('nombre_madre');
        $nombre_padre = $this->request->getPost('nombre_padre');
        $nombre_acomp = $this->request->getPost('nombre_acomp');
        $dni_acomp = $this->request->getPost('dni_acomp');
        $direccion_acomp = $this->request->getPost('direccion_acomp');


        $ruta='uploads/admision/';
        
        $admision_path=$_FILES['pdfAdmision'];

        //Esta validacion es obligatorio
        $new_name_admision='';
        if($admision_path['name']!=''){
            //Recién almaceno img en carpeta
            $new_name_admision=upload_file_directorio($admision_path,$ruta);
        }

        $qbHC = $this->db->table('historia_clinica')->insert([
            'num' => $num,
            'ieds' => $ieds,
            'nombres_comp' => $nombreCompleto,
            'apellidos_comp' => $apellidoCompleto,
            'edad' => $edad,
            'sexo' => $sexo,
            'direccion' => $direccion,
            'distrito' => $distrito,
            'fecha_nac' => $fecha_nac,
            'tipo_doc' => $tipo_doc,
            'num_doc' => $num_doc,
            'estado_civil' => $estado_civil,
            'ocupacion' => $ocupacion,
            'estado_civil' => $estado_civil,
            'celular' => $celular,
            'nombre_madre' => $nombre_madre,
            'nombre_padre' => $nombre_padre,
            'nombre_acomp' => $nombre_acomp,
            'dni_acomp' => $dni_acomp,
            'dir_acomp' => $direccion_acomp,
            'hc_path' => $new_name_admision,
        ]);

        $cod_cita = $this->request->getPost('cod_cita'); //cita

        //traer ultima insercion en table HC
        $idHistoria = $this->db->table('historia_clinica')->select('id')->orderBy('id', 'DESC')->limit(1)->get()->getResultArray();

        $qbCitas = $this->db->table('citas')->insert([
            'cod_cita' => $cod_cita,
            'idEspecialidad' => $especialidad,
            'idHistorial' => $idHistoria[0]['id']
        ]);


        if ($qbHC == 1 && $qbCitas == 1) { //return 1 -> entra al if
            echo 'ok';
        }
    }

    function generacionReporteHC()
    {
        //$num=$this->request->getPost('num')
        // $dompdf = new Dompdf();
        // $dompdf->loadHtml('hello world');

        // // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');

        // // Render the HTML as PDF
        // $dompdf->render();

        // // Output the generated PDF to Browser
        // $dompdf->stream('reporteHC.pdf', array('Attachment' => true));
        // exit;
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        //ob_start();
        //CONTENIDO
        //require 'formCreacionHC.php';

        //START: OJO: OPCIONES PARA PERMITIR IMAGENES EN PDF
        $options = $dompdf->getOptions();
        $options->set(array('isRemoteEnabled' => true));
        $dompdf->setOptions($options);
        //END: OJO: OPCIONES PARA PERMITIR IMAGENES EN PDF

        //new
        //$html = file_get_contents(view('Admision/formCreacionHC')); 
        //$dompdf->loadHtml('<p>holaaaaaaaaa<p>');
        $dompdf->loadHtml(view('Admision/admision'));

        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        //$output = $dompdf->output();

        $output = $dompdf->output();

        // PODEMOS LA RUTA Y EL NOMBRE DEL PDF
        file_put_contents('uploads/holitas2.pdf', $output);

        // OJO: Salida del PDF generado al navegador
        //'Attachment'=> false ->no descargar  || true -> descargar
        //$dompdf->stream('reporteHC.pdf', array('Attachment' => true));
    }

    function movePDF()
    {
        $nameFile = rand();

        $filePDF = $_FILES['file']['tmp_name'];
        $path = 'uploads/pacientes/';
        move_uploaded_file($filePDF, $path.$nameFile . '.pdf');
    }

    function subirAdmisionPDF(){
        //$ob=new Setting();
        
        

        echo 'ok';
    }

}
