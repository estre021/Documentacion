<?php
require('fpdf.php');
require 'db.php';

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

$pdf->Cell(40, 10, 'Reporte de Facturas');
$pdf->Ln();

$query = $conexion->query("SELECT * FROM Facturas");

while ($row = $query->fetch_assoc()) {
    $pdf->Cell(30, 10, $row['Descripcion']);
    $pdf->Cell(30, 10, $row['TotalGeneral']);
    $pdf->Ln();
}

$pdf->Output();
?>