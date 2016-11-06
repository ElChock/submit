<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaoUsuario
 *
 * @author Ayrton
 */
include_once 'MySqlCon.php';
include_once '../Model/Usuario.php';
include_once '../Model/PreguntaUsuario.php';
class DaoUsuario {
    //put your code here
    public function AltaUsuario(Usuario $usuario, PreguntaUsuario $pregunta)
    {
        $conn = new MySqlCon();
        $connect = $conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexión: %s\n", mysqli_connect_error());
        }
        else
        {
            $stmt=$connect->prepare("call spa_usuario(?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("issssssis", $usuario->getIdPais(),$usuario->getNombre(),$usuario->getApellidoPaterno(),$usuario->getNickname(),$usuario->getCorreo(),$usuario->getContraseña(),$usuario->getFechaNacimiento() ,$pregunta->getIdPregunta(),$pregunta->getRespuesta());
            if($stmt->execute())
            {
                $idusuario;
                $nombre;
                $nickname;
                $tipoPerfil;
                $stmt->bind_result($idusuario,$nombre,$nickname,$tipoPerfil);
                $usuario2 = new Usuario();
                $usuario2->setIdUsuario($idUsuario);
                $usuario2->setNombre($nombre);
                $usuario2->setNickname($nickname);
                $usuario2->setTipoperfir($tipoperfil);
                $connect->close();
                return $usuario2;
            }
            else 
            {
                $connect->close();
                echo "error al Ejecutar spa_usuario";    
                echo $stmt->error;
                return false;
            }  
        }               
    }
    
    public function Login(Usuario $usuario)
    {
        $conn = new MySqlCon();
        $connect = $conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexion: %s\n",  mysqli_connect_error());
        }
        else
        {
            $stmt=$connect->prepare("call sp_login(?,?)");
            $stmt->bind_param("ss", $usuario->getCorreo(),$usuario->getContraseña());
            if($stmt->execute())
            {
                $usuarioLogin= new Usuario();
                $stmt->bind_result($idUsuario,$fotoPerfil,$fotoPortada,$municipio,$estado,$idPais,$nombre,$apellidoPaterno,$apellidoMaterno,$descripcion,$correo,$fechaNacimiento,$genero,$tipoPerfil,$nickName,$publico);
                while($stmt->fetch())
                {
                
                $usuarioLogin->setIdUsuario($idUsuario);
                $usuarioLogin->setFotoPortada($fotoPortada);
                $usuarioLogin->setFotoPerfil($fotoPerfil);
                $usuarioLogin->setMunicipio($municipio);
                $usuarioLogin->setEstado($estado);
                $usuarioLogin->setIdPais($idPais);
                $usuarioLogin->setNombre($nombre);
                $usuarioLogin->setApellidoMaterno($apellidoMaterno);
                $usuarioLogin->setApellidoPaterno($apellidoPaterno);
                $usuarioLogin->setDescripcion($descripcion);
                $usuarioLogin->setCorreo($correo);
                $usuarioLogin->setFechaNacimiento($fechaNacimiento);
                $usuarioLogin->setGenero($genero);
                $usuarioLogin->setTipoperfir($tipoPerfil);
                $usuarioLogin->setNickname($nickName);
                $usuarioLogin->setPublico($publico);
                }
                $connect->close();
                return $usuarioLogin;
                
            }
            else
            {
                $connect->close();
                echo $stmt->error;
            }
            
        }
    }
    
    public function ActualizarUsuario(Usuario $usuario)
    {
        $conn= new MySqlCon();
        $connect = $conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexión: %s\n", mysqli_connect_error());
        }
        else
        {
            $stmt=$connect->prepare("call spc_usuario(?,?,?,?,?,?,?)");
            $stmt->bind_param("issssss", $usuario->getIdUsuario(),$usuario->getMunicipio(),$usuario->getEstado(),$usuario->getApellidoPaterno(),$usuario->getApellidoMaterno(),$usuario->getDescripcion(),$usuario->getPublico());
            if($stmt->execute())
            {
                $connect->close();
                echo "funciono el store spc_usuario";
            }
            else 
            {
                $connect->close();
                echo $stmt->error;
            }
        }
    }
    
    public function ActualizarFotoPortada($idUsuario,$imagen)
    {
        $conn = new MySqlCon();
        $connect = $conn->connect();
        $data= file_get_contents($imagen);
        $data=$connect->real_escape_string($data);
        
        if(mysqli_connect_errno())
        {
            printf("Error de conexión: %s\n", mysqli_connect_error());
        } 
        
        else
        {
            $stmt=$connect->prepare("call spc_fotoPortada('$data','$idUsuario')");
            if($stmt->execute())
            {
                $connect->close();
                return $data;
            }
            else 
            {
                $connect->close();
                $stmt->error;
            }
        }
    }
    
    public function ActualizarFotoPerfil($idUsuario,$imagen)
    {
        $conn = new MySqlCon();
        $connect = $conn->connect();
        $data= file_get_contents($imagen);
        $data=$connect->real_escape_string($data);
        
        if(mysqli_connect_errno())
        {
            printf("Error de conexión: %s\n", mysqli_connect_error());
        } 
        
        else
        {
            $stmt=$connect->prepare("call spc_fotoPerfil('$data','$idUsuario')");
            if($stmt->execute())
            {
                $connect->close();
                return $data;
            }
            else 
            {
                $connect->close();
                $stmt->error;
            }
        }
    }    
}
