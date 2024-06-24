<?php
$host = "localhost";
$user = "cobra";
$password = "xogJjqNFVP3-30eJ";
$database = "sistemadehospital";


$conexion = mysqli_connect($host, $user, $password, $database);
if(!$conexion){
echo "No se realizo la conexion a la basa de datos, el error fue:".
mysqli_connect_error() ;

}

?>

<!--Echo por Roderlis mendez valdez estudiante del politecnico nuestra señora de la esperanza -->
