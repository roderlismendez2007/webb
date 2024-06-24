<?php
$conexion= mysqli_connect("localhost", "cobra", "xogJjqNFVP3-30eJ", "sistemadehospital");

if(isset($_POST['registrar'])){

    if(strlen($_POST['nombre']) >=1 && strlen($_POST['telefono'])  >=1 
    && strlen($_POST['password'])  >=1 && strlen($_POST['rol']) >= 1 ){

    $nombre = trim($_POST['nombre']);
    $telefono = trim($_POST['telefono']);
    $password = trim($_POST['password']);
    $rol = trim($_POST['rol']);

    $consulta= "INSERT INTO user (nombre, telefono, password, rol)
    VALUES ('$nombre', '$telefono','$password', '$rol' )";

    mysqli_query($conexion, $consulta);
    mysqli_close($conexion);

    header('Location: ../views/user.php');
  }
}









?>

<!--Echo por Roderlis mendez valdez estudiante del politecnico nuestra señora de la esperanza -->
