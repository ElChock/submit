<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of V_publicacion
 *
 * @author Ayrton
 */
include_once 'Publicacion.php';
include_once 'Usuario.php';
include_once 'Likes.php';
class V_publicacion {
    function getPublicacion() {
        return $this->publicacion;
    }

    function setPublicacion($publicacion) {
        $this->publicacion = $publicacion;
    }

    
    

    function getUsuario() {
        return $this->usuario;
    }

    function getLikes() {
        return $this->likes;
    }


    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setLikes($likes) {
        $this->likes = $likes;
    }

    
    private $publicacion;
    private $usuario;
    private $likes;
}
