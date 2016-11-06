<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notificacion
 *
 * @author Ayrton
 */
class Notificacion {
    
    function getIdNotificacion() {
        return $this->idNotificacion;
    }

    function getVista() {
        return $this->vista;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdPublicacion() {
        return $this->idPublicacion;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setIdNotificacion($idNotificacion) {
        $this->idNotificacion = $idNotificacion;
    }

    function setVista($vista) {
        $this->vista = $vista;
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

        private $idNotificacion;
    private $vista;
    private $idUsuario;
    private $idPublicacion;
    private $fecha;
}
