# 🧾 Documentación del Sistema de Facturación en PHP

# ✅ 1. Requisitos previos
### Antes de iniciar, asegúrate de tener instalado:

- XAMPP o WAMP (servidor local con Apache y MySQL).

- PHP 7+

- Un navegador web (Chrome, Firefox, etc.).

- Editor de código como VS Code o Sublime.
 
- Carpeta del proyecto en htdocs si usas XAMPP.
 
### 2. Estructura del proyecto

---

```
facturacion/
│
├── db.php
├── index.php
├── agregar.php
├── reporte.php
├── editar.php
├── actualizar.php
├── eliminar.php
├── REPORTE1.php
├── fpdf/
│   ├── fpdf.php
```

### 3. Crear la base de datos BD_FacturacionPruebas

---

```sql
Ejecuta este SQL en phpMyAdmin:

CREATE DATABASE BD_FacturacionPruebas;

USE BD_FacturacionPruebas;

CREATE TABLE Facturas (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Descripcion VARCHAR(100),
    Categoria VARCHAR(50),
    Cantidad INT,
    PrecioUnitario DECIMAL(10,2),
    ITEBIS DECIMAL(10,2),
    Descuento DECIMAL(10,2),
    TotalGeneral DECIMAL(10,2)
);
```

---

### 4. Archivo db.php (conexión a la base de datos)

```php
<?php
$conexion = new mysqli("localhost", "root", "", "BD_FacturacionPruebas");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
```

---

### 5. index.php - Formulario para registrar facturas
Este archivo muestra el formulario para insertar una factura:

```php
<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Factura</title>
    <style>
        /* Aquí va tu CSS si quieres agregarle pero aqui te dejo un ejemplo del mio*/
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
```

---

![Image](https://github.com/user-attachments/assets/f00da080-1658-449b-9bd8-2fc009eb9494)

### 6. agregar.php - Código para insertar la factura

```php
<?php
include("db.php");

$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$itebis = $_POST['itebis'];
$descuento = $_POST['descuento'];

$total = ($cantidad * $precio) + $itebis - $descuento;

$sql = "INSERT INTO Facturas (Descripcion, Categoria, Cantidad, PrecioUnitario, ITEBIS, Descuento, TotalGeneral)
        VALUES ('$descripcion', '$categoria', $cantidad, $precio, $itebis, $descuento, $total)";
$conexion->query($sql);

header("Location: reporte.php");
?>
```

---

### 📋 7. reporte.php - Ver listado de facturas

```php
<?php
include("db.php");
$result = $conexion->query("SELECT * FROM Facturas");
?>
<div class="container">
    <h2>Reporte de Facturas</h2>
    <table>
        <tr>
            <th>ID</th><th>Descripción</th><th>Categoría</th><th>Cantidad</th>
            <th>Precio Unitario</th><th>ITEBIS</th><th>Descuento</th><th>Total General</th><th>Acciones</th>
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
                <a href="editar.php?id=<?= $row['Id'] ?>">Editar</a>
                <a href="eliminar.php?id=<?= $row['Id'] ?>" onclick="return confirm('¿Seguro?')">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="REPORTE1.php">Ver reporte PDF</a>
</div>
```

---

### 🗑️ 8. eliminar.php - Eliminar una factura

```php
<?php
include("db.php");
$id = $_GET['id'];
$sql = "DELETE FROM Facturas WHERE Id=$id";
$conexion->query($sql);
header("Location: reporte.php");
?>
🖊️ 9. editar.php - Formulario para editar factura
php
Copiar
Editar
<?php
include("db.php");
$id = $_GET['id'];
$sql = "SELECT * FROM Facturas WHERE Id=$id";
$result = $conexion->query($sql);
$row = $result->fetch_assoc();
?>

<form action="actualizar.php" method="POST">
    <input type="hidden" name="id" value="<?= $row['Id'] ?>">

</form>
```

---

### 10. actualizar.php - Código para actualizar la factura

```php
<?php
include("db.php");

$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$itebis = $_POST['itebis'];
$descuento = $_POST['descuento'];

$total = ($cantidad * $precio) + $itebis - $descuento;

$sql = "UPDATE Facturas SET 
        Descripcion='$descripcion',
        Categoria='$categoria',
        Cantidad=$cantidad,
        PrecioUnitario=$precio,
        ITEBIS=$itebis,
        Descuento=$descuento,
        TotalGeneral=$total
        WHERE Id=$id";

$conexion->query($sql);
header("Location: reporte.php");
?>
```

---
### 🧾 11. REPORTE1.php - Generar PDF con FPDF

```php
<?php
require('fpdf/fpdf.php');
require 'db.php';

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(40, 10, 'Reporte de Facturas');
$pdf->Ln();

$query = $conexion->query("SELECT * FROM Facturas");

while ($row = $query->fetch_assoc()) {
    $pdf->Cell(30, 10, $row['Descripcion'], 1);
    $pdf->Cell(30, 10, $row['TotalGeneral'], 1);
    $pdf->Ln();
}

$pdf->Output();
?>
```

---

#  12. Instalación de FPDF
🔽 Paso 1: Descargar

- Ve al sitio oficial: https://www.fpdf.org

- Haz clic en Download.

- Descomprime la carpeta fpdf y colócala dentro de tu proyecto.

Debe quedar así:

```
facturacion/
├── fpdf/
│   ├── fpdf.php
│   ├── font/
│   └── ...otros archivos
```
### ✅ Paso 2: Usarlo en tu archivo PHP

```php
require('fpdf/fpdf.php');
```

🧪 13. Pruebas y flujo de trabajo

- Abre tu navegador y entra a http://localhost/facturacion/index.php

- Llena el formulario → presiona “Agregar”.

- Ve a reporte.php → verás la tabla de facturas.

- Haz clic en editar o eliminar para probar funciones CRUD.

- Haz clic en “Ver reporte PDF” → se genera y descarga el archivo PDF.

