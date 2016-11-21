<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Likes
 *
 * @author Ayrton
 */
class Likes implements JsonSerializable {
    
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdPublicacion() {
        return $this->idPublicacion;
    }

    function getFecha() {
        return $this->fecha;
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

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    private $idUsuario;
    private $idPublicacion;
    private $fecha;
}
