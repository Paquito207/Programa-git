<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Declaración del documento HTML y su idioma -->
    <meta charset="UTF-8"> <!-- Establece la codificación de caracteres a UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura el viewport para dispositivos móviles -->
    <title>Generar Factura</title> <!-- Título de la página -->
    <link rel="stylesheet" href="css/style.css"> <!-- Enlace a la hoja de estilos CSS externa -->
    <style>
        /* Estilos internos */
        h1.center-title {
            text-align: center; /* Centra el texto */
            color: #333; /* Color del texto */
            margin-bottom: 20px; /* Margen inferior */
        }
        .container {
            margin: 20px auto; /* Margen superior/inferior automáticos y 20px laterales */
            padding: 20px; /* Relleno interno */
            width: 80%; /* Ancho del 80% */
            background: white; /* Fondo blanco */
            border-radius: 8px; /* Esquinas redondeadas */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra del contenedor */
        }
        .logo-container {
            text-align: center; /* Centra el contenido */
            margin-bottom: 20px; /* Margen inferior */
        }
        /* Estilos para los campos de entrada y selección */
        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            background-color: #f5f5f5; /* Fondo gris claro */
            color: #333; /* Color del texto */
            border: 1px solid #ccc; /* Borde gris */
            border-radius: 4px; /* Esquinas redondeadas */
            padding: 10px; /* Relleno interno */
            margin: 5px 0 10px; /* Margen */
            width: 100%; /* Ancho completo */
            box-sizing: border-box; /* Incluye el padding en el ancho total */
        }
        /* Estilos para el enfoque en los campos de entrada */
        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus,
        select:focus {
            border-color: #007BFF; /* Color del borde al enfocar */
            outline: none; /* Sin contorno */
        }
        /* Estilos para los botones */
        button,
        input[type="submit"] {
            padding: 10px 20px; /* Relleno interno */
            border: none; /* Sin borde */
            border-radius: 4px; /* Esquinas redondeadas */
            cursor: pointer; /* Cursor de puntero */
            color: white; /* Color del texto */
            font-size: 16px; /* Tamaño de la fuente */
            transition: background-color 0.3s, transform 0.3s; /* Transiciones */
        }
        button {
            background-color: #096da9; /* Fondo azul oscuro */
        }
        input[type="submit"] {
            background-color: #00adb2; /* Fondo turquesa */
        }
        /* Efecto al pasar el cursor sobre los botones */
        button:hover,
        input[type="submit"]:hover {
            transform: scale(1.05); /* Escala aumentada */
            opacity: 0.9; /* Opacidad disminuida */
        }
        .product {
            margin-bottom: 20px; /* Margen inferior */
        }
    </style>
</head>
<body>
    <div class="container"> <!-- Contenedor principal -->
        <div class="logo-container"> <!-- Contenedor del logo -->
            <img src="jk.png" alt="Logo de la Factura" width="150" height="150"> <!-- Imagen del logo -->
        </div>
        <h1 class="center-title">Factura</h1> <!-- Título centrado -->
        <form action="generate_invoice.php" method="POST"> <!-- Formulario que se envía a generate_invoice.php -->
            <label for="client_name">Nombre del Cliente:</label>
            <input type="text" id="client_name" name="client_name" required><br> <!-- Campo para el nombre del cliente -->
            <label for="invoice_date">Fecha de la Factura:</label>
            <input type="date" id="invoice_date" name="invoice_date" required><br> <!-- Campo para la fecha de la factura -->
            <label for="payment_type">Tipo de Pago:</label>
            <select id="payment_type" name="payment_type" required> <!-- Menú de selección para el tipo de pago -->
                <option value="" disabled selected>Selecciona un tipo de pago</option> <!-- Opción por defecto -->
                <option value="efectivo">Efectivo</option>
                <option value="tarjeta_credito">Tarjeta de Crédito</option>
                <option value="tarjeta_debito">Tarjeta de Débito</option>
                <option value="transferencia">Transferencia Bancaria</option>
                <option value="paypal">PayPal</option>
            </select>
            <div id="product-list"> <!-- Lista de productos -->
                <h3>Productos</h3>
                <div class="product"> <!-- Producto individual -->
                    <label for="product_name[]">Nombre del Producto:</label>
                    <input type="text" name="product_name[]" required> <!-- Campo para el nombre del producto -->
                    <label for="quantity[]">Cantidad:</label>
                    <input type="number" name="quantity[]" min="1" required> <!-- Campo para la cantidad del producto -->
                    <label for="price[]">Precio Unitario:</label>
                    <input type="number" name="price[]" min="0" step="0.01" required> <!-- Campo para el precio unitario -->
                </div>
            </div>
            <button type="button" id="add-product">Agregar Producto</button><br><br> <!-- Botón para agregar más productos -->
            <input type="submit" value="Generar Factura"> <!-- Botón para enviar el formulario -->
        </form>
    </div>
    <script>
        // Función para establecer la fecha actual por defecto
        window.onload = function() {
            var today = new Date().toISOString().split('T')[0]; // Obtiene la fecha en formato YYYY-MM-DD
            document.getElementById('invoice_date').value = today; // Establece la fecha en el campo de fecha
        };
        // Evento para agregar nuevos campos de producto
        document.getElementById('add-product').addEventListener('click', function () {
            var productDiv = document.createElement('div'); // Crea un nuevo div para el producto
            productDiv.classList.add('product'); // Agrega la clase 'product' al nuevo div
            productDiv.innerHTML = `
                <label>Nombre del Producto:</label>
                <input type="text" name="product_name[]" required>
                <label>Cantidad:</label>
                <input type="number" name="quantity[]" min="1" required>
                <label>Precio Unitario:</label>
                <input type="number" name="price[]" min="0" step="0.01" required>
            `; // HTML interno del nuevo div
            document.getElementById('product-list').appendChild(productDiv); // Agrega el nuevo div a la lista de productos
        });
    </script>
</body>
</html>

