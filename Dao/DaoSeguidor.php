<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaoSeguidor
 *
 * @author Ayrton
 */
include_once '../Model/Seguidor.php';
include_once '../Model/Seguidores.php';
include_once 'MySqlCon.php';

class DaoSeguidor {
    //put your code here
    public function AltaSeguidor(Seguidor $seguidor )
    {
        $conn = new MySqlCon();
        $connect = $conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexión: %s\n", mysqli_connect_error());
        }
        else 
        {
         $stmt=$connect->prepare("call spa_seguidor(?,?)");
         if($stmt->bind_param("ii", $seguidor->getIdUsuario(),$seguidor->getIdUsuarioSeguidor()))
         {
            if($stmt->execute())
            {
                $connect->close();
            }
            else
            {
                $connect->close();
               echo $stmt->error;
            }            
         }                    
         else
         {
             $stmt->error;
         }

        }
    }
    
    public function Seguidores($idUsurario)
    {
        $conn= new MySqlCon();
        $connect= $conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexión: %s\n", mysqli_connect_error());
        }
        else 
        {
            $stmt=$connect->prepare("call sp_seguidores($idUsurario)");
            if($stmt->execute())
            {
                $seguidores= new Seguidores();
                $stmt->bind_result($mesiguen,$sigo);
                $stmt->fetch();
                $seguidores->setMesiguen($mesiguen);
                $seguidores->setSigo($sigo);
                $connect->close();
                return $seguidores;
            }
            else
            {
                echo $stmt->error;
                $connect->close();
            }
        }
    }
}
