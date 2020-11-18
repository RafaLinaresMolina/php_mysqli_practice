<?php

// Check empty fields from post
function chechErrors(): array
{
  $sumErrors = [];
  foreach ($_POST as $key => $value) {
    if (empty($value)) {
      $sumErrors[$key] = $key . " is empty";
    }
  }
  return $sumErrors;
}

// Prepare the value part of the sql query
function getValues($values): string{
  $string = "";
  $count = 0;
  foreach ($values as $key => $value) {
    if($count === 0)
    $string .= "'".$value."'";
    else
    $string .= ",'".$value."'";
    $count++;
  }
  return $string;
}

// Make the conexion to mysql
function connectionToMySQL(){
  // Change this
  $enlace = mysqli_connect("127.0.0.1", "username", "password", "database");

    if (!$enlace) {
      echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
      echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
      exit;
    }
    echo "Éxito: Se realizó una conexión apropiada a MySQL!<br/>";
    return $enlace;
}

//close connection
function closeConnectionToMySQL($enlace){
  mysqli_close($enlace);
}

//Make an insert on the database
function insert($enlace, $sql){
  $result = "";
  if ($enlace->query($sql) === TRUE) {
    $result = "New record created successfully";
  } else {
    $result = "Error: " . $sql . "<br>" . $enlace->error;
  }
  return $result;
}

//check if there is a method POST done
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $errors = chechErrors();
  $location = "/?error=true";


  if (count($errors) !== 0) {
    //There are errors, so we go back to index.php
    foreach ($errors as $key => $value) {
      $location .= '&' . $key . '=' . 'true';
    }
    header("Location: " . $location);
  } else {
    //All ok, try to do the insert
    $enlace = connectionToMySQL();

    $values = getValues($_POST);
    $values .= ", 1";
    $sql = "INSERT INTO `User` (`name`, last_name, email, `password`, rol_id) VALUES ($values)";
    echo insert($enlace, $sql);
   
    closeConnectionToMySQL($enlace);
  }
}
?>

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
  <nav class="navbar navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">Usuarios registrados</span>
  </nav>
  <div class="container-fluid">

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido 1</th>
          <th scope="col">Email </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td><?= $_POST['name'] ?></td>
          <td><?= $_POST['last_name'] ?></td>
          <td><?= $_POST['email'] ?></td>
        </tr>
      </tbody>
    </table>
    <?php
    print_r($_POST)
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>