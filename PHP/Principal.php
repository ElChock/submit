<?php

include  "../Model/Usuario.php";
include_once '../Dao/DaoPublicacion.php';
include_once '../Model/Publicacion.php';
include_once '../Model/Comentario.php';
include_once '../Dao/DaoComentario.php';
include_once '../Dao/DaoNotificacion.php';
include_once '../Model/Notificacion.php';
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

$daoPublicacion= new DaoPublicacion();
$listPublicacion= $daoPublicacion->BuscarPublicacion($usuarioSesion->getIdUsuario());
$daoComentario= new DaoComentario();
$daoNotificacion= new DaoNotificacion();
$notificacion = new Notificacion();
$notificacion=$daoNotificacion->BuscarNotificacion($usuarioSesion->getIdUsuario());

?>

<!doctype html>
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
        <form action="../php/Busqueda.php" class="Buscador" method="get">
            <input type="text" name="buscar" required min="2" maxlength="20">
            <input type="submit" value="Buscar">
            <a href="../PHP/BusquedaPublicacion.php"><label>Buscar Publicacion</label></a>
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
                        <span><?php if($notificacion[$index]->getVista()=="n") {echo "no";} else{echo "si";}?></span><a class="notificacion" visto="<?php echo $notificacion[$index]->getVista() ?>" idNotificacion="<?php echo $notificacion[$index]->getIdNotificacion() ?>" href="Publicacion.php?idPublicacion=<?php echo $notificacion[$index]->getIdPublicacion() ?>"><?php echo $notificacion[$index]->getDescripcion() ?></a>
                    </div>
                    <?php
                    }?>
                    <div>
                        <form action="../Controller/ControllerNotificacion.php" method="POST" >
                            <button type="submit" id="Leer" value="visto" name="leer" >Leido</button>
                        </form>
                    </div>
                </li>
             
            </ul>
            
        </div>    
        
        <a href="../PHP/Perfil.php">Perfil</a>
        <a href="../Controller/ControllerLogin.php?cerrarSesion=1" >cerrar sesion</a>    
    </header>
    
    <div class="Publicar">
        <form action="../Controller/ControllerPublicar.php" method="post" enctype="multipart/form-data">
            <a href="" class="PerfilPost" >
                        <?php 
                                if(empty($usuarioSesion->getFotoPerfil())) 
                                {
                            ?>
                                <img src="../Multimedia/unknown.jpg" alt="Picture">
                            <?php
                                }

                                else
                                {
                            ?>
                                <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($usuarioSesion->getFotoPerfil()).''; ?>" alt="Profile Picture">
                            <?php
                                }
                            ?>
            </a>
          <p id="Salto" class="NombrePerfilPost"><?php echo $usuarioSesion->getNombre(); ?></p>
          <input type="text" name="titulo" required placeholder="Titulo" min="3" max="20">
            <br>
            <div class="EspacioSubir">
                <input type="file" required name="archivo"  aria-label="subir" accept=".mp4,.jpg,.gif,.avi,.png" >
            </div>
            <br>
            <input type="text" name="descripcion" placeholder="Comentario" min="3" maxlength="400">
            <div class="PublicarComentario">
	        <input name="publicar" type="submit">
            </div>
        </form>
    </div>
    
    <div  class="Publicacion"> 
        <ul>
            
            <?php
            for($index=0;$index<count($listPublicacion);$index++)
            {
                
            $publicacion=new Publicacion();
            $usuario=$listPublicacion[$index]->getUsuario();
            $publicacion=$listPublicacion[$index]->getPublicacion();
            
            ?>

            <li class="Posts" id="<?php echo $publicacion->getIdPublicacion() ?>">
                <div class="PerfilPost">
                    <a href=Perfil.php?id=<?php echo $publicacion->getIdUsuario() ?> class="ProfilePicturePost">
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
                    <a href=Perfil.php?id=<?php echo $publicacion->getIdUsuario() ?> ><p class="NombrePerfilPost"><?php echo $usuario->getNombre() ?></p></a>
                    <div class="opcionesPublicacionM" id="botonOpciones" >
                        <div class="opcionesPublicacionM" id="imagenOpciones">
                            <img src="../Multimedia/abajo.png"  >
                        </div> 
                        <div class="opcionesPublicacion" id='opciones'>
                            <ul><?php if($usuarioSesion->getIdUsuario()==$publicacion->getIdUsuario())
                                {
                                    ?>
                                <li>
                                    <a href="../Controller/ControllerPublicar.php?borrar=<?php echo $publicacion->getIdPublicacion() ?>" >Borrar</a>
                                 </li>
                                <li>
                                Editar
                                </li>
                                <?php
                                } 
                                else
                                {
                                ?>
                                <li>
                                    <a href="../Controller/ControllerDenuncia.php?idPublicacion=<?php echo $publicacion->getIdPublicacion(); ?>&idUsuario=<?php echo $publicacion->getIdUsuario() ?>" >Denunciar</a>
                                </li>                                
                                <?php
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                    
                </div>
                
                <p class="TituloPost"><?php echo $publicacion->getTitulo(); ?></p>
                
                <?php if( $publicacion->getTipoContenido()=="mp4"){ ?>
                
                <video controls>
                    <source src="<?php echo $publicacion->getPath()?>"  type=video/mp4> 
                    Este browser no acepta videos
		</video>
                <?php } 
                else
                {
                    ?>
                <img src="<?php echo $publicacion->getPath() ?>" alt="Publicacion">
                    <?php

                }?>

                
                <div>
                    <p class="ComentarioTitulo"><?php echo $publicacion->getDescripcion() ?></p>
                </div>
                
                <div>
                    <form action="../Controller/ControllerLike.php" method="POST">
                        <button type="submit" name="like" title="like"  value="<?php echo $publicacion->getIdPublicacion() ?>">Like</button>
                    </form>
                    <label>like <?php echo  $listPublicacion[$index]->getLikes(); ?></label>
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
                            <a href=Perfil.php?id=<?php echo $comentario->getIdUsuario() ?> class="ProfilePicturePost">
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
                            <a href=Perfil.php?id=<?php echo $comentario->getIdUsuario() ?>><label class="NombrePerfilPost"><?php echo $usuario->getNombre() ?><label></a>
                        </div>
                        <div><?php echo $comentario->getFecha() ?></div>
                        
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
                
                ?> 

            
            
        </ul>
        
        
        <!--
        <div class="Publicacion">
            <a href=""><img src="" alt="Profile Picture"></a>
          <p>Nombre</p>
            <img src="https://docs.unrealengine.com/latest/images/Support/Builds/ReleaseNotes/2016/4_13/image_11.gif" alt="Publicacion">
          <div>
                    <p>comentario</p>
            </div>
            <div class="PublicarComentario" >
                    <form>
                    <input type="text" placeholder="Comentar">
                <input type="submit">
                </form>
            </div>
        </div>
        -->
    </div>
    
    <footer>
        <div>Iconos diseñados por <a href="http://www.flaticon.es/autores/chanut-is-industries" title="Chanut is Industries">Chanut is Industries</a> desde <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> con licencia <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
    </footer>
</body>
</html>