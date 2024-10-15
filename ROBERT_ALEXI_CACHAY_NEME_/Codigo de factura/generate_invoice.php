<?php
// Comprobamos si se ha enviado un formulario mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtenemos los datos del formulario enviado
    $client_name = $_POST['client_name']; // Nombre del cliente
    $invoice_date = $_POST['invoice_date']; // Fecha de la factura
    $payment_type = $_POST['payment_type']; // Método de pago
    $product_names = $_POST['product_name']; // Array de nombres de productos
    $quantities = $_POST['quantity']; // Array de cantidades de productos
    $prices = $_POST['price']; // Array de precios unitarios de productos
    $total_general = 0; // Variable para almacenar el total general de la factura

    // Inicio de la generación del documento HTML
    echo "<!DOCTYPE html>"; // Declaración del tipo de documento HTML
    echo "<html lang='es'>"; // Comienzo del documento HTML en español
    echo "<head>"; // Inicio del encabezado del documento HTML
    echo "<meta charset='UTF-8'>"; // Establece la codificación de caracteres como UTF-8
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>"; // Configuración del viewport para dispositivos móviles
    echo "<title>Factura Generada</title>"; // Título de la página

    // Enlace al archivo CSS externo y estilos internos
    echo "<link rel='stylesheet' href='css/style.css'>"; // Incluye un archivo de estilos CSS externo
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
    </style>"; // Estilos CSS internos
    echo "</head>"; // Cierre del encabezado del documento HTML

    echo "<body>"; // Inicio del cuerpo del documento HTML
    echo "<div class='invoice-container'>"; // Contenedor principal de la factura

    // Agregamos la imagen del logo de la empresa
    echo "<img src='jk.png' alt='Logo de la Empresa' class='logo'>"; // Imagen del logo de la empresa

    // Título de la factura
    echo "<h1>Factura</h1>"; // Título centrado de la factura

    // Información del cliente y fecha de la factura
    echo "<p><strong>Nombre del Cliente:</strong> " . htmlspecialchars($client_name) . "</p>"; // Imprimimos el nombre del cliente
    echo "<p><strong>Fecha de la Factura:</strong> " . htmlspecialchars($invoice_date) . "</p>"; // Imprimimos la fecha de la factura
    echo "<p><strong>Método de Pago:</strong> " . htmlspecialchars($payment_type) . "</p>"; // Imprimimos el método de pago

    // Tabla con la lista de productos, cantidades, precios unitarios y total por producto
    echo "<table class='invoice-table'>"; // Inicio de la tabla de la factura
    echo "<tr><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Total</th></tr>"; // Encabezados de la tabla

    // Iteramos a través de los productos
    for ($i = 0; $i < count($product_names); $i++) {
        $product_total = $quantities[$i] * $prices[$i]; // Calculamos el total de cada producto
        $total_general += $product_total; // Sumamos al total general de la factura

        // Mostramos cada producto en la tabla
        echo "<tr>";
        echo "<td>" . htmlspecialchars($product_names[$i]) . "</td>"; // Nombre del producto
        echo "<td>" . htmlspecialchars($quantities[$i]) . "</td>"; // Cantidad del producto
        echo "<td>$" . number_format($prices[$i], 2) . "</td>"; // Precio unitario del producto
        echo "<td>$" . number_format($product_total, 2) . "</td>"; // Total del producto
        echo "</tr>";
    }

    // Fila con el total general de la factura
    echo "<tr class='total-row'><td colspan='3'><strong>Total General</strong></td><td>$" . number_format($total_general, 2) . "</td></tr>"; // Fila del total general
    echo "</table>"; // Cierre de la tabla

    // Pie de página con notas y dirección
    echo "<div class='footer'>"; // Contenedor del pie de página
    echo "<p><strong>Notas:</strong> Gracias por su compra.</p>"; // Notas de agradecimiento
    echo "<p><strong>Dirección:</strong> Calle 17 123, Yopal, Casanare</p>"; // Dirección de la empresa
    echo "<p><strong>NIF/CIF:</strong> A12345678</p>"; // Número de identificación fiscal o código de identificación fiscal
    echo "</div>"; // Cierre del contenedor del pie de página
    
    echo "</div>"; // Cierre del contenedor de la factura
    echo "</body>"; // Cierre del cuerpo del documento HTML
    echo "</html>"; // Cierre del documento HTML

} else {
    // Si no se han enviado datos mediante POST
    echo "No se han enviado datos."; // Mensaje de error si no se han enviado datos
}
?>
