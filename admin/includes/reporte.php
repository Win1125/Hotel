<?php

require_once('../fpdf/fpdf.php');


class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        //$this->image('../img/logo.png', 150, 1, 60); // X, Y, Tamaño
        $this->Ln(20);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 20);

        // Movernos a la derecha
        $this->Cell(60);

        // Título
        $this->Cell(70, 10, 'Tabla de Reservas ', 0, 0, 'C');
        // Salto de línea

        $this->Ln(30);
        $this->SetFont('Arial', 'B', 10);
        $this->SetX(8);
        $this->Cell(25, 10, '# Booking', 1, 0, 'C', 0);
        $this->Cell(40, 10, 'Ingreso', 1, 0, 'C', 0,);
        $this->Cell(27, 10, 'Salida', 1, 0, 'C', 0);
        $this->Cell(27, 10, 'Habitacion', 1, 0, 'C', 0);
        $this->Cell(40, 10, 'Precio', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Hotel', 1, 1, 'C', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);

        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página

        $this->Cell(0, 10, utf8_decode('Página') . $this->PageNo() . '/{nb}', 0, 0, 'C');
        //$this->SetFillColor(223, 229,235);
        //$this->SetDrawColor(181, 14,246);
        //$this->Ln(0.5);
    }
}

$conexion = mysqli_connect("localhost", "root", "", "hotel_a");

$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];

$consulta = "SELECT b.id_booking, b.check_in, b.check_out, r.room_name, r.price, h.name AS hotel_name, h.location FROM booking b
            JOIN rooms r ON b.id_room = r.id_room
            JOIN hotels h ON r.id_hotel = h.id_hotel
            WHERE (b.check_in BETWEEN '$from_date' AND '$to_date') or (b.check_out BETWEEN '$from_date' AND '$to_date')";


$resultado = mysqli_query($conexion, $consulta);

$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
//$pdf->SetWidths(array(10, 30, 27, 27, 20, 20, 20, 20, 22));
while ($row = $resultado->fetch_assoc()) {

    $pdf->SetX(8);

    $pdf->Cell(25, 10, $row['id_booking'], 1, 0, 'C', 0);
    $pdf->Cell(40, 10, $row['check_in'], 1, 0, 'C', 0);
    $pdf->Cell(27, 10, $row['check_out'], 1, 0, 'C', 0);
    $pdf->Cell(27, 10, $row['room_name'], 1, 0, 'C', 0);
    $pdf->Cell(40, 10, $row['price'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['hotel_name'], 1, 1, 'C', 0);
}


$pdf->Output();
