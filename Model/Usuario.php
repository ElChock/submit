<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Ayrton
 */

class Usuario implements JsonSerializable {
    
    function getPublico() {
        return $this->publico;
    }

    function setPublico($publico) {
        $this->publico = $publico;
    }

        
    function getNickname() {
        return $this->nickname;
    }

    function setNickname($nickname) {
        $this->nickname = $nickname;
    }

        
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getFotoPerfil() {
        return $this->fotoPerfil;
    }

    function getFotoPortada() {
        return $this->fotoPortada;
    }

    function getMunicipio() {
        return $this->municipio;
    }

    function getEstado() {
        return $this->estado;
    }

    function getIdPais() {
        return $this->idPais;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidoPaterno() {
        return $this->apellidoPaterno;
    }

    function getApellidoMaterno() {
        return $this->apellidoMaterno;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getContraseña() {
        return $this->contraseña;
    }

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function getGenero() {
        return $this->genero;
    }

    function getTipoperfir() {
        return $this->tipoperfir;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setFotoPerfil($fotoPerfil) {
        $this->fotoPerfil = $fotoPerfil;
    }

    function setFotoPortada($fotoPortada) {
        $this->fotoPortada = $fotoPortada;
    }

    function setMunicipio($municipio) {
        $this->municipio = $municipio;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setIdPais($idPais) {
        $this->idPais = $idPais;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidoPaterno($apellidoPaterno) {
        $this->apellidoPaterno = $apellidoPaterno;
    }

    function setApellidoMaterno($apellidoMaterno) {
        $this->apellidoMaterno = $apellidoMaterno;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setContraseña($contraseña) {
        $this->contraseña = $contraseña;
    }

    function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setTipoperfir($tipoperfir) {
        $this->tipoperfir = $tipoperfir;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    //put your code here
    private $idUsuario;
    private $fotoPerfil;
    private $fotoPortada;
    private $municipio;
    private $estado;
    private $idPais;
    private $nombre;
    private $apellidoPaterno;
    private $apellidoMaterno;
    private $descripcion;
    private $correo;
    private $contraseña;
    private $fechaNacimiento;
    private $genero;
    private $tipoperfir;
    private $nickname;
    private $publico;
}
