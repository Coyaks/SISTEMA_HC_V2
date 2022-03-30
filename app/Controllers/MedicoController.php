<?php

namespace App\Controllers;

//llamar libreria Dompdf 
use Dompdf\Dompdf;

class MedicoController extends BaseController
{
    //inicilizar session en ci4
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('Medico/medico');
    }
    //BANDEJAAAAAA
    function fetch_all()
    {
        // Mi primer query builder  JOIN:)
        //Fetch area de user actual
        $idAreaUser = $_SESSION['idArea'];
        $idRol = $_SESSION['idRol'];

        $qb = $this->db->table('historia_clinica h');
        $qb->select('c.id,h.idUsuario, h.nombres_comp,h.apellidos_comp,h.edad,c.datetime_creacion,h.num,c.anotacion_enfermera,c.anotacion_medico,c.etapa,c.idEspecialidad');
        $qb->join('citas c', 'h.id = c.idHistorial');
        if ($idRol != 1) {
            $qb->where('c.etapa', 2);
            $qb->where('c.idEspecialidad', $idAreaUser);
        }

        $data = $qb->get()->getResultArray();

        $output = array();
        foreach ($data as $row) {

            $etapa = '';
            if ($row['etapa'] == 1) { //pendiente
                $etapa = '<span class="badge badge-warning">Etapa 1</span>';
            } else if ($row['etapa'] == 2) {
                $etapa = '<span class="badge badge-primary">Etapa 2</span>';
            } else if ($row['etapa'] == 3) {
                $etapa = '<span class="badge badge-success">Etapa 3</span>';
            }

            //id -> solicitud
            $options = '<div class="text-center">
            <button type="button" name="edit" class="btn btn-warning btn-sm edit" data-id="' . $row['id'] . '" title="Editar"><i class="fas fa-edit"></i></button>
            </div>';

            $sub_array = [
                'id' => $row['id'],
                'nombre' => $row['nombres_comp'],
                'apellidos' => $row['apellidos_comp'],
                'edad' => $row['edad'],
                'num' => $row['num'],
                'anotacion_enfermera' => $row['anotacion_enfermera'],
                'anotacion_medico' => $row['anotacion_medico'],
                'created_at' => humanDatetime($row['datetime_creacion']),
                'etapa' => $etapa,
                //'estado'=>$estado,
                'options' => $options
            ];

            $output[] = $sub_array;
        }

        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    function fetch_single_data()
    {
        $idCita = $this->request->getPost('id');

        $qb = $this->db->table('historia_clinica h');
        $qb->select('c.id,h.idUsuario, h.nombres_comp,h.apellidos_comp,h.edad,c.datetime_creacion,h.num,c.anotacion_enfermera,c.anotacion_medico,c.etapa,c.idEspecialidad');
        $qb->join('citas c', 'h.id = c.idHistorial');
        $qb->where('c.id', $idCita);
        $data=$qb->get()->getResultArray();
        echo json_encode($data);
        
    }

    //ANOTACIONES MEDICOOOO
    function saveAnotaciones()
    {
        
        $etapa2 = $this->request->getPost('etapa2');
        $hidden_id = $this->request->getPost('hidden_id');
        $idCita = $hidden_id;

        //data de paciente
        $nombrePaciente = $this->request->getPost('nombrePaciente');
        $apellidosPaciente = $this->request->getPost('apellidosPaciente');
        $cod_hc = $this->request->getPost('cod_hc');
        $anotacionesEnfermera = $this->request->getPost('anotacionesEnfermera');
        $anotaciones = $this->request->getPost('anotaciones');
        $fechaHora = $this->request->getPost('fechaHora');

        //get idEspecialidad
        $idEspe = $this->db->table('citas')->select('idEspecialidad')->where('id',$idCita)->get()->getResultArray();
        $idEspe = $idEspe[0]['idEspecialidad'];

        $nombreEspe = $this->db->table('areas')->select('nombre')->where('id',$idEspe)->get()->getResultArray();
        $nombreEspe=$nombreEspe[0]['nombre'];
        

        $sello_path=base_url().'/assets/img/sello.jpg';

        $htmlFedateado="
        <h2>ATENCIÓN DEL PACIENTE</h2>
        <table border='1' style='border-collapse: collapse; width: 100%;'>
        <thead>
            <th>DATOS DEL PACIENTE</th>
        </thead>
        <tbody>

            <tr>
                <td>
                    <span style='display:block'>NOMBRE: {$nombrePaciente}</span>
                    <span style='display:block'>APELLIDOS: {$apellidosPaciente}</span>
                </td>
            </tr>

            <tr>
                <th>
                    ESPECIALIDAD
                </th>
            </tr>
            <tr>
                <td>
                    <span style='display:block'>ESPECIALIDAD: {$nombreEspe}</span>
                </td>
            </tr>
            <tr>
                <th>
                    ANOTACIONES DE ENFERMERA
                </th>
            </tr>
            <tr>
                <td style='height:120px'>
                    <span style='display:block'>{$anotacionesEnfermera}</span>
                </td>
            </tr>

            <tr>
                <th>
                ANOTACIONES DE MÉDICO
                </th>
            </tr>
            <tr>
                <td style='height:120px'>
                    <span style='display:block'>{$anotaciones}</span>
                </td>
            </tr>

            <tr>
            <td>
                <span style='display:block'>FECHA DE CITA: {$fechaHora}</span>
            </td>
        </tr>
        </tbody>
        </table>
            <div style='text-align: right; margin-top:10px'>
                <img src='{$sello_path}' style='width:100px'>
            </div>
        ";
        //GENEAR PDFs DE Citas
        $path='uploads/citas/';
        $nameFile=$cod_hc.'_cita.pdf';


        if ($etapa2 != 0) {
            $qb = $this->db->table('citas')->where('id', $hidden_id)->update([
                'anotacion_medico' => $anotaciones,
                'etapa' => 3,
                'cita_path'=>$nameFile
            ]);

            $this->generadorPDF($htmlFedateado,$path,$nameFile);
        } else {
            $qb = $this->db->table('citas')->where('id', $hidden_id)->update([
                'anotacion_medico' => $anotaciones,
            ]);
        }

        
        // Si la consulta esta bien -> te retorna un 1 -> true |||| sino retorna 0
        $output = '';
        if ($qb) {
            //echo 'ok';
            $output = [
                'rta' => 'ok',
                'etapa' => $etapa2 //si etapa es 1 desaparece
            ];
        }
        //GENEAR PDFs DE Citas
        echo json_encode($output);
    }

    function generadorPDF($html,$path,$nameFile){
        $dompdf = new Dompdf();
        //START: OJO: OPCIONES PARA PERMITIR IMAGENES EN PDF
        $options = $dompdf->getOptions();
        $options->set(array('isRemoteEnabled' => true));
        $dompdf->setOptions($options);
        //END: OJO: OPCIONES PARA PERMITIR IMAGENES EN PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $output = $dompdf->output();
        //file_put_contents("{$path}{$nameFile}.pdf", $output);
        file_put_contents("{$path}{$nameFile}", $output);
    }

}
