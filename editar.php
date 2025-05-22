<?php
include("db.php");

$id = $_GET['id'];
$sql = "SELECT * FROM Facturas WHERE Id=$id";
$result = $conexion->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Factura</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #001F3F, #003366);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: rgba(0,0,0,0.8);
            padding: 40px;
            border-radius: 25px;
            width: 110%;
            max-width: 700px;
            box-shadow: 0 0 15px #00ccff55;
        }
        h2 {
            text-align: center;
            color: #00ccff;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"],
        input[type="number"],
        button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 6px;
            border: none;
        }
        button {
            background-color: #00bfff;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #009fd1;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            color: #00ccff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Editar Factura</h2>
    <form action="actualizar.php" method="POST">
        <input type="hidden" name="id" value="<?= $row['Id'] ?>">
        <input type="text" name="descripcion" value="<?= $row['Descripcion'] ?>" required>
        <input type="text" name="categoria" value="<?= $row['Categoria'] ?>" required>
        <input type="number" name="cantidad" value="<?= $row['Cantidad'] ?>" required>
        <input type="number" step="0.01" name="precio" value="<?= $row['PrecioUnitario'] ?>" required>
        <input type="number" step="0.01" name="itebis" value="<?= $row['ITEBIS'] ?>" required>
        <input type="number" step="0.01" name="descuento" value="<?= $row['Descuento'] ?>" required>
        <button type="submit">Actualizar</button>
    </form>
    <a href="reporte.php">← Volver al Reporte</a>
</div>

</body>
</html>
