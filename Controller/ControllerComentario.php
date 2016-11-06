<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../Model/Comentario.php';
include_once '../Dao/DaoComentario.php';

if(!empty($_POST["comentar"]))
{
    $comentario = new Comentario();
    $daoComentario= new DaoComentario();
    if(!empty($_POST["comentario"]))
    {
        $comentario->setComentario($_POST["comentario"]);
    }
    
    if(!empty($_POST["idPublicacion"]))
    {
        $comentario->setIdPublicacion($_POST["idPublicacion"]);
    }
    if(!empty($_POST["comentario"]))
    {
        $comentario->setComentario($_POST["comentario"]);
    }
    session_start();
    $usuario= new Usuario();
    $s=$_SESSION["usuario"];
    $usuario= unserialize($s);  
    $comentario->setIdUsuario($usuario->getIdUsuario());
    $daoComentario->AltaComentario($comentario);
    header('Location: ../PHP/Principal.php');
}