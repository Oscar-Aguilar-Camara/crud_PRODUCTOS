<?php

include_once 'Db.php';

/* Codigo para Insertar Datos */
if (isset($_POST['guardar'])) {

  echo "Guardando...";
  $productname = $MySQLiconn->real_escape_string($_POST['productname']);
  $descr = $MySQLiconn->real_escape_string($_POST['descr']);
  $Fingreso = $MySQLiconn->real_escape_string($_POST['Fingreso']);
  $Fcad = $MySQLiconn->real_escape_string($_POST['Fcad']);
  $Fsal = $MySQLiconn->real_escape_string($_POST['Fsal']);
  $Cant = $MySQLiconn->real_escape_string($_POST['Cant']);
  $per = $MySQLiconn->real_escape_string($_POST['per']);
  $idAbasto = $MySQLiconn->real_escape_string($_POST['idAbasto']);


  $SQL = $MySQLiconn->query("INSERT INTO productos(idProductos, nombre, descripcion, fIngreso, fCaducidad, fSalida, cantidad, perecedero, Abasto_idAbasto)  
    VALUES(NULL,'$productname','$descr','$Fingreso','$Fcad',NULL,'$Cant','$per','$idAbasto')");


  if (!$SQL) {
    echo $MySQLiconn->error;
  }
  header("Location:index.php");
}

/* Codigo para eliminar Datos */
if (isset($_GET['eliminar'])) {
  $SQL = $MySQLiconn->query("DELETE FROM `productos` WHERE `productos`.`idProductos` = " . $_GET['eliminar']);
  header("Location:index.php");
}


/* Codigo para Editar Datos */
if (isset($_GET['editar'])) {
  $SQL = $MySQLiconn->query("SELECT * FROM `productos` WHERE `productos`.`idProductos`=" . $_GET['editar']);
  $getROW = $SQL->fetch_array();
}

/* Codigo para Actualizar Datos */
if (isset($_POST['actualizar'])) {

    $SQL = $MySQLiconn->query(
    "UPDATE productos SET nombre='"
      . $_POST['productname']
      . "', descripcion='"
      . $_POST['descr']
      . "',fIngreso='"
      . $_POST['Fingreso']
      . "',fCaducidad='"
      . $_POST['Fcad']
      . "',fSalida='"
      . $_POST['Fsal']
      . "',cantidad='"
      . $_POST['Cant']
      . "',perecedero='"
      . $_POST['per']
      . "',Abasto_idAbasto='"
      . $_POST['idAbasto']
      . "' WHERE idProductos="
      . $_GET['editar']
  );
  header("Location:index.php");
}
