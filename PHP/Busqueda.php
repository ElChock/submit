<?php

include  "../Model/Usuario.php";
include_once '../Dao/DaoPublicacion.php';
include_once '../Model/Publicacion.php';
include_once '../Model/Comentario.php';
include_once '../Dao/DaoComentario.php';
include_once '../Dao/DaoNotificacion.php';
include_once '../Model/Notificacion.php';
include_once '../Dao/DaoBusqueda.php';

session_start();
$usuario= new Usuario();
$usuarioSesion= new Usuario();
if($_SESSION["usuario"]==null)
{
    header('Location: ../PHP/Login.php');
}
$s=$_SESSION["usuario"];

$usuarioSesion= unserialize($s);  
if($usuarioSesion->getIdUsuario()==null)
{
    header('Location: ../PHP/Login.php');
}

if($_SERVER["REQUEST_METHOD"]=="GET" && !empty($_GET["buscar"]))
{
    $daoBusqueda= new DaoBusqueda();
    $listUsuario;
    $listUsuario=$daoBusqueda->BuscarPersona($_GET["buscar"]);
}
else
{

}
?>


<html>

<head>
<meta charset="utf-8">
<title>Submit</title>
<link href="../CSS/CSSLogin.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="../JS/libs/jquery/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../JS/js.js"></script>
</head>
<body>
    <header class="HeaderPrincipal">
        <a href="../PHP/Principal.php"><h1>S</h1></a>
        <form  class="Buscador" action="Busqueda.php" method="get">
            <input type="text" required min="2" maxlength="20">
            <input type="submit" value="Buscar">
        </form>
        <div class="Notificacion">
            <img src="../Multimedia/notificacion.png" alt="Notificaciones" >
            <ul class="Notificacionli Ocultar">
                <li>
                
                    <?php
                    for($index=0;$index<count($notificacion);$index++)
                    {
                    ?>
                    <div>
                        <a idNotificacion="<?php echo $notificacion[$index]->getIdNotificacion() ?>" href="Publicacion.php?idPublicacion=<?php echo $notificacion[$index]->getIdPublicacion() ?>"><?php echo $notificacion[$index]->getDescripcion() ?></a>
                    </div>
                    <?php
                    }?>
                
                </li>
            </ul>
        </div>    
        
        <a href="../PHP/Perfil.php">Perfil</a>
        <a href="../Controller/ControllerLogin.php?cerrarSesion=1" >cerrar sesion</a>    
    </header>
    
    <ul>
        <?php
        if(isset($listUsuario))
        {
            for($index=0;$index<count($listUsuario);$index++)
            {
                $usuario = new Usuario();
                $usuario=$listUsuario[$index];
            
        ?>
        <li class="Posts" id="42">
                    <div class="PerfilPost">
                        <a href="Perfil.php?id=<?php echo $usuario->getIdUsuario() ?>" class="ProfilePicturePost">
                            <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($usuario->getFotoPerfil()).''; ?>" alt="Profile Picture">
                        </a>
                        <a href="Perfil.php?id=<?php echo $usuario->getIdUsuario() ?>"><p class="NombrePerfilPost"><?php echo $usuario->getNombre()." (".$usuario->getNickname().")" ?></p></a>
                    </div>

                    <p class="TituloPost"><?php echo $usuario->getDescripcion() ?></p>
                    
                    <div>
                        <p class="ComentarioTitulo"></p>
                        <form action="../Controller/ControllerSeguidores.php" method="POST">
                            <input type="hidden" name="idSeguir" value="<?php echo $usuario->getIdUsuario(); ?>">
                            <input type="submit"  value="seguir" >
                        </form>
                    </div>           
        </li>
        
        <?php
            }
        }
        ?>
    </ul>
</body>
</html>