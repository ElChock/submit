<?php
include "../Model/Usuario.php";
include_once '../Dao/DaoUsuario.php';
include_once '../Model/V_bloqueado.php';

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

$daoUsusuario=new DaoUsuario();
$razonBloqueado= new V_bloqueado();
$usuario = new Usuario();
$razonBloqueado=$daoUsusuario->RazonBloqueado($usuarioSesion->getIdUsuario());
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Submit</title>
<link href="../CSS/CSSLogin.css" rel="stylesheet" type="text/css">
<script>
    
    

</script>
</head>

<body>

    <header>
        <div>
            <a><h1>S</h1></a>

        </div>
    </header>   

    <li class="PostDenuncia">
        <div class="PerfilPost">
            <a class="ProfilePicturePost">
                <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($usuarioSesion->getFotoPerfil()).''; ?>" alt="Profile" picture="">
            </a>
            <p class="NombrePerfilPost"><?php echo $usuarioSesion->getNombre() ?></p>
        </div>
       <!-- <p class="TituloPost">buuuuuu</p>
        <img src="../Multimedia/1479922390.png" alt="Publicacion">-->
        <div class="FormulacioDenuncia">
            
                <label>Razon</label>
                <label><?php echo $razonBloqueado->getRazon() ?></label>
                <label>Bloquear hasta</label>
                <label><?php echo $razonBloqueado->getFecha() ?></label>
                <label>Bloquear permanentemente</label>
                <label><?php echo $razonBloqueado->getPermanente() ?></label>
                <label>Comentario</label>
                <label><?php echo $razonBloqueado->getDescripcion() ?></label> 
                
                
                
            
        </div>
    </li>
    
</body>
</html>