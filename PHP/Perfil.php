<?php
include  "../Model/Usuario.php";
include_once '../Dao/DaoUsuario.php';
include_once '../Dao/DaoPublicacion.php';
include_once '../Model/Publicacion.php';
include_once '../Model/Comentario.php';
include_once '../Dao/DaoComentario.php';
session_start();
$usuario= new Usuario();
if($_SESSION["usuario"]==null)
{
    header('Location: ../PHP/Login.php');
}
$s=$_SESSION["usuario"];
$usuario= unserialize($s);  

if($_SERVER["REQUEST_METHOD"]=="GET" && !empty($_GET["id"]))
{
$daoPublicacion= new DaoPublicacion();
$listPublicacion= $daoPublicacion->BuscarPublicacionesPropias($_GET["id"]);
$daoComentario= new DaoComentario();
$usuarioPerfil= new Usuario();
$daoUsuario= new DaoUsuario();
$usuarioPerfil=$daoUsuario->BuscarUsuario($_GET["id"]);
}
else
{
$daoPublicacion= new DaoPublicacion();
$listPublicacion= $daoPublicacion->BuscarPublicacionesPropias($usuario->getIdUsuario());
$daoComentario= new DaoComentario();
}

    
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link href="../CSS/CSSLogin.css" rel="stylesheet" type="text/css">
</head>

