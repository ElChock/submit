<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pregunta
 *
 * @author Ayrton
 */
class Pregunta {
    
    function getIdPregunta() {
        return $this->idPregunta;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setIdPregunta($idPregunta) {
        $this->idPregunta = $idPregunta;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

        private $idPregunta;
    private $descripcion;
}
