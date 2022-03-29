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

        $date_created = getDatetimeDB();

        $nombreHc=$num_doc.'.pdf';
        $nombreHcFedateado=$num_doc.'_fedateado.pdf';
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
            'hc_path' => $nombreHc,
            'hc_path_fedateado' => $nombreHcFedateado,
            'date_created' => $date_created
        ]);
        $cod_cita = $this->request->getPost('cod_cita'); //cita
        //traer ultima insercion en table HC
        $idHistoria = $this->db->table('historia_clinica')->select('id')->orderBy('id', 'DESC')->limit(1)->get()->getResultArray();

        $qbCitas = $this->db->table('citas')->insert([
            'cod_cita' => $cod_cita,
            'idEspecialidad' => $especialidad,
            'idHistorial' => $idHistoria[0]['id']
        ]);
        
        $sello_path=base_url().'/assets/img/sello.jpg';
        $html="<table border='1' style='border-collapse: collapse; width: 100%;'>
        <thead>
            <th>DATOS DE LA HISTORIA CLÍNICA</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <span style='display:block'>N° DE HISTORIA CLÍNICA: {$num}</span>
                    <span style='display:block'>I.E.D.S: {$ieds}</span>
                </td>
            </tr>

            <tr>
                <th>
                    DATOS DEL PACIENTE
                </th>
            </tr>
            <tr>
                <td>
                    <span style='display:block'>NOMBRE COMPLETO: {$nombreCompleto}</span>
                    <span style='display:block'>APELLIDO COMPLETO: {$apellidoCompleto}</span>
                    <span style='display:block'>EDAD: {$edad}</span>
                    <span style='display:block'>SEXO: {$sexo}</span>
                    <span style='display:block'>DIRECCIÓN: {$direccion }</span>
                    <span style='display:block'>DISTRITO: {$distrito}</span>
                    <span style='display:block'>FECHA DE NACIMIENTO: {$fecha_nac}</span>
                    <span style='display:block'>TIPO DE DOCUMENTO: {$tipo_doc}</span>
                    <span style='display:block'>N° DE DOCUMENTO: {$num_doc}</span>
                    <span style='display:block'>ESTADO CIVIL: {$estado_civil}</span>
                    <span style='display:block'>OCUPACIÓN: {$ocupacion}</span>
                    <span style='display:block'>N° DE CELULAR: {$celular}</span>
                    <span style='display:block'>NOMBRE DE LA MADRE: {$nombre_madre}</span>
                    <span style='display:block'>NOMBRE DEL PADRE: {$nombre_padre}</span>
                </td>
            </tr>

            <tr>
                <th>
                    PERSONA RESPONSABLE O ACOMPAÑANTE
                </th>
            </tr>
            <tr>
                <td>
                    <span style='display:block'>NOMBRE COMPLETO: {$nombre_acomp}</span>
                    <span style='display:block'>DNI: {$dni_acomp}</span>
                    <span style='display:block'>DIRECCIÓN: {$direccion_acomp}</span>
                </td>
            </tr>
        </tbody>
        </table>
        ";

        $htmlFedateado="<table border='1' style='border-collapse: collapse; width: 100%;'>
        <thead>
            <th>DATOS DE LA HISTORIA CLÍNICA</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <span style='display:block'>N° DE HISTORIA CLÍNICA: {$num}</span>
                    <span style='display:block'>I.E.D.S: {$ieds}</span>
                </td>
            </tr>

            <tr>
                <th>
                    DATOS DEL PACIENTE
                </th>
            </tr>
            <tr>
                <td>
                    <span style='display:block'>NOMBRE COMPLETO: {$nombreCompleto}</span>
                    <span style='display:block'>APELLIDO COMPLETO: {$apellidoCompleto}</span>
                    <span style='display:block'>EDAD: {$edad}</span>
                    <span style='display:block'>SEXO: {$sexo}</span>
                    <span style='display:block'>DIRECCIÓN: {$direccion }</span>
                    <span style='display:block'>DISTRITO: {$distrito}</span>
                    <span style='display:block'>FECHA DE NACIMIENTO: {$fecha_nac}</span>
                    <span style='display:block'>TIPO DE DOCUMENTO: {$tipo_doc}</span>
                    <span style='display:block'>N° DE DOCUMENTO: {$num_doc}</span>
                    <span style='display:block'>ESTADO CIVIL: {$estado_civil}</span>
                    <span style='display:block'>OCUPACIÓN: {$ocupacion}</span>
                    <span style='display:block'>N° DE CELULAR: {$celular}</span>
                    <span style='display:block'>NOMBRE DE LA MADRE: {$nombre_madre}</span>
                    <span style='display:block'>NOMBRE DEL PADRE: {$nombre_padre}</span>
                </td>
            </tr>

            <tr>
                <th>
                    PERSONA RESPONSABLE O ACOMPAÑANTE
                </th>
            </tr>
            <tr>
                <td>
                    <span style='display:block'>NOMBRE COMPLETO: {$nombre_acomp}</span>
                    <span style='display:block'>DNI: {$dni_acomp}</span>
                    <span style='display:block'>DIRECCIÓN: {$direccion_acomp}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span style='display:block'>FECHA Y HORA: {$date_created}</span>
                </td>
            </tr>
        </tbody>
        </table>
            <div style='text-align: right; margin-top:10px'>
                <img src='{$sello_path}' style='width:100px'>
            </div>
        ";
        
    $path='uploads/historia_clinica/';
    $this->generadorPDF($html,$path,$nombreHc);

    $this->generadorPDF($htmlFedateado,$path,$nombreHcFedateado);

        if ($qbHC == 1 && $qbCitas == 1) { //return 1 -> entra al if
            echo 'ok';
        }
    }

    function generacionReporteHC()
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        //START: OJO: OPCIONES PARA PERMITIR IMAGENES EN PDF
        $options = $dompdf->getOptions();
        $options->set(array('isRemoteEnabled' => true));
        $dompdf->setOptions($options);
        //END: OJO: OPCIONES PARA PERMITIR IMAGENES EN PDF

        //new
        //$html = file_get_contents(view('Admision/formCreacionHC')); 
        //$dompdf->loadHtml('<p>holaaaaaaaaa<p>');
        ////////////////// SIEMPRE ESTUVO LA SOL -> NO ME DI CUENTA//////////////////////
        //$qb=$this->db->table('');
        $nombre="Felix";
        $html="<table border='1' style='border-collapse: collapse; width: 80%;'>
        <thead>
            <th>DATOS DE LA HISTORIA CLÍNICA</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <span style='display:block'>N° DE HISTORIA CLÍNICA: {$nombre}</span>
                    <span style='display:block'>I.E.D.S: </span>
                </td>
            </tr>


            <tr>
                <th>
                    DATOS DEL PACIENTE
                </th>
            </tr>
            <tr>
                <td>
                    <span style='display:block'>NOMBRE COMPLETO: </span>
                    <span style='display:block'>APELLIDO COMPLETO: </span>
                    <span style='display:block'>EDAD: </span>
                    <span style='display:block'>SEXO:</span>
                    <span style='display:block'>DIRECCIÓN:</span>
                    <span style='display:block'>DISTRITO:</span>
                    <span style='display:block'>FECHA DE NACIMIENTO:</span>
                    <span style='display:block'>TIPO DE DOCUMENTO:</span>
                    <span style='display:block'>N° DE DOCUMENTO:</span>
                    <span style='display:block'>ESTADO CIVIL:</span>
                    <span style='display:block'>N° DE CELULAR:</span>
                    <span style='display:block'>NOMBRE DE LA MADRE:</span>
                    <span style='display:block'>NOMBRE DEL PADRE:</span>
                </td>
            </tr>

            <tr>
                <th>
                    DATOS DEL PACIENTE
                </th>
            </tr>
            <tr>
                <td>
                    <span style='display:block'>NOMBRE COMPLETO:</span>
                    <span style='display:block'>DNI:</span>
                    <span style='display:block'>DIRECCIÓN:</span>
                </td>
            </tr>
        </tbody>
        </table>";

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $output = $dompdf->output();
        $nombre=rand();
        file_put_contents("uploads/{$nombre}.pdf", $output);

        // OJO: Salida del PDF generado al navegador
        //'Attachment'=> false ->no descargar  || true -> descargar
        //$dompdf->stream('reporteHC.pdf', array('Attachment' => true));
    }

    function generadorPDF($html,$path,$nameFile){
        $dompdf = new Dompdf();
        //START: OJO: OPCIONES PARA PERMITIR IMAGENES EN PDF
        $options = $dompdf->getOptions();
        $options->set(array('isRemoteEnabled' => true));
        $dompdf->setOptions($options);
        //END: OJO: OPCIONES PARA PERMITIR IMAGENES EN PDF
        $dompdf->loadHtml($html);
        //$dompdf->setPaper('A4', 'landscape'); //-> forma horizontal
        $dompdf->setPaper('A4', 'portrait'); //forma convencional
        $dompdf->render();
        $output = $dompdf->output();
        //file_put_contents("{$path}{$nameFile}.pdf", $output);
        file_put_contents("{$path}{$nameFile}", $output);
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
