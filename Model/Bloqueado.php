<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bloqueado
 *
 * @author Ayrton
 */
class Bloqueado {
    
    function getPermanente() {
        return $this->permanente;
    }

    function setPermanente($permanente) {
        $this->permanente = $permanente;
    }

        
    function getIdBloqueado() {
        return $this->idBloqueado;
    }

    function getIdRazon() {
        return $this->idRazon;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setIdBloqueado($idBloqueado) {
        $this->idBloqueado = $idBloqueado;
    }

    function setIdRazon($idRazon) {
        $this->idRazon = $idRazon;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

        private $idBloqueado;
    private $idRazon;
    private $idUsuario;
    private $fecha;
    private $descripcion;
    private $permanente;
}
