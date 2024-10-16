<?php
require('fpdf.php'); // permite utilizar la biblioteca para generar PDFs.

// Verifica si la solicitud se realizó mediante el método POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura los datos del formulario.
    $client_name = $_POST['client_name']; // Nombre del cliente.
    $invoice_date = $_POST['invoice_date']; // Fecha de la factura.
    // Captura la hora con formato a.m./p.m. o usa la hora actual si no se proporciona.
    $invoice_time = !empty($_POST['invoice_time']) ? $_POST['invoice_time'] : date('h:i:s a');

    $payment_type = $_POST['payment_type']; // Método de pago elegido por el cliente.
    $product_names = $_POST['product_name']; // Nombres de los productos.
    $quantities = $_POST['quantity']; // Cantidades de cada producto.
    $prices = $_POST['price']; // Precios unitarios de los productos.

    $total_general = 0; // Inicializa la variable para el total general de la factura.

    // Crear una instancia de FPDF.
    $pdf = new FPDF();
    $pdf->AddPage(); // Añade una nueva página al PDF.

    // Título de la factura.
    $pdf->SetFont('Times', 'B', 20); // Establece la fuente y el tamaño del título.
    $pdf->Cell(0, 10, 'Factura', 0, 1, 'C'); // Añade la celda con el título centrado.

    // Información del cliente.
    $pdf->SetFont('Times', '', 14); // Cambia la fuente para el resto de la información.
    $pdf->Cell(0, 10, 'Nombre del Cliente: ' . htmlspecialchars($client_name), 0, 1); // Muestra el nombre del cliente, escapando caracteres especiales.
    $pdf->Cell(0, 10, 'Fecha de la Factura: ' . htmlspecialchars($invoice_date), 0, 1); // Muestra la fecha de la factura.
    $pdf->Cell(0, 10, 'Hora de la Factura: ' . htmlspecialchars($invoice_time), 0, 1); // Muestra la hora de la factura.
    
    // Imprimir el método de pago seleccionado.
    switch ($payment_type) { // Determina el método de pago a mostrar.
        case 'efectivo':
            $pdf->Cell(0, 10, 'Metodo de Pago: Efectivo', 0, 1);
            break;
        case 'tarjeta_credito':
            $pdf->Cell(0, 10, 'Metodo de Pago: Tarjeta de Credito', 0, 1);
            break;
        case 'tarjeta_debito':
            $pdf->Cell(0, 10, 'Metodo de Pago: Tarjeta de Debito', 0, 1);
            break;
        case 'transferencia':
            $pdf->Cell(0, 10, 'Metodo de Pago: Transferencia Bancaria', 0, 1);
            break;
        case 'paypal':
            $pdf->Cell(0, 10, 'Metodo de Pago: PayPal', 0, 1);
            break;
        default: // En caso de que no se especifique un método de pago.
            $pdf->Cell(0, 10, 'Metodo de Pago: No especificado', 0, 1);
            break;
    }

    $pdf->Ln(10); // Añade un espacio adicional entre secciones.

    // Crear la tabla de productos.
    $pdf->SetFont('Times', 'B', 14); // Establece la fuente para los encabezados de la tabla.
    
    // Encabezados de la tabla.
    $pdf->SetFillColor(200, 220, 255); // Color de fondo para las celdas de encabezado.
    $pdf->Cell(60, 10, 'Producto', 1, 0, 'C', true); // Columna de Producto.
    $pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C', true); // Columna de Cantidad.
    $pdf->Cell(40, 10, 'Precio Unitario', 1, 0, 'C', true); // Columna de Precio Unitario.
    $pdf->Cell(40, 10, 'Total', 1, 1, 'C', true); // Columna de Total, línea nueva después del encabezado.

    $pdf->SetFont('Times', '', 12); // Cambia la fuente para los datos de la tabla.
    for ($i = 0; $i < count($product_names); $i++) { // Itera sobre los productos.
        $product_total = $quantities[$i] * $prices[$i]; // Calcula el total para cada producto.
        $total_general += $product_total; // Acumula el total general.

        // Añade una fila para cada producto.
        $pdf->Cell(60, 10, htmlspecialchars($product_names[$i]), 1); // Producto.
        $pdf->Cell(30, 10, htmlspecialchars($quantities[$i]), 1); // Cantidad.
        $pdf->Cell(40, 10, '$' . number_format($prices[$i], 2), 1); // Precio unitario, formateado a 2 decimales.
        $pdf->Cell(40, 10, '$' . number_format($product_total, 2), 1); // Total del producto, formateado a 2 decimales.
        $pdf->Ln(); // Añade una nueva línea para la siguiente fila.
    }

    // Total General.
    $pdf->SetFont('Times', 'B', 14); // Cambia la fuente para el total general.
    $pdf->Cell(130, 10, 'Total General', 1); // Columna de Total General.
    $pdf->Cell(40, 10, '$' . number_format($total_general, 2), 1); // Total general, formateado a 2 decimales.
    $pdf->Ln(20); // Añade un espacio adicional después del total.

    // Notas finales.
    $pdf->SetFont('Times', '', 12); // Cambia la fuente para las notas finales.
    $pdf->Cell(0, 10, 'Notas: Gracias por su compra!', 0, 1); // Nota de agradecimiento.
    $pdf->Cell(0, 10, 'Direccion: Calle 17 123, Yopal, Casanare', 0, 1); // Dirección del negocio.
    $pdf->Cell(0, 10, 'NIF/CIF: A12345678', 0, 1); // Información fiscal.

    // Generar el PDF y enviar al navegador.
    $pdf->Output('D', 'factura.pdf'); // Envía el PDF al navegador para descargarlo.
} else {
    echo "No se han enviado datos."; // Mensaje en caso de que no se reciban datos.
}
?>
