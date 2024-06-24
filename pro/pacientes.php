<?php

$servername = "localhost";
$username = "cobra";
$password = "xogJjqNFVP3-30eJ";
$dbname = "sistemadehospital";

$conexion = mysqli_connect($servername, $username, $password, $dbname);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

?>  

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital</title>

    <!-- CSS Personalizado -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css_paciente/style__.css">
    <link href="CSS/estilo.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/esp.css">

    

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <!-- scripts(js) de datatable y css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish_Mexico.json" defer></script>


 </head>

 <script>

        $(document).ready( function () {
            $('#example').DataTable(
                {
                "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
                }
                }
            );}
            );

            // ...

// Cerrar la ventana modal y recargar la página cuando se hace clic en el botón de agregar
agregarPaciente.addEventListener("click", function() {
  // ...
  
  // Enviar una solicitud AJAX al servidor
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "insertar_paciente.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.status === "success") {
          // Cerrar la ventana modal
          modal.style.display = "none";
          location.reload("http://localhost/v/index.php"); // Recargar la página
        } else {
          // Mostrar un mensaje de error
          console.error(response.message);
        }
      } else {
        // Mostrar un mensaje de error
        console.error("Error al realizar la solicitud AJAX");
      }
    } 
  };
  xhr.send();

  // ...
});
    </script>

<body>

<?php include  'header.php'; ?>

<h1>Pacientes</h1>

    <!-- Tabla de pacientes -->
    <div  class="container" >
    <div class="table-responsive">

   <table id="example" class="display responsive nowrap" style="width:100%">
        <thead>
        <tr>
             <th>id</th>
             <th>Nombres</th>
             <th>Apellido</th>
             <th>Fecha de nacimiento</th>
             <th>Estado civil</th>
             <th>Sexo</th>
             <th>Tipos de documentos</th>
             <th>Documento</th>
             <th>Afiliado ARS</th>
             <th>Teléfono</th>
             <th>País de origen</th>
             <th>Dirección</th>
             <th>No-Record</th>
             <th>NSS</th>
        </tr>
        </thead>
        <tbody id="tableBody">
<?php
$sql = "SELECT * FROM `pacientes`";
$result = mysqli_query($conexion, $sql);

while ($mostrar = mysqli_fetch_array($result)) {
?>
    <tr>
        <td><?php echo $mostrar['id_pacientes'] ?></td>
        <td><?php echo $mostrar['Nombre'] ?></td>
        <td><?php echo $mostrar['Apellidos'] ?></td>
        <td><?php echo $mostrar['Fecha de nacimiento'] ?></td>
        <td><?php echo $mostrar['Estado civil'] ?></td>
        <td><?php echo $mostrar['Sexo'] ?></td>
        <td><?php echo $mostrar['Tipo de documento'] ?></td>
        <td><?php echo $mostrar['Documento'] ?></td>
        <td><?php echo $mostrar['Afiliado ars'] ?></td>
        <td><?php echo $mostrar['Telefono'] ?></td>
        <td><?php echo $mostrar['Pais de origen'] ?></td>
        <td><?php echo $mostrar['Direccion'] ?></td>
        <td><?php echo $mostrar['No-Record'] ?></td>
        <td><?php echo $mostrar['Nss'] ?></td>
    </tr>
<?php
}
?>
</tbody>
    </table>

    </div>

</div>

</body>
</html>


<!--Echo por Roderlis mendez valdez estudiante del politecnico nuestra señora de la esperanza -->
