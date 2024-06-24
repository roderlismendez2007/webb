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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/e.css">

            <!-- icono-->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <!-- scripts(js) de datatable y css -->
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish_Mexico.json" defer></script>


     <!-- bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
</script>

<body>

<main>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="https://hospitalvillamella.gob.do">Hospital</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/prof/usuario/views/user.php">Salir</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

    <h1 class="h1"><span>P</span>acientes</h1>

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
             <th>Accion</th>
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
        <td><button type="button"  class= "btn btn-danger" data-bs-toggle="modal" data-bs-target="#editModal" id=""> Editar</button></td>

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
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Paciente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Formulario de edición -->
        <form id="editForm">
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
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="guardarCambios()">Guardar Cambios</button>
      </div>
    </div>
  </div>
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