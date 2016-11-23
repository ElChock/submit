<?php
include_once '../Dao/DaoNotificacion.php';
include_once '../Model/Notificacion.php';
include_once  "../Model/Usuario.php";
session_start();

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

$daoNotificacion= new DaoNotificacion();
$notificacion = new Notificacion();
$notificacion=$daoNotificacion->BuscarNotificacion($usuarioSesion->getIdUsuario());

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Submit</title>
<link href="../CSS/CSSLogin.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="../JS/libs/jquery/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../JS/js.js"></script>
<script language="javascript" type="text/javascript" src="../JS/Administrador.js"></script>
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
    
    <div>
        <ul id="denuncia">
            <!--
            <li class="PostDenuncia">
                    <div class="PerfilPost">
                        <a href="" class="ProfilePicturePost"><img src="https://scontent.fmty1-1.fna.fbcdn.net/v/t1.0-1/c0.0.160.160/p160x160/13419193_10206507853476920_1791016863142086228_n.jpg?oh=5601616d1c04bb7d3ef0c1b6cee67400&oe=5865F374" alt="Profile Picture"></a>
                        <p class="NombrePerfilPost">Ayrton Garcia Lopez</p>
                    </div>
                    <p class="TituloPost">LOL</p>
                    <img src="http://cdn2.pu.nl/media/bas/borderlands_2_wallpaper_by_slydog0905-d628xak.png" alt="Publicacion">
                <div class="FormulacioDenuncia">
                    <form action="../Controller/ControllerDenuncia.php" method="POST">
                        <label>Razon</label>
                        <select name="razon" >
                            <option value="" >ofensivo</option>	
                        </select>
                        <label>Bloquear hasta</label>
                        <input type="date" name="fecha" >
                        <label>Bloquear permanentemente</label>
                        <input type="checkbox" name="permanente" >
                        <input type="text" name="comentario" placeholder="Comentario" min="3" max="200">
                        <input type="hidden" name="idUsuario" value="" >
                        <input type="submit" name="bloquear"  value="Bloquear">
                        <input type="submit" name="rechazar" value="Rechazar">
                    </form>
                </div> 
            </li>   
            -->
        </ul>
    </div>
    
    <footer>
        <div>Iconos diseñados por <a href="http://www.flaticon.es/autores/chanut-is-industries" title="Chanut is Industries">Chanut is Industries</a> desde <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> con licencia <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
    </footer>
</body>
</html>
