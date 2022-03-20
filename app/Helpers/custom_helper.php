<?php

function humanDatetime($datetime)
{ //2022-02-25 02:10:26 ->25/02/2022 02:10:26
    $datetime = date_create($datetime);
    return date_format($datetime, "d/m/Y H:i:s");
}

function getDatetimeDB()
{
    // Set the new timezone
    date_default_timezone_set('America/Lima');
    $date = date('Y-m-d h:i:s');
    return $date;
}

function getDateDB(){
    date_default_timezone_set('America/Lima');
    $date = date('Y-m-d');
    return $date; //2022-02-25 now()
}

function getHumanDatetime()
{ //2022-02-25 02:10:26 ->25/02/2022 02:10:26
    $datetimeDB = getDatetimeDB();
    return humanDatetime($datetimeDB);
}

function getDateSinGuion(){
    $date=getDateDB();
    $new_date="";
    for($i=0;$i<strlen($date);$i++){
        if($date[$i]!='-'){
            $new_date.=$date[$i];
        }
    }
    return $new_date;
}
function dep($data)
{
    $format  = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    return $format;
}

function media($path = "")
{
    return base_url('assets/' . $path);
}

function upload_file_directorio($file,$ruta){
    if($file){
        $extension=explode('.',$file['name']);
        //$new_name=getDateSinGuion().'_'.rand().'.'.$extension[1];
        $new_name=getDateSinGuion().'_'.rand().'.'.$extension[1];
        $destination=$ruta.$new_name;
        //ENVIAR FILE A LA CARPETA
        move_uploaded_file($file['tmp_name'],$destination);
        return $new_name; //RETURN NEW_NOMBRE DE FILE PARA -> GUARDARLO EN DB
    }
}



