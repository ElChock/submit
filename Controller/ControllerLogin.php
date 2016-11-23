<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include "../Model/Usuario.php";
include_once '../Dao/DaoUsuario.php';
include_once '../Model/PreguntaUsuario.php';
include_once '../Model/V_bloqueado.php';
    $daoUsusuario=new DaoUsuario();
    $usuario = new Usuario();
    $pregunta = new PreguntaUsuario();
    if ($_SERVER["REQUEST_METHOD"]== "POST")
    {
    if(!empty($_POST["registro"]))
    {


        if(!empty($_POST["nombre"]))
        {
            $usuario->setNombre($_POST["nombre"]);
        }
        if(!empty($_POST["apellido"]))
        {
            $usuario->setApellidoPaterno($_POST["apellido"]);
        }
        if(!empty($_POST["nickname"]))
        {
            $usuario->setNickname($_POST["nickname"]);
        }
        if(!empty($_POST["date"]))
        {
            $usuario->setFechaNacimiento($_POST["date"]);
        }
        if(!empty($_POST["idpregunta"]))
        {
            $pregunta->setIdPregunta($_POST["idpregunta"]);
            echo $pregunta->getIdPregunta();
        }
        if(!empty($_POST["respuesta"]))
        {
            $pregunta->setRespuesta($_POST["respuesta"]);

        }
        if(!empty($_POST["correo"]))
        {
            $usuario->setCorreo($_POST["correo"]);
        }
        if(!empty($_POST["contraseña"]))
        {
            $usuario->setContraseña(sha1($_POST["contraseña"]));
        }

        if(!empty($_POST["pais"]))
        {
            $usuario->setIdPais($_POST["pais"]);
        }

        if(!empty($usuario)&&!empty($pregunta))
        {
            $usuariologin= new Usuario();
            $usuariologin=$daoUsusuario->AltaUsuario($usuario, $pregunta);
            if($usuariologin->getIdUsuario()!=null)
            {
                session_start();
                $s=  serialize($usuariologin);
                $_SESSION["usuario"]=$s;
                header('Location: ../PHP/Principal.php');
            }
            else
            {
                header('Location: ../PHP/Login.php');
            }
        }

    }
    if(!empty($_POST["login"]))
    {
        
        
        if(!empty($_POST["email"]))
        {
            $usuario->setCorreo($_POST["email"]);
        }
        if(!empty($_POST["contraseña"]))
        {
            $usuario->setContraseña(sha1($_POST["contraseña"]));

        }

        if(!empty($usuario))
        {
            
            
            $idUsuario=$daoUsusuario->verificarBloqueado($usuario);
            
            
            if($idUsuario!=0)
            {
                session_start();
                $usuarioLogin=$daoUsusuario->Login($usuario);
                $s= serialize($usuarioLogin);
                $_SESSION["usuario"]=$s;                
                header('Location: ../PHP/Bloqueado.php');
            }
            else 
            {
                session_start();
                $usuarioLogin=$daoUsusuario->Login($usuario);

                if(!empty($usuarioLogin))
                {
                    $s= serialize($usuarioLogin);

                    $_SESSION["usuario"]=$s;
                    header('Location: ../PHP/Principal.php');
                }
                
            }
            

        }
    }
    }
    else if ($_SERVER["REQUEST_METHOD"]== "GET")
    {
        if(!empty($_GET["cerrarSesion"]))
        {
            session_start();
            session_unset($_SESSION);
            header('Location: ../PHP/Login.php');
        }
    
    }