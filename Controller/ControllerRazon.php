<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../Model/Razon.php';
include_once '../Dao/DaoRazon.php';
if($_SERVER["REQUEST_METHOD"]=="GET" )
{
    if(!empty($_GET["razon"]))
    {
        $daoRazon= new DaoRazon();
        $listRazon=$daoRazon->BuscarRazon();
        echo json_encode($listRazon);
    }
}