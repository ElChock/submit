<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Razon
 *
 * @author Ayrton
 */
class Razon implements JsonSerializable {
    
    function getIdRazon() {
        return $this->idRazon;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setIdRazon($idRazon) {
        $this->idRazon = $idRazon;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    //put your code here
    private $idRazon;
    private $descripcion;
}
