<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comentario
 *
 * @author Ayrton
 */
class Comentario {
    function getUsuario() {
        return $this->usuario;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

        function getIdComentario() {
        return $this->idComentario;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdPublicacion() {
        return $this->idPublicacion;
    }

    function getComentario() {
        return $this->comentario;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setIdComentario($idComentario) {
        $this->idComentario = $idComentario;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setIdPublicacion($idPublicacion) {
        $this->idPublicacion = $idPublicacion;
    }

    function setComentario($comentario) {
        $this->comentario = $comentario;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

        private $idComentario;
    private $idUsuario;
    private $idPublicacion;
    private $comentario;
    private $fecha;
    private $usuario;
}
