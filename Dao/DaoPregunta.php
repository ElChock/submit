<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaoPregunta
 *
 * @author Ayrton
 */
include_once 'MySqlCon.php';
include_once '../Model/Pregunta.php';
class DaoPregunta {
    public function obtenerPreguntas()
    {
        $listaPreguntas = array();
        $conn = new MySqlCon();
        $connect = $conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexion: %s\n", mysqli_connect_error());
        }
        else
        {
            $stmt=$connect->prepare("call sp_obtenerPreguntas");
            if($stmt->execute())
            {
                $stmt->bind_result($idPregunta,$descripcion);
                $contador=0;
                while($stmt->fetch())
                {
                    $pregunta = new Pregunta();
                    $pregunta->setDescripcion($descripcion);
                    $pregunta->setIdPregunta($idPregunta);
                    $listaPreguntas[$contador]=$pregunta;
                    $contador++;
                }
            }
            else
            {
                echo $stmt->error;
            }
        }
        return $listaPreguntas;
    }
}
