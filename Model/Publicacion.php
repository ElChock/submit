<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Publicacion
 *
 * @author Ayrton
 */
class Publicacion implements JsonSerializable {
    
    function getTitulo() {
        return $this->titulo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

        
    function getIdPublicacion() {
        return $this->idPublicacion;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPath() {
        return $this->path;
    }

    function getTipoContenido() {
        return $this->tipoContenido;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setIdPublicacion($idPublicacion) {
        $this->idPublicacion = $idPublicacion;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPath($path) {
        $this->path = $path;
    }

    function setTipoContenido($tipoContenido) {
        $this->tipoContenido = $tipoContenido;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    private $idPublicacion;
    private $idUsuario;
    private $descripcion;
    private $path;
    private $tipoContenido;
    private $fecha;
    private $titulo;
}
