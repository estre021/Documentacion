<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Factura</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #001F3F, #003366);
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #0a0a0aee;
            border-radius: 20px;
            padding: 40px;
            max-width: 800px;
            width: 90%;
            box-shadow: 0 0 20px rgba(0, 204, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        h2 {
            text-align: center;
            color: #00ccff;
            margin-bottom: 30px;
            font-size: 32px;
        }

        form input[type="text"],
        form input[type="number"],
        form button {
            width: 100%;
            padding: 12px 15px;
            margin: 12px 0;
            border-radius: 10px;
            border: none;
            font-size: 16px;
            box-sizing: border-box;
        }

        form input[type="text"],
        form input[type="number"] {
            background-color: #ffffff10;
            border: 1px solid #00ccff;
            color: white;
        }

        form input:focus {
            outline: none;
            box-shadow: 0 0 10px #00ccff80;
        }

        form button {
            background: linear-gradient(to right, #0066cc, #00ccff);
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        form button:hover {
            background: linear-gradient(to right, #0055a5, #00bfff);
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Registrar Factura</h2>
    <form action="agregar.php" method="POST">
        <label>Descripción:</label>
        <input type="text" name="descripcion" required>

        <label>Categoría:</label>
        <input type="text" name="categoria" required>

        <label>Cantidad:</label>
        <input type="number" name="cantidad" required>

        <label>Precio Unitario:</label>
        <input type="number" step="0.01" name="precio" required>

        <label>ITEBIS:</label>
        <input type="number" step="0.01" name="itebis" required>

        <label>Descuento:</label>
        <input type="number" step="0.01" name="descuento" required>

        <button type="submit">Agregar</button>
    </form>
</div>

</body>
</html>
