<?php
include("db.php");

$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$itebis = $_POST['itebis'];
$descuento = $_POST['descuento'];

$sql = "UPDATE Facturas SET 
        Descripcion='$descripcion',
        Categoria='$categoria',
        Cantidad=$cantidad,
        PrecioUnitario=$precio,
        ITEBIS=$itebis,
        Descuento=$descuento
        WHERE Id=$id";

$conexion->query($sql);
header("Location: reporte.php");
?>
