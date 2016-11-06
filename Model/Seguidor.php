<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Seguidor
 *
 * @author Ayrton
 */
class Seguidor {
    
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdUsuarioSeguidor() {
        return $this->idUsuarioSeguidor;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setIdUsuarioSeguidor($idUsuarioSeguidor) {
        $this->idUsuarioSeguidor = $idUsuarioSeguidor;
    }

        //put your code here
    private $idUsuario;
    private $idUsuarioSeguidor;
}
