<?php
include_once 'crudPersonal.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <title>Gestor de inventario</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/darkly/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
   </script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
   </script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script>
      $(document).ready(function() {
         $("#show").click(function() {
            $("#formulario").slideToggle("slow");
         });
      });
   </script>

   <?php
   if (isset($_GET['editar'])) {
   ?>
   <?php
   } else { ?>
      <style>
         #formulario {
            display: none;
         }
      </style>
   <?php } ?>
   <link rel="stylesheet" type="text/css" href="../css/estilo5.css">

</head>

<body>

   <div class="">
      <div class="container text-center">
         <h1>Los Nobles</h1>
      </div>
   </div>


   <button id="show" class="btn btn-outline-primary" name="insert">Insertar</button>


   <div class="container-fluid ">
      <div id="formulario">
         <form method="post">
            <div class="form-row">
               <div class="form-group col-md-3">
                  <label class="control-label" for="nombre">Nombre:</label>
                  <input type="text" class="form-control" id='nombre' name="nombre" placeholder="Nombre del usuario" required value="<?php if (isset($_GET['editar'])) echo $getROW['nombre']; ?>" />
               </div>
            </div>

            <div class="form-row">
               <div class="form-group col-md-3">
                  <label class="control-label" for="apellidoP">Apellido paterno:</label>
                  <input type="text" class="form-control" name="apellidoP" placeholder="Apellido paterno" value="<?php if (isset($_GET['editar'])) echo $getROW['apellidoP'];  ?>" />
               </div>
            </div>

            <div class="form-row">
               <div class="form-group col-md-2">
                  <label class="control-label" for="apellidoM">Apellido materno:</label>
                  <input type="text" class="form-control" name="apellidoM" placeholder="Apellido materno" required value="<?php if (isset($_GET['editar'])) echo $getROW['apellidoM'];  ?>" />
               </div>

               <div class="form-group col-md-2">
                  <label class="control-label" for="email">Correo electrónico:</label>
                  <input type="text" class="form-control" name="email" placeholder="E-mail" required value="<?php if (isset($_GET['editar'])) echo $getROW['email'];  ?>" />
               </div>

               <div class="form-group col-md-2">
                  <label class="control-label" for="contraseña">Contraseña:</label>
                  <input type="text" class="form-control" name="contraseña" placeholder="Contraseña" value="<?php if (isset($_GET['editar'])) echo $getROW['contraseña'];  ?>" />
               </div>
            </div>

            <div class="form-group">
               <?php
               if (isset($_GET['editar'])) {
               ?>
                  <div class="col-12">
                     <button type="submit" class="btn btn-primary" name="actualizar">Actualizar</button>
                  </div>
               <?php
               } else {
               ?>
                  <div class="col-12">
                     <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
                  </div>
               <?php
               }
               ?>
            </div>
         </form>
      </div>
      <h3>Listado de usuarios</h3>

      <table class="table table-responsive table-hover table-bordered shadow p-2 mb-2 bg-danger rounded ">
         <tr>
            <th>Editar</th>
            <th>Eliminar</th>
            <th>ID</th>
            <th>Nombre(s)</th>
            <th>Apellido paterno</th>
            <th>Apellido materno</th>
            <th>Correo electrónico</th>
            <th>Contraseña</th>
         </tr>

         <?php
         $res = $MySQLiconn->query("SELECT * FROM personal");
         while ($row = $res->fetch_array()) {
         ?>
            <tr>
               <td>
                  <a href="?editar=<?php echo $row['idPersonal']; ?>" onclick="return confirm('¿Desea editarlo?'); ">
                     <span class="glyphicon glyphicon-pencil"></span>
                  </a>
               </td>
               <td>
                  <a href="?eliminar=<?php echo $row['idPersonal']; ?>" onclick="return confirm('¿Desea eliminarlo?'); ">
                     <span class="glyphicon glyphicon-remove"></span>
                  </a>
               </td>
               <td> <?php echo $row[0]; ?> </td>
               <td> <?php echo $row[1]; ?> </td>
               <td> <?php echo $row[2]; ?> </td>
               <td> <?php echo $row[3]; ?> </td>
               <td> <?php echo $row[4]; ?> </td>
               <td> <?php echo $row[5]; ?> </td>
            </tr>
         <?php
         }
         ?>
      </table>

   </div>
   <br><br>
</body>

</html>