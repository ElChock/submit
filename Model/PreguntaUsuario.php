<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PreguntaUsuario
 *
 * @author Ayrton
 */
class PreguntaUsuario {
    
    function getIdPregunta() {
        return $this->idPregunta;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getRespuesta() {
        return $this->respuesta;
    }

    function setIdPregunta($idPregunta) {
        $this->idPregunta = $idPregunta;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setRespuesta($respuesta) {
        $this->respuesta = $respuesta;
    }

        private $idPregunta;
    private $idUsuario;
    private $respuesta;
}
