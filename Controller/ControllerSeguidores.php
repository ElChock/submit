<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../Model/Usuario.php';
include_once '../Model/Seguidor.php';
include_once '../Dao/DaoSeguidor.php';
if(!empty($_POST["idSeguir"]))
{
    session_start();
    $usuario= new Usuario();
    $s=$_SESSION["usuario"];
    $usuario = unserialize($s);
    $seguidor= new Seguidor();
    $daoSeguidor= new DaoSeguidor();
    
    $seguidor->setIdUsuario($usuario->getIdUsuario());
    $seguidor->setIdUsuarioSeguidor($_POST["idSeguir"]);
    $daoSeguidor->AltaSeguidor($seguidor);
    header('Location: ../PHP/Perfil.php?id='.$_POST["idSeguir"]);
    
}