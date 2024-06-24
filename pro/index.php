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

<!DOCTYPE >
<html >

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital</title>

    <link rel="stylesheet" href="css/e.css">

    <!-- scripts(js)  datatable y css -->
    <script> src="Prof/js.json"</script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish_Mexico.json" defer></script>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

 </head>

 <script>
  
  $(document).ready(function() {
  $('#example').DataTable({
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
    },
    pageLength: 10,
    lengthMenu: [10, 15, 20, 25, 30, 50, 75, 100],
    dom: 'Bfrtilp',
    buttons: [
      {
        extend: 'print',
        text: '<i class="fas fa-print"></i> Imprimir',
        titleAttr: 'Imprimir',
        className: 'btn btn-danger',
        customize: function (win) {
          $(win.document.body)
            .css('font-size', '10pt');

          $(win.document.body).find('table')
            .addClass('compact')
            .css('font-size', '9pt');

          // Agregar el logo
          $(win.document.body).prepend(
            '<div style="text-align:left; margin-bottom:20px;">' +
            '<img src="im/lo.svg" alt="Logo de la empresa" style="max-width:150px;" />' +
            '</div>'
          );

          // Cambiar el color de fondo del encabezado (thead) a azul
          $(win.document.body).find('table thead').css('background-color', '#3498DB');
        }
      },
      {
        extend: 'excelHtml5',
        text: '<i class="fa-solid fa-file-excel"></i></i> Excel',
        titleAttr: 'Exportar a Excel',
        className: 'btn btn-success'
        
      }
    ],
    
    initComplete: function() {
      $('.dataTables_length').addClass('mb-3').css('padding', '10px');
    }
  });
});


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

});
    </script>

<body>

<?php include 'header.php'; ?>

    <main>

    <h1 class="h1"><span>P</span>acientes</h1>

      
         <!-- botones de modal y imprimir -->

    <div class="btn-group" role="group" aria-label="Basic mixed styles example" id="boton">
        <button type="button"  class= "btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal" id=""><i class="fa-solid fa-person"></i>  Nuevo pacientes</button>
     </div>

     <!-- Tabla de pacientes -->

    <div  class="container" >
    <div class="table-responsive">

     <table id="example" class="display responsive nowrap" style="width: 190px;%">
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
 </main>
         
 
<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="modal-header">
        <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Agregar paciente</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body">
      <form id="addUser"  action="insertar_paciente.php" method="POST">
            <div class="mb-3 row">
              <label for="addUserField" class="col-md-3 form-label">Nombre</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="nombres"  placeholder="escribe aqui nombre " required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addEmailField" class="col-md-3 form-label">Apellido</label>
              <div class="col-md-9">
                <input type="text" class="form-control"  name="apellido"  placeholder="escribe aqui Apellido " required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addMobileField" class="col-md-3 form-label">Fecha de nacimiento</label>
              <div class="col-md-9">
                <input type="date" class="form-control"  name="fecha_nacimiento"  placeholder="escribe aqui Fecha de nacimiento" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addCityField" class="col-md-3 form-label">Estado civil</label>
              <div class="col-md-9">
              <select id="estado_civil" name="estado_civil" class="form-control" required>
               <option value="Soltero(a)">Soltero(a)</option>
              <option value="Casado(a)">Casado(a)</option>
              <option value="Divorciado(a)">Divorciado(a)</option>
              <option value="viudo(a)">Viudo(a)</option>
              </select>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="addUserField" class="col-md-3 form-label">Sexo</label>
              <div class="col-md-9">
              <select id="sexo" name="sexo" class="form-control" required>
               <option value="M">M</option>
              <option value="F">F</option>
             </select>
        
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addEmailField" class="col-md-3 form-label">Tipo de documento</label>
              <div class="col-md-9">
              <select id="tipo_documento" name="tipo_documento" class="form-control"  required>
               <option value="cedula">Cédula</option>
               <option value="pasaporte">Pasaporte</option>
               <option value="otro">Otro</option>
             </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addMobileField" class="col-md-3 form-label">Documento</label>
              <div class="col-md-9">
                <input type="text" class="form-control"  name="documento"  placeholder="escribe aqui Documento " required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addCityField" class="col-md-3 form-label">Afiliado ars</label>
              <div class="col-md-9">
                <input type="text" class="form-control"  name="afiliacion_ars"  placeholder="escribe aqui filiado ars" required>
              </div>

            </div>
            <div class="mb-3 row">
              <label for="addEmailField" class="col-md-3 form-label">Telefono</label>
              <div class="col-md-9">
                <input type="tel" class="form-control"  name="telefono"  placeholder="escribe aqui Telefono" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addMobileField" class="col-md-3 form-label">Pais de origen</label>
              <div class="col-md-9">
                <input type="text" class="form-control"  name="pais_origen"  placeholder="escribe aqui Pais de origen" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addCityField" class="col-md-3 form-label">Direccion</label>
              <div class="col-md-9">
                <input type="text" class="form-control"  name="direccion"  placeholder="escribe aqui Direccion" required>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="addUserField" class="col-md-3 form-label">NSS</label>
              <div class="col-md-9">
                <input type="text" class="form-control"  name="nss"  placeholder="escribe aqui el Nss" required>
              </div>
            </div>
            <hr>
            <input type="submit" value="Guardar" class="btn btn-success" id="insertBtn">
             <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          </form>
      </div>
    </div>
  </div>
</div>
                </article>
            </div>   
        </section>
    </div>

    
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

</body>
</html>


<!--Echo por Roderlis mendez valdez estudiante del politecnico nuestra señora de la esperanza -->
