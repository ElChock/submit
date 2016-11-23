<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../Dao/DaoLike.php';
include_once '../Model/Likes.php';
include_once '../Model/Usuario.php';
if($_SERVER["REQUEST_METHOD"]=="POST" )
{
    if($_POST["like"]!=null)
    {
        session_start();
        $usuario = new Usuario();
        $like = new Likes();
        $s=$_SESSION["usuario"];
        $usuario= unserialize($s);
        $like->setIdPublicacion($_POST["like"]);    
        $like->setIdUsuario($usuario->getIdUsuario());
        $daoLike= new DaoLike();
        $daoLike->altalike($like);
        header('Location: ../PHP/Principal.php');
        
    }

    
}