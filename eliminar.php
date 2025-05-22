<?php
include("db.php");
$id = $_GET['id'];

$sql = "DELETE FROM Facturas WHERE Id=$id";
$conexion->query($sql);
header("Location: reporte.php");
?>
