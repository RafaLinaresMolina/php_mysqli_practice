<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<title>Registro de App</title>
</head>

<body style="margin: 0">
  <!-- As a heading -->

  <div class="container-fluid">

    <nav class="navbar navbar-light bg-light">
      <span class="navbar-brand mb-0 h1">Registrate!</span>
    </nav>
    <?php
    if (!empty($_GET)) {
      // Check if there are any erros and print it.
      if ($_GET['error'])
        foreach ($_GET as $key => $value) {
          if ($key !== 'error')
            echo '<div class="alert alert-danger" role="alert">
      El campo "' . $key . '" esta vacío </div>';
        }
    }
    ?>
    <form class="registerForm" action="./registro.php" method="post">
      <div class="form-group">
        <div class="form-group">
          <label>Nombre: </label> <input class="form-control" type="text" name="name" id="name">
        </div>
        <div class="form-group">
          <label>Apellido 1: </label> <input class="form-control" type="text" name="last_name" id="last_name">
        </div>
        <div class="form-group">
          <label>Email: </label> <input class="form-control" type="email" name="email" id="email">
        </div>
        <div class="form-group">
          <label>Contraseña : </label><input class="form-control" type="password" name="password" id="password">
        </div>

        <button type="submit" class="btn btn-primary"> Registrar </buton>
      </div>

  </div>
  </form>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>