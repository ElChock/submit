<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaoRazon
 *
 * @author Ayrton
 */
include_once 'MySqlCon.php';
include_once '../Model/Razon.php';
class DaoRazon  {
    public function BuscarRazon()
    {
        $conn= new MySqlCon();
        $connect = $conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexión: %s\n", mysqli_connect_error());
        }
        else 
        {
            $stmt=$connect->prepare("call sp_BuscarRazon");
            if($stmt->execute())
            {
                $listRazon= array();
                $stmt->bind_result($idRazon,$descripcion);
                $contador=0;
                while ($stmt->fetch())
                {
                    $razon = new Razon();
                    $razon->setDescripcion($descripcion);
                    $razon->setIdRazon($idRazon);
                    $listRazon[$contador]=$razon;
                    $contador++;
                }
                $connect->close();
                return $listRazon;
            }
            else 
            {
                $connect->close();
                echo $stmt->error;
            }
        }        
    }
}
