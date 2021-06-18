<?php
include_once 'Crud.php';
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
                  <label class="control-label" for="productname">Nombre:</label>
                  <input type="text" class="form-control" id='productname' name="productname" placeholder="Nombre del producto" required value="<?php if (isset($_GET['editar'])) echo $getROW['nombre']; ?>" />
               </div>
            </div>

            <div class="form-row">
               <div class="form-group col-md-3">
                  <label class="control-label" for="descr">Descripción:</label>
                  <input type="text" class="form-control" name="descr" placeholder="Descripción del producto" value="<?php if (isset($_GET['editar'])) echo $getROW['descripcion'];  ?>" />
               </div>
            </div>

            <div class="form-row">
               <div class="form-group col-md-2">
                  <label class="control-label" for="Fingreso">Fecha de ingreso:</label>
                  <input type="date" class="form-control" name="Fingreso" placeholder="Fecha de ingreso del producto" required value="<?php if (isset($_GET['editar'])) echo $getROW['fIngreso'];  ?>" />
               </div>

               <div class="form-group col-md-2">
                  <label class="control-label" for="Fcad">Fecha de caducidad:</label>
                  <input type="date" class="form-control" name="Fcad" placeholder="Fecha de caducidad del producto" required value="<?php if (isset($_GET['editar'])) echo $getROW['fCaducidad'];  ?>" />
               </div>

               <div class="form-group col-md-2">
                  <label class="control-label" for="Fsal">Fecha de salida:</label>
                  <input type="date" class="form-control" name="Fsal" placeholder="Fecha de salida del producto" value="<?php if (isset($_GET['editar'])) echo $getROW['fSalida'];  ?>" />
               </div>
            </div>

            <div class="form-row">
               <div class="form-group col-md-1">
                  <label class="control-label" for="Cant">Cantidad:</label>
                  <input type="float" class="form-control" name="Cant" placeholder="Cantidad" required value="<?php if (isset($_GET['editar'])) echo $getROW['cantidad'];  ?>" />
                  <div class="invalid-feedback">
                     No se admiten caracteres.
                  </div>
               </div>

               <div class="form-group col-md-2">
                  <label class=""></label>
                  <select class="form-control">
                     <option selected value="1"> Seleccione una unidad: </option>
                     <option value="2">Litros</option>
                     <option value="3">Piezas</option>
                     <option value="4">Kilogramos</option>
                  </select>
               </div>
            </div>

            <div class="form-row">
               <div class="form-group col-md-1">
                  <label class="control-label" for="per">Perecedero:</label>
                  <input type="int" class="form-control" name="per" placeholder="Perecedero" required value="<?php if (isset($_GET['editar'])) echo $getROW['perecedero'];  ?>" />
                  <div class="invalid-feedback">
                     No se admiten caracteres.
                  </div>
               </div>

               <div class="form-group col-md-1">
                  <label class="control-label" for="idAbasto">ID abasto:</label>
                  <input type="int" class="form-control" name="idAbasto" placeholder="ID abasto" required value="<?php if (isset($_GET['editar'])) echo $getROW['Abasto_idAbasto'];  ?>" />
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
      <h3>Listado de productos</h3>

      <table class="table table-responsive table-hover table-bordered shadow p-2 mb-2 bg-danger rounded ">
         <tr>
            <th>Editar</th>
            <th>Eliminar</th>
            <th>ID</th>
            <th>Nombre del producto</th>
            <th>Descripción</th>
            <th>Fecha de ingreso</th>
            <th>Fecha de caducidad</th>
            <th>Fecha de salida</th>
            <th>Cantidad</th>
            <th>Perecedero</th>
            <th>ID de abasto</th>
         </tr>

         <?php
         $res = $MySQLiconn->query("SELECT * FROM productos");
         while ($row = $res->fetch_array()) {
         ?>
            <tr>
               <td>
                  <a href="?editar=<?php echo $row['idProductos']; ?>" onclick="return confirm('¿Desea editarlo?'); ">
                     <span class="glyphicon glyphicon-pencil"></span>
                  </a>
               </td>
               <td>
                  <a href="?eliminar=<?php echo $row['idProductos']; ?>" onclick="return confirm('¿Desea eliminarlo?'); ">
                     <span class="glyphicon glyphicon-remove"></span>
                  </a>
               </td>
               <td> <?php echo $row[0]; ?> </td>
               <td> <?php echo $row[1]; ?> </td>
               <td> <?php echo $row[2]; ?> </td>
               <td> <?php echo $row[3]; ?> </td>
               <td> <?php echo $row[4]; ?> </td>
               <td> <?php echo $row[5]; ?> </td>
               <td> <?php echo $row[6]; ?> </td>
               <td> <?php echo $row[7]; ?> </td>
               <td> <?php echo $row[8]; ?> </td>

            </tr>
         <?php
         }
         ?>
      </table>

   </div>
   <br><br>
</body>

</html>