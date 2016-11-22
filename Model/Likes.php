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
    
    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getIdPublicacion() {
        return $this->idPublicacion;
    }



    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setIdPublicacion($idPublicacion) {
        $this->idPublicacion = $idPublicacion;
    }



    public function jsonSerialize() {
        return get_object_vars($this);
    }

    private $idUsuario;
    private $idPublicacion;
    
}
