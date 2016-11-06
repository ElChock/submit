<?php

include  "../Model/Usuario.php";
include_once '../Dao/DaoPublicacion.php';
include_once '../Model/Publicacion.php';
include_once '../Model/Comentario.php';
include_once '../Dao/DaoComentario.php';
session_start();
$usuario= new Usuario();
$usuarioSesion= new Usuario();
if($_SESSION["usuario"]==null)
{
    header('Location: ../PHP/Login.php');
}
$s=$_SESSION["usuario"];
$usuarioSesion= unserialize($s);  

$daoPublicacion= new DaoPublicacion();
$listPublicacion= $daoPublicacion->BuscarPublicacion($usuarioSesion->getIdUsuario());
$daoComentario= new DaoComentario();


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link href="../CSS/CSSLogin.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="../JS/libs/jquery/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../JS/js.js"></script>


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
            else {
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
                                <li>
                                Denunciar
                                </li>
                                <?php
                                } 
                                else
                                {
                                ?>
                                <li>
                                Denunciar
                                </li>                                
                                <?php
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                    
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