<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaoLike
 *
 * @author Ayrton
 */
include_once '../Model/Likes.php';
include_once 'MySqlCon.php';
class DaoLike {
    
    public function altalike(Likes $like)
    {
        $conn= new MySqlCon();
        $connect = $conn->connect();
        if(mysqli_connect_errno())
        {
            
        }
        else
        {
            try 
            {
                $stmt= $connect->prepare("call spa_like(?,?)");
                $stmt->bind_param("ii", $like->getIdUsuario(),$like->getIdPublicacion());
                if($stmt->execute())
                {
                    
                }
                else
                {
                    echo $stmt->error;
                }
                
            } 
            catch (Exception $exc) 
            {
                echo $exc->getTraceAsString();
            } 
            finally 
            {
                
            }
        }
    }
}
