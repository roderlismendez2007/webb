<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "usuario", "contraseña", "nombre_base_de_datos");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los datos del formulario
$patientId = $_POST['patientId'];
$name = $_POST['name'];
// Obtener los demás datos del formulario

// Actualizar los datos del paciente en la base de datos
$sql = "UPDATE pacientes SET Nombre = ?, Apellidos = ?, ... WHERE id_pacientes = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssi", $name, $apellidos, $patientId);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}

$stmt->close();
$conexion->close();
?>