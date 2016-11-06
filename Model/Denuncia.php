<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Denuncia
 *
 * @author Ayrton
 */
class Denuncia {
    
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdPublicacion() {
        return $this->idPublicacion;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getIdUsuarioDenunciado() {
        return $this->idUsuarioDenunciado;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setIdPublicacion($idPublicacion) {
        $this->idPublicacion = $idPublicacion;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setIdUsuarioDenunciado($idUsuarioDenunciado) {
        $this->idUsuarioDenunciado = $idUsuarioDenunciado;
    }

        private $idUsuario;
    private $idPublicacion;
    private $fecha;
    private $idUsuarioDenunciado;
}
