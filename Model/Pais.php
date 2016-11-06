<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pais
 *
 * @author Ayrton
 */
class Pais {
    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getIdPais() {
        return $this->idPais;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setIdPais($idPais) {
        $this->idPais = $idPais;
    }

    
    
    private $codigo;
    private $nombre;
    private $idPais;
}
