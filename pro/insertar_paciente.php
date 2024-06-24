<?php
$servername = "localhost";
$username = "cobra";
$password = "xogJjqNFVP3-30eJ";
$dbname = "sistemadehospital";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los valores del formulario
$nombre = $_POST["nombres"];
$Apellidos = $_POST["apellido"];
$fechaNacimiento = $_POST["fecha_nacimiento"];
$estadoCivil = $_POST["estado_civil"];
$sexo = $_POST["sexo"];
$tipo_documento = $_POST["tipo_documento"];
$documento = $_POST["documento"];
$afiliadoArs = $_POST["afiliacion_ars"];
$telefono = $_POST["telefono"];
$paisOrigen = $_POST["pais_origen"];
$direccion = $_POST["direccion"];
$nss = $_POST["nss"];

// Generar un número único de 4 a 12 dígitos para "No-Record"
do {
    $new_no_record = sprintf('%04d', mt_rand(1000, 9999));
    $sql = "SELECT COUNT(*) FROM pacientes WHERE `No-Record` = ?";
    $sentencia = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($sentencia, "s", $new_no_record);
    mysqli_stmt_execute($sentencia);
    $result = mysqli_stmt_get_result($sentencia);
    $row = mysqli_fetch_assoc($result);
    $count = $row['COUNT(*)'];
} while ($count > 0);


// Preparar la consulta SQL
$sql = "INSERT INTO pacientes (Nombre, Apellidos, `Fecha de nacimiento`, `Estado civil`, Sexo, `Tipo de documento`, Documento, `Afiliado ars`, Telefono, `Pais de origen`, Direccion, `No-Record`, Nss)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$sentencia = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($sentencia, "sssssssssssss", $nombre, $Apellidos, $fechaNacimiento, $estadoCivil, $sexo, $tipo_documento, $documento, $afiliadoArs, $telefono, $paisOrigen, $direccion, $new_no_record, $nss);
mysqli_stmt_execute($sentencia);
$afectado = mysqli_stmt_affected_rows($sentencia);
if ($afectado == 1) {
    echo "<script> alert('El paciente [$nombre] se agregó correctamente'); location.href='index.php#seccion'; </script>";
} else {
    echo "<script> alert('El paciente [$nombre] no se agregó correctamente :( '); location.href='index.php'; </script>";
}
mysqli_stmt_close($sentencia);
mysqli_close($conn);

?>