

<?php
    include_once '../Dao/DaoPais.php';
    include_once  '../Model/Pais.php';
    include_once '../Dao/DaoPregunta.php';
    include_once '../Model/Pregunta.php';
    $daoPais=new DaoPais();
    $listaPais=$daoPais->sp_obtenerPais();
    
    $daoPregunta= new DaoPregunta();
    $listaPregunta = $daoPregunta->obtenerPreguntas();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link href="../CSS/CSSLogin.css" rel="stylesheet" type="text/css">
<script>
    
    

</script>
</head>

<body>

	<header>
        <div>
          <a href="../Principal.php"><h1>S</h1></a>
          <form class="HeaderLogin" action="../../submit/Controller/ControllerLogin.php" method="POST">
              <input type="email" required name="email" placeholder="Usuario">
              <input type="password" required name="contraseña" placeholder="Contraseña" min="8" >
              <input type="submit" name="login" class="BotonAceptar" formmethod="POST" value="Ingresar" onMouseOver="Actualizar(20)" >    
        </form>
        </div>
    </header>

<div class="Registrar">
<div >
	<p>¿No tienes una cuenta? 
            Registrate
        </p>
</div>
<div>
    <form action="../../submit/Controller/ControllerLogin.php" method="post">
            <input type="text" required name="nombre" placeholder="Nombre" maxlength="50">
            <input type="text" required name="apellido" placeholder="Apellido" maxlength="50">
            
            <input type="text" id="Salto" required name="nickname" placeholder="Nickname" maxlength="50">
            
            <input type="date" id="Salto" required name="date" min="1910-01-01" max="1998-01-01" >
            <select title="pais" name="pais" id="Salto">                    
                
                <?php
                for ($index=0;$index<count($listaPais);$index++)
                {
                    echo "<option value="; echo $listaPais[$index]->getIdPais(); echo">" ;echo $listaPais[$index]->getNombre();echo"</option>" ;
                }
                ?>
            </select>
            
            <select title="pregunta" name="idpregunta">
                <?php
                for($index=0;$index<count($listaPregunta);$index++)
                {
                     echo "<option value="; echo $listaPregunta[$index]->getIdPregunta(); echo">" ;echo $listaPregunta[$index]->getDescripcion();echo"</option>" ;
                }
                ?>
            </select>
            <input type="text" required name="respuesta" placeholder="Respuesta" maxlength="100" id="Salto">
            <label id="Salto" >Genero</label>
            <label>Masculino</label>
            <input type="radio"  name="genero" value="m">
            <label>Femenino</label>
            <input type="radio"  name="genero" value="f"  >
            <input type="email" required name="correo" placeholder="Correo" id="Salto">
            <input type="password" required name="contraseña" placeholder="Contraseña" min="8" maxlength="12">
            <input type="submit" name="registro"  formmethod="POST">
            
	</form>
</div>
</div>
    

</body>
</html>