<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../Model/Publicacion.php';
include_once '../Model/Usuario.php';
include_once '../Dao/DaoPublicacion.php';
if(!empty($_POST["publicar"]))
{
    $publicacion = new Publicacion();
    if(!empty($_POST["titulo"]))
        {
            $publicacion->setTitulo($_POST["titulo"]);
        }
        if(!empty($_FILES["archivo"]))
        {
            if($file["archivo"]["error"])
            {
                echo $_FILES["archivo"]["error"];
            }
            $finfo= new finfo(FILEINFO_MIME_TYPE);
            $ext;
            if(false===$ext=array_search($finfo->  file($_FILES["archivo"]["tmp_name"]),
                    array(
                        'jpg'=>'image/jpeg',
                        'png'=>'image/png',
                        'gif'=>'image/gif',
                        'avi'=>'video/msvideo',
                        'mp4'=>'video/mp4'
                        ),true))
            {}
            $tmp_name=$_FILES["archivo"]["tmp_name"];
            $path="../Multimedia/".time().".$ext";
            move_uploaded_file($tmp_name,$path);
            $publicacion->setPath($path);
            $publicacion->setTipoContenido($ext);
        }
        if(!empty($_POST["descripcion"]))
        {
            $publicacion->setDescripcion($_POST["descripcion"]);
        }
        session_start();
        $usuario= new Usuario();
        $s=$_SESSION["usuario"];
        $usuario= unserialize($s); 
        $publicacion->setIdUsuario($usuario->getIdUsuario());
        $daopublcicacion = new DaoPublicacion();
        $daopublcicacion->altaPublicacion($publicacion); 
        header('Location: ../PHP/Principal.php');
        
}

if($_SERVER["REQUEST_METHOD"]=="GET" && !empty($_GET["borrar"]))
{
    $daoPublicacion= new DaoPublicacion();   
    $daoPublicacion->EliminarPublicacion($_GET["borrar"]);
    header('Location: ../PHP/Principal.php');
}

