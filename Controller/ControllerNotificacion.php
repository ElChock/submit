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

{
    if($_SERVER["REQUEST_METHOD"]== "POST")
    {
        
        $daoNotificacion = new DaoNotificacion();
        $idNotificacion=$_POST["idNotificacion"];
        $daoNotificacion->MarcarNotificaciones($idNotificacion);
        
        
        
    }
}
