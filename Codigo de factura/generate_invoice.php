<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_name = $_POST['client_name'];
    $invoice_date = $_POST['invoice_date'];
    $payment_type = $_POST['payment_type']; // Agregado para obtener el método de pago
    $product_names = $_POST['product_name'];
    $quantities = $_POST['quantity'];
    $prices = $_POST['price'];

    $total_general = 0;

    echo "<!DOCTYPE html>";
    echo "<html lang='es'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Factura Generada</title>";
    echo "<link rel='stylesheet' href='css/style.css'>";
    echo "<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            font-size: 16px;
            color: #555;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .invoice-table th {
            background-color: #097cb5;
            color: white;
        }
        .invoice-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .invoice-table tr:hover {
            background-color: #e9ecef;
        }
        .total-row {
            font-weight: bold;
            background-color: #e9ecef;
        }
        .logo {
            display: block;
            margin: 0 auto;
            width: 150px; /* Ajusta el ancho según sea necesario */
        }
    </style>";
    echo "</head>";
    echo "<body>";
    echo "<div class='invoice-container'>";

    // Agregar la imagen del logo
    echo "<img src='jk.png' alt='Logo de la Empresa' class='logo'>"; // Cambia la ruta de la imagen

    echo "<h1>Factura</h1>";
    echo "<p><strong>Nombre del Cliente:</strong> " . htmlspecialchars($client_name) . "</p>";
    echo "<p><strong>Fecha de la Factura:</strong> " . htmlspecialchars($invoice_date) . "</p>";
    echo "<p><strong>Método de Pago:</strong> " . htmlspecialchars($payment_type) . "</p>"; // Imprimir método de pago

    echo "<table class='invoice-table'>";
    echo "<tr><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Total</th></tr>";

    for ($i = 0; $i < count($product_names); $i++) {
        $product_total = $quantities[$i] * $prices[$i];
        $total_general += $product_total;

        echo "<tr>";
        echo "<td>" . htmlspecialchars($product_names[$i]) . "</td>";
        echo "<td>" . htmlspecialchars($quantities[$i]) . "</td>";
        echo "<td>$" . number_format($prices[$i], 2) . "</td>";
        echo "<td>$" . number_format($product_total, 2) . "</td>";
        echo "</tr>";
    }

    echo "<tr class='total-row'><td colspan='3'><strong>Total General</strong></td><td>$" . number_format($total_general, 2) . "</td></tr>";
    echo "</table>";
    // Agregar el pie de página
    echo "<div class='footer'>";
    echo "<p><strong>Notas:</strong> Gracias por su compra.</p>";
    echo "<p><strong>Dirección:</strong> Calle 17 123, Yopal, Casanare</p>";
    echo "<p><strong>NIF/CIF:</strong> A12345678</p>";
    echo "</div>";

    echo "</div>";
    echo "</body>";
    echo "</html>";
    echo "</div>";
    echo "</body>";
    echo "</html>";
} else {
    echo "No se han enviado datos.";
}
?>
