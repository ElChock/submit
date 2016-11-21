<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaoBloqueado
 *
 * @author Ayrton
 */
include_once '../Model/Bloqueado.php';
class DaoBloqueado 
{
    public function altaBloqueo(Bloqueado $bloqueado)
    {
        $conn= new MySqlCon();
        $connect=$conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexión: %s\n", mysqli_connect_error());
        }
        else 
        { 
            $stmt=$connect->prepare("call spa_boqueado(?,?,?,?,?)");
            $stmt->bind_param("iisss", $bloqueado->getIdRazon(),$bloqueado->getIdUsuario(),$bloqueado->getFecha(),$bloqueado->getDescripcion(),$bloqueado->getPermanente());
            if($stmt->execute())
            {
                $connect->close();
            }
            else
            {
                echo $stmt->error;
                $connect->close();
            }
        }
    }
}