<body>  
    <header class="HeaderPrincipal">
        <a href="../PHP/Principal.php"><h1>S</h1></a>
        <form  class="Buscador">
            <input type="text" required min="2" maxlength="20">
            <input type="submit" value="Buscar">
        </form>
        <div class="Notificacion">
            <img src="../Multimedia/notificacion.png" alt="Notificaciones" >
        </div>    
        <a href="../PHP/Perfil.php">Perfil</a>
        <a href="../Controller/ControllerLogin.php?cerrarSesion=1" >cerrar sesion</a>    
    </header>
    <!-- imagen perfil y portada-->
    <div class="ImagenPortada" >
        <form action="../Controller/ControllerDatosPersonales.php" method="POST" enctype="multipart/form-data">
            <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($usuario->getFotoPortada()).''; ?>">
        <?php
        if(!$_SERVER["REQUEST_METHOD"]=="GET")
        {
        ?>
        <input type="file" name="portada" accept="image/*">
        <input type="submit" name="fotoPortada" value="subir">
        <?php }?>
        </form>
    </div>
    <div class="AvatarPortada">
        <form action="../Controller/ControllerDatosPersonales.php" method="POST" enctype="multipart/form-data">
            <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($usuario->getFotoPerfil()).''; ?>" alt="Profile Picture">
        <?php
        if(!$_SERVER["REQUEST_METHOD"]=="GET")
        {
        ?>
        <input type="file" name="perfil" accept="image/*">
        <input type="submit" name="fotoPerfil" value="subir">
        <?php }?>
        </form>
    </div>
    <!-- seguidores -->
    <form action="../Controller/ControllerSeguidores.php" method="POST">
        <?php if(!empty($usuarioPerfil)){ ?>
        <input type="hidden" name="idSeguir" value="<?php echo $usuarioPerfil->getIdUsuario(); ?>">
        <?php } ?>
        <div class="Posts">
            <div>
                <label>
                    Gente siguiendo
                </label>
                <label>
                    Seguidores
                </label> 
            </div>

            <div>
                <label>
                    200
                </label>
                <label>
                    10
                </label>
            </div>
            <?php if(!empty($usuarioPerfil)){ ?>
            <input type="submit"  value="seguir" >
            <?php } ?>
        </div>
    </form>
	<!-- Publicacion -->
    <div  class="Publicacion"> 
        
        
        <ul>
            
            <?php
            for($index=0;$index<count($listPublicacion);$index++)
            {
                
            $publicacion=new Publicacion();
            $usuario=$listPublicacion[$index]->getUsuario();
            $publicacion=$listPublicacion[$index]->getPublicacion();
            if($publicacion->getTipoContenido()=="mp4")
            {
            ?>
            <li class="Posts" id="<?php echo $publicacion->getIdPublicacion() ?>">
                <div class="PerfilPost">
                    <a href="" class="ProfilePicturePost">
                        <?php 
                            if(empty($usuario->getFotoPerfil())) 
                            {
                        ?>
                            <img src="../Multimedia/unknown.jpg" alt="Profile Picture">
                        <?php
                            }
                        
                            else
                            {
                        ?>
                            <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($usuario->getFotoPerfil()).''; ?>" alt="Profile Picture">
                        <?php
                            }
                        ?>
                        
                        
                    </a>
                    <a href=""><p class="NombrePerfilPost"><?php echo $usuario->getNombre() ?></p></a>
                </div>
                <p class="TituloPost"><?php echo $publicacion->getTitulo(); ?></p>
                <video controls>
                    <source src="<?php echo $publicacion->getPath()?>"  type=video/mp4> 
                    Este browser no acepta videos
		</video>
                <div>
                    <p class="ComentarioTitulo"><?php echo $publicacion->getDescripcion() ?></p>
                </div>
                <div class="PublicarComentario" >
                    <form action="../Controller/ControllerComentario.php" method="POST"  >
                        <input type="text" required name="comentario" placeholder="Comentar" min="3" max="200">
                        <input type="hidden" name="idPublicacion" value="<?php echo $publicacion->getIdPublicacion() ?>">
                        <input type="submit" name="comentar">
                    </form>
                </div>
                <ul class="Comentario">
                    
                    <?php
                    $listComentario=$daoComentario->BuscarComentario($publicacion->getIdPublicacion());
                    for($index2=0;$index2<count($listComentario);$index2++)
                    {
                        $comentario = new Comentario();
                        $usuario= new usuario();
                        $comentario=$listComentario[$index2];
                        $usuario=$comentario->getUsuario();
                    ?>
                    
                    <li >
                        <div class="PerfilPost">
                            <a href="" class="ProfilePicturePost">
                            <?php 
                                if(empty($usuario->getFotoPerfil())) 
                                {
                            ?>
                                <img src="../Multimedia/unknown.jpg" alt="Picture">
                            <?php
                                }

                                else
                                {
                            ?>
                                <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($usuario->getFotoPerfil()).''; ?>" alt="Profile Picture">
                            <?php
                                }
                            ?>
                            </a>
                            <a href=""><label class="NombrePerfilPost"><?php echo $usuario->getNombre() ?><label></a>
                        </div>
                        <div >
                            <p> <?php echo $comentario->getComentario() ?></p>
                        </div>
                    </li>
                    
                    <?php
                    
                    }
                    ?>
                    
                </ul>
            </li>
           <?php
           }
            else {
            ?>
            <li class="Posts" id="<?php echo $publicacion->getIdPublicacion() ?>">
                <div class="PerfilPost">
                    <a href="" class="ProfilePicturePost">
                            <?php 
                                if(empty($usuario->getFotoPerfil())) 
                                {
                            ?>
                                <img src="../Multimedia/unknown.jpg" alt="Picture">
                            <?php
                                }

                                else
                                {
                            ?>
                                <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($usuario->getFotoPerfil()).''; ?>" alt="Profile Picture">
                            <?php
                                }
                            ?>
                    </a>
                    <a href=""><p class="NombrePerfilPost"><?php echo $usuario->getNombre() ?></p></a>
                </div>
                <p class="TituloPost"><?php echo $publicacion->getTitulo(); ?></p>
                <img src="<?php echo $publicacion->getPath() ?>" alt="Publicacion">
                <div>
                    <p class="ComentarioTitulo"><?php echo $publicacion->getDescripcion() ?></p>
                </div>
                <div class="PublicarComentario" >
                     <form action="../Controller/ControllerComentario.php" method="POST"  >
                        <input type="text" required name="comentario" placeholder="Comentar" min="3" max="200">
                        <input type="hidden" name="idPublicacion" value="<?php echo $publicacion->getIdPublicacion() ?>">
                        <input type="submit" name="comentar">
                    </form>
                </div>
                <ul class="Comentario">

                     <?php
                    $listComentario=$daoComentario->BuscarComentario($publicacion->getIdPublicacion());
                    for($index2=0;$index2<count($listComentario);$index2++)
                    {
                        $comentario = new Comentario();
                        $usuario= new usuario();
                        $comentario=$listComentario[$index2];
                        $usuario=$comentario->getUsuario();
                    ?>
                    <li >
                        <div class="PerfilPost">
                            <a href="" class="ProfilePicturePost">
                            <?php 
                                if(empty($usuario->getFotoPerfil())) 
                                {
                            ?>
                                <img src="../Multimedia/unknown.jpg" alt="Picture">
                            <?php
                                }

                                else
                                {
                            ?>
                                <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($usuario->getFotoPerfil()).''; ?>" alt="Profile Picture">
                            <?php
                                }
                            ?>
                            </a>
                            <a href=""><label class="NombrePerfilPost"><?php echo $usuario->getNombre() ?><label></a>
                        </div>
                        <div >
                            <p> <?php echo $comentario->getComentario() ?></p>
                        </div>
                    </li>
                    
                    <?php
                    
                    }
                    ?>
                </ul>
            </li>
            
                <?php 
                }
            }
                
                ?> 

            
            
        </ul>
    </div>
</body>
    <footer>
        <div>Iconos diseñados por <a href="http://www.flaticon.es/autores/chanut-is-industries" title="Chanut is Industries">Chanut is Industries</a> desde <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> con licencia <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
    </footer>
</html>