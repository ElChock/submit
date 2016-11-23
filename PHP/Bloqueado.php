
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
          <a href="../Principal.php"><h1>S</h1></a>
          <form class="HeaderLogin" action="../../submit/Controller/ControllerLogin.php" method="POST">
              <input type="email" required name="email" placeholder="correo">
              <input type="password" required name="contraseña" placeholder="Contraseña" min="8" >
              <input type="submit" name="login" class="BotonAceptar" formmethod="POST" value="Ingresar" onMouseOver="Actualizar(20)" >    
        </form>
        </div>
    </header>   

</body>
</html>