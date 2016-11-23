<?php

include  "../Model/Usuario.php";
include_once '../Dao/DaoPublicacion.php';
include_once '../Model/Publicacion.php';
include_once '../Model/Comentario.php';
include_once '../Dao/DaoComentario.php';
include_once '../Dao/DaoNotificacion.php';
include_once '../Model/Notificacion.php';
include_once '../Dao/DaoBusqueda.php';
include_once '../Model/V_publicacion.php';
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
    $listPublicaciones= new V_publicacion();
    $fechaIncio="";
    $fechaFin="";
            
            if(!isset($_GET["dateInicio"]))
            {
                $fechaIncio=null;
            }
            else 
            {
                if($_GET["dateInicio"]=="")
                {
                    $fechaIncio=null;
                }
                else
                {
                    $fechaIncio=$_GET["dateInicio"];
                }
                
            }
            
            if(!isset($_GET["dateFin"]))
            {
                $fechaFin=null;
            }
            else
            {
                if($_GET["dateFin"]=="")
                {
                    $fechaFin=null;
                }
                else
                {
                    $fechaFin=$_GET["dateFin"];
                }
                
            }
    $listPublicaciones=$daoBusqueda->BuscarPublicaciones($_GET["buscar"],$fechaIncio,$fechaFin);
    
}
else
{

}

$daoNotificacion= new DaoNotificacion();
$notificacion = new Notificacion();
$notificacion=$daoNotificacion->BuscarNotificacion($usuarioSesion->getIdUsuario());
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
        <form action="../PHP/BusquedaPublicacion.php" class="Buscador" method="get">
            <input type="text" name="buscar" required min="2" maxlength="20">
            <label>Fecha inicio</label>
            <input type="date" id="Salto"  name="dateInicio"  >
            <label>Fecha fin</label>
            <input type="date" id="Salto"  name="dateFin"  >
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
    
    <ul>
        <?php 
        if(isset($listPublicaciones))
        {
            for($index=0;$index<count($listPublicaciones);$index++)
            {
                $usuario= new Usuario();
                $publicacion=new Publicacion();
                $usuario=$listPublicaciones[$index]->getUsuario();
                $publicacion=$listPublicaciones[$index]->getPublicacion();
                $daoComentario= new DaoComentario();

        ?>
        <li class="Posts" id="<?php echo $publicacion->getIdPublicacion() ?>">
                <div class="PerfilPost">
                    <a href="Perfil.php?id=<?php echo $usuario->getIdUsuario() ?>" class="ProfilePicturePost">
                        <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($usuario->getFotoPerfil()).''; ?>" alt="Profile Picture">
                    </a>
                    <a href="Perfil.php?id=14"><p class="NombrePerfilPost"><?php echo $usuario->getNombre() ?></p></a>
                    <div class="opcionesPublicacionM" id="botonOpciones">
                        <div class="opcionesPublicacionM" id="imagenOpciones">
                            <img src="../Multimedia/abajo.png">
                        </div> 
                        <div class="opcionesPublicacion" id="opciones">
                            <ul>                                <li>
                                <?php if($usuario->getIdUsuario()==$publicacion->getIdUsuario())
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
                
            <p class="TituloPost"><?php echo $publicacion->getTitulo() ?></p>
                
                <?php if( $publicacion->getTipoContenido()=="mp4")
                    { ?>
                
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
                        <button type="submit" name="like" title="like" value="<?php echo $publicacion->getIdPublicacion() ?>">Like</button>
                    </form>
                    <label>like <?php echo  $listPublicaciones[$index]->getLikes(); ?></label>
                </div>             
                
                <div class="PublicarComentario">
                     <form action="../Controller/ControllerComentario.php" method="POST">
                        <input type="text" required="" name="comentario" placeholder="Comentar" min="3" max="200">
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
            }
            ?>
    </ul>
</body>
</html>