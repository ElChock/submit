<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Seguidores
 *
 * @author Ayrton
 */
class Seguidores {
    function getSigo() {
        return $this->sigo;
    }

    function getMesiguen() {
        return $this->mesiguen;
    }

    function setSigo($sigo) {
        $this->sigo = $sigo;
    }

    function setMesiguen($mesiguen) {
        $this->mesiguen = $mesiguen;
    }

        
    private $sigo;
    private $mesiguen;
}
