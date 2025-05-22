<?php
include("db.php");

$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$itebis = $_POST['itebis'];
$descuento = $_POST['descuento'];

$sql = "INSERT INTO Facturas (Descripcion, Categoria, Cantidad, PrecioUnitario, ITEBIS, Descuento) 
        VALUES ('$descripcion', '$categoria', $cantidad, $precio, $itebis, $descuento)";

$conexion->query($sql);
header("Location: reporte.php"); // Redirigir al reporte
exit();
?>
