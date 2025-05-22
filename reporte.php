<?php
include("db.php");
$sql = "SELECT * FROM Facturas";
$result = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Facturas</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #001F3F, #003366);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }
        .container {
            background-color: #0a0a0add;
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 1100px;
            box-shadow: 0 0 15px #00ccff55;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #00ccff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #00ccff33;
        }
        th {
            background-color: #003366;
            color: #00ccff;
        }
        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.05);
        }
        a {
            color: #00ccff;
            text-decoration: none;
            margin: 0 5px;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .btn {
            padding: 6px 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            color: white;
            font-weight: bold;
            text-decoration: none;
        }
        .editar { background-color: #00bfff; }
        .eliminar { background-color: #ff3333; }
        .volver {
            display: inline-block;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Reporte de Facturas</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th>Categoría</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>ITEBIS</th>
            <th>Descuento</th>
            <th>Total General</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['Id'] ?></td>
            <td><?= $row['Descripcion'] ?></td>
            <td><?= $row['Categoria'] ?></td>
            <td><?= $row['Cantidad'] ?></td>
            <td><?= $row['PrecioUnitario'] ?></td>
            <td><?= $row['ITEBIS'] ?></td>
            <td><?= $row['Descuento'] ?></td>
            <td><?= $row['TotalGeneral'] ?></td>
            <td>
                <a href="editar.php?id=<?= $row['Id'] ?>" class="btn editar">Editar</a>
                <a href="eliminar.php?id=<?= $row['Id'] ?>" class="btn eliminar" onclick="return confirm('¿Seguro que deseas eliminar esta factura?');">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <div class="volver">
        <a href="REPORTE1.php">Ver reporte</a>
    </div>
</div>

</body>
</html>
