<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaoPais
 *
 * @author Ayrton
 */
include_once 'MySqlCon.php';
include_once '../Model/Pais.php';
class DaoPais {
    public function sp_obtenerPais ()
    {
        $listaPais=array();
        $conn = new MySqlCon();
        $connect = $conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexión: %s\n", mysqli_connect_error());
        }
        else 
        {
            $stmt=$connect->prepare("call sp_obtenerPais()");
            if($stmt->execute())
            {
                $stmt->bind_result($codigo,$nombre,$idPais);
                $contador=0;
                while($stmt->fetch())
                {
                    $pais = new Pais();
                    $pais->setCodigo($codigo);
                    $pais->setIdPais($idPais);
                    $pais->setNombre($nombre);
                    $listaPais[$contador]=$pais;
                    $contador++;
                }
            }
            else 
            {
                  
                echo $stmt->error;
            }
        }
        return $listaPais;
    }
}
