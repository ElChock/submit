
<?php
include_once '../Model/Usuario.php';
session_start();
if($_SESSION["usuario"]==null)
{
    header('Location: ../PHP/Login.php');
}
$usuario= new Usuario();
$s=$_SESSION["usuario"];
$usuario=  unserialize($s);
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
        <input type="file" name="portada" accept="image/*">
        <input type="submit" name="fotoPortada" value="subir">
        </form>
    </div>
    <div class="AvatarPortada">
        <form action="../Controller/ControllerDatosPersonales.php" method="POST" enctype="multipart/form-data">
            <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($usuario->getFotoPerfil()).''; ?>" alt="Profile Picture">
        <input type="file" name="perfil" accept="image/*">
        <input type="submit" name="fotoPerfil" value="subir">
        </form>
    </div>
    <!-- cuenta publica o privada-->
    <form action="../Controller/ControllerDatosPersonales.php" method="POST">
        <div class="DatosPersonalesTipoPerfil">
            <label>Perfil</label>
            <label>Publico</label>
            <input type="radio" <?php if($usuario->getPublico()=="s") {echo 'checked';} ?>  name="Perfil" value="s">
            <label>Privado</label>
            <input type="radio" <?php if($usuario->getPublico()=="n"){ echo 'checked';} ?>  name="Perfil" value="n" >
            <input type="submit" name="publico" value="Guardar">
        </div>
    </form>
    <form action="../Controller/ControllerDatosPersonales.php" method="POST" >
        <div class="DatosPersonales">
            
            <label>Descripcion</label>
            <input type="text" value="<?php echo $usuario->getDescripcion() ?>" name="descripcion" min="3" max="300">
            <label>Nombre</label>
            <input type="text" value="<?php echo $usuario->getNombre() ?>" name="nombre" min="4" max="50">
            <label>Apellido Paterno</label>
            <input type="text" value="<?php echo $usuario->getApellidoPaterno() ?>" name="apellidoPaterno" min="4" max="50">
            <label>Apellido Materno</label>
            <input type="text" value="<?php echo $usuario->getApellidoMaterno() ?>" name="apellidoMaterno" min="4" max="50">        
            <label>Municipio</label>
            <input type="text" value="<?php echo $usuario->getMunicipio()?>" name="municipio" min="3" max="50">
            <label>Estado</label>
            <input type="text" value="<?php echo $usuario->getEstado() ?>" name="estado" min="3" max="50">
            <input type="submit" name="datosPersonales" value="Guardar">
        </div>
    </form>
        <footer>
        <div>Iconos diseñados por <a href="http://www.flaticon.es/autores/chanut-is-industries" title="Chanut is Industries">Chanut is Industries</a> desde <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> con licencia <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
    </footer>
</body>
</html>