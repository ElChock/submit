<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of V_bloqueado
 *
 * @author Ayrton
 */
class V_bloqueado {
    function getIdBloqueado() {
        return $this->idBloqueado;
    }

    function getRazon() {
        return $this->razon;
    }

    function getIdUsairio() {
        return $this->idUsairio;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPermanente() {
        return $this->permanente;
    }

    function setIdBloqueado($idBloqueado) {
        $this->idBloqueado = $idBloqueado;
    }

    function setRazon($razon) {
        $this->razon = $razon;
    }

    function setIdUsairio($idUsairio) {
        $this->idUsairio = $idUsairio;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPermanente($permanente) {
        $this->permanente = $permanente;
    }

        
    private $idBloqueado;
    private $razon;
    private $idUsairio;
    private $fecha;
    private $descripcion;
    private $permanente;
}
