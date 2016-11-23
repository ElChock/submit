<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../Dao/DaoUsuario.php';
include_once '../Model/Usuario.php';
if(!empty($_POST["datosPersonales"]))
{
    $usuario = new Usuario();
    $daoUsuario= new DaoUsuario();
    session_start();
    $s=$_SESSION["usuario"];
    $usuario=  unserialize($s);
            
    if(!empty($_POST["descripcion"]))
    {
        $usuario->setDescripcion($_POST["descripcion"]);
    }
    if(!empty($_POST["nombre"]))
    {
        $usuario->setNombre($_POST["nombre"]);
    }
    if(!empty($_POST["apellidoPaterno"]))
    {
        $usuario->setApellidoPaterno($_POST["apellidoPaterno"]);
    }
    if(!empty($_POST["apellidoMaterno"]))
    {
        $usuario->setApellidoMaterno($_POST["apellidoMaterno"]);
    }
    if(!empty($_POST["municipio"]))
    {
        $usuario->setMunicipio($_POST["municipio"]);
    }
    if(!empty($_POST["estado"]))
    {
        $usuario->setEstado($_POST["estado"]);
    }   
    $daoUsuario->ActualizarUsuario($usuario);
    $s=serialize($usuario);
    $_SESSION["usuario"]=$s;
    header('Location: ../PHP/DatosPersonales.php');
    
}

if(!empty($_POST["fotoPortada"]))
{
    session_start();
    $usuario = new Usuario();
    $daoUsuario = new DaoUsuario();
    $s=$_SESSION["usuario"];
    $usuario=  unserialize($s);
    $imagen=$_FILES["portada"]["tmp_name"];
    $foto=$daoUsuario->ActualizarFotoPortada($usuario->getIdUsuario(),$imagen);
    $usuario->setFotoPortada($foto);    
    $s2=serialize($usuario);
    session_unset();
    $_SESSION["usuario"]=$s2;
    header('Location: ../PHP/DatosPersonales.php');
    
}

if(!empty($_POST["fotoPerfil"]))
{
    session_start();
    $usuario = new Usuario();
    $daoUsuario = new DaoUsuario();
    $s=$_SESSION["usuario"];
    $usuario=  unserialize($s);
    $imagen=$_FILES["perfil"]["tmp_name"];
    $usuario->setFotoPerfil($daoUsuario->ActualizarFotoPerfil($usuario->getIdUsuario(),$imagen));
    $s=serialize($usuario);
    $_SESSION["usuario"]=$s;
    header('Location: ../PHP/DatosPersonales.php');
}

if(!empty($_POST["publico"]))
{
    
    session_start();
    $daoUsuario = new DaoUsuario();
    $usuario = new Usuario();
    $s=$_SESSION["usuario"];
    $usuario=  unserialize($s);
    $usuario->setPublico($_POST["Perfil"]);
    $daoUsuario->ActualizarUsuario($usuario);
    echo $usuario->getPublico();
    header('Location: ../PHP/DatosPersonales.php');
    
            
}