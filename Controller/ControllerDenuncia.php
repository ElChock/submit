<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../Model/Denuncia.php';
include_once '../Dao/DaoDenuncia.php';
include_once '../Model/Usuario.php';
include_once '../Model/V_publicacion.php';
include_once '../Model/Bloqueado.php';
include_once '../Dao/DaoBloqueado.php';
if($_SERVER["REQUEST_METHOD"]=="GET" )
{
    if(!empty($_GET["idPublicacion"]))
    {
        session_start();
        $s=$_SESSION["usuario"];
        $usuario=  unserialize($s);
        $denuncia= new Denuncia();
        $daoDenuncia= new DaoDenuncia();
        $idPublicacion= $_GET["idPublicacion"];
        $idUsuario=$_GET["idUsuario"];
        $denuncia->setIdPublicacion($idPublicacion);
        $denuncia->setIdUsuario($idUsuario);
        $daoDenuncia->AltaDenuncia($denuncia);
        
        header('Location: ../PHP/Principal.php');
    }
    
    if(!empty($_GET["denuncia"]))
    {
          $daoDenuncia = new DaoDenuncia();
          $listPublicacion = $daoDenuncia->BuscarDenuncia();
          echo json_encode($listPublicacion);            
    }
    
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(!empty($_POST["rechazar"]))
    {
        if($_POST["rechazar"]=="Rechazar")
        {
            $daoDenuncia= new DaoDenuncia();
            $denuncia= new Denuncia();
            $denuncia->setIdUsuario($_POST["idUsuario"]);
            $denuncia->setIdPublicacion($_POST["idPublicacion"]);
            $daoDenuncia->BajaDenuncia($denuncia);
            header('Location: ../PHP/Administrador.php');
        }
    }
    if(!empty($_POST["bloquear"]))
    {
        if($_POST["bloquear"]=="Bloquear")
        {
            
            $daoBloqueado= new DaoBloqueado();
            $bloqueado= new Bloqueado();
            $bloqueado->setIdRazon($_POST["razon"]);
            $bloqueado->setIdUsuario($_POST["idUsuario"]);
            $bloqueado->setFecha($_POST["fecha"]);
            $bloqueado->setPermanente($_POST["permanente"]);
            $bloqueado->setDescripcion($_POST["comentario"]);
            $daoBloqueado->altaBloqueo($bloqueado);           
        }
    }
}

