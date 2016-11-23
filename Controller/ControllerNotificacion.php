<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerNotificacion
 *
 * @author Ayrton
 */
include_once '../Dao/DaoNotificacion.php';
include_once '../Model/Usuario.php';

{
    if($_SERVER["REQUEST_METHOD"]== "POST")
    {
        if(!empty($_POST["idNotificacion"]))
        {
            $daoNotificacion = new DaoNotificacion();
            $idNotificacion=$_POST["idNotificacion"];
            $daoNotificacion->MarcarNotificaciones($idNotificacion);
        }
         if(!empty($_POST["leer"]))
        {
            session_start();
            $usuario = new Usuario();
            $daoNotificacion = new DaoNotificacion();
            $s=$_SESSION["usuario"];
            $usuario= unserialize($s);
            $daoNotificacion->MarcarTodasNotificaciones($usuario->getIdUsuario());
            
            header('Location: ../PHP/Principal.php');
        }   
        
    }
}
