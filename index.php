<!DOCTYPE html>
<html lang="es"> <!-- Define el idioma del documento como español -->
<head>
    <meta charset="UTF-8"> <!-- Establece la codificación de caracteres como UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Permite la visualización responsiva en dispositivos móviles -->
    <title>Generar Factura</title> <!-- Título de la página -->
    <link rel="stylesheet" href="css/style.css"> <!-- Enlaza un archivo CSS externo para estilos -->
    <style>
        /* Estilos CSS incorporados para personalizar el diseño de la página */
        h1.center-title {
            text-align: center; /* Centra el texto del encabezado */
            color: #333; /* Color del texto */
            margin-bottom: 20px; /* Margen inferior del encabezado */
        }

        .container {
            margin: 20px auto; /* Margen superior e inferior de 20px y centrado horizontalmente */
            padding: 20px; /* Relleno interior de 20px */
            width: 80%; /* Ancho del contenedor */
            background: white; /* Color de fondo del contenedor */
            border-radius: 8px; /* Esquinas redondeadas */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil alrededor del contenedor */
        }

        .logo-container {
            text-align: center; /* Centra el contenido del contenedor del logo */
            margin-bottom: 20px; /* Margen inferior del contenedor del logo */
        }

        /* Estilos para los campos de entrada y selección */
        input[type="text"], 
        input[type="number"], 
        input[type="date"], 
        select {
            background-color: #f5f5f5; /* Color de fondo de los campos */
            color: #333; /* Color del texto */
            border: 1px solid #ccc; /* Borde del campo */
            border-radius: 4px; /* Esquinas redondeadas */
            padding: 10px; /* Relleno interior de 10px */
            margin: 5px 0 10px; /* Margen superior e inferior */
            width: 100%; /* Ancho completo */
            box-sizing: border-box; /* Incluye el padding y borde en el cálculo del ancho */
        }

        /* Estilos para el enfoque en los campos de entrada */
        input[type="text"]:focus, 
        input[type="number"]:focus, 
        input[type="date"]:focus, 
        select:focus {
            border-color: #007BFF; /* Cambia el color del borde al enfocar */
            outline: none; /* Elimina el contorno predeterminado del navegador */
        }

        /* Estilos para botones */
        button, input[type="submit"] {
            padding: 10px 20px; /* Relleno interior */
            border: none; /* Sin borde */
            border-radius: 4px; /* Esquinas redondeadas */
            cursor: pointer; /* Cambia el cursor al pasar por encima */
            color: white; /* Color del texto en botones */
            font-size: 16px; /* Tamaño de fuente */
            transition: background-color 0.3s, transform 0.3s; /* Transiciones suaves para los cambios de estado */
        }

        button {
            background-color: #096da9; /* Color de fondo del botón */
        }
        input[type="submit"] {
            background-color: #00adb2; /* Color de fondo del botón de envío */
        }
        /* Efecto hover para botones */
        button:hover, input[type="submit"]:hover {
            transform: scale(1.05); /* Aumenta el tamaño ligeramente al pasar el cursor */
            opacity: 0.9; /* Cambia la opacidad */
        }

        .product {
            margin-bottom: 20px; /* Margen inferior para separar los productos */
        }

        .button-group {
            display: flex; /* Utiliza flexbox para alinear los botones */
            justify-content: space-between; /* Espacio uniforme entre los botones */
            margin-top: 20px; /* Margen superior para separar de la sección anterior */
        }

        .button-group button, .button-group input[type="submit"] {
            width: 30%; /* Ancho uniforme para los botones */
        }
    </style>
</head>
<body>
    <div class="container"> <!-- Contenedor principal -->
        <div class="logo-container"> <!-- Contenedor del logo -->
            <img src="jk.png" alt="Logo de la Factura" width="150" height="150"> <!-- Logo de la factura -->
        </div>

        <h1 class="center-title">Factura</h1> <!-- Título principal de la factura -->
        <form action="generate_invoice.php" method="POST" id="invoice-form"> <!-- Formulario para generar factura -->
            <label for="client_name">Nombre del Cliente:</label> <!-- Etiqueta para el campo del nombre del cliente -->
            <input type="text" id="client_name" name="client_name" required><br> <!-- Campo de texto para el nombre del cliente -->

            <label for="invoice_date">Fecha de la Factura:</label> <!-- Etiqueta para el campo de fecha -->
            <input type="date" id="invoice_date" name="invoice_date" required><br> <!-- Campo de fecha para la factura -->

            <label for="invoice_time">Hora de la Factura:</label> <!-- Etiqueta para el campo de hora -->
            <input type="text" id="invoice_time" name="invoice_time" readonly><br> <!-- Campo de texto para mostrar la hora, solo lectura -->

            <label for="payment_type">Tipo de Pago:</label> <!-- Etiqueta para el campo de tipo de pago -->
            <select id="payment_type" name="payment_type" required> <!-- Lista desplegable para seleccionar el tipo de pago -->
                <option value="" disabled selected>Selecciona un tipo de pago</option> <!-- Opción por defecto -->
                <option value="efectivo">Efectivo</option> <!-- Opción de pago en efectivo -->
                <option value="tarjeta_credito">Tarjeta de Crédito</option> <!-- Opción de pago con tarjeta de crédito -->
                <option value="tarjeta_debito">Tarjeta de Débito</option> <!-- Opción de pago con tarjeta de débito -->
                <option value="transferencia">Transferencia Bancaria</option> <!-- Opción de transferencia bancaria -->
                <option value="paypal">PayPal</option> <!-- Opción de pago por PayPal -->
            </select>

            <div id="product-list"> <!-- Contenedor para la lista de productos -->
                <h3>Productos</h3> <!-- Título de la sección de productos -->
                <div class="product"> <!-- Contenedor de un producto -->
                    <label for="product_name[]">Nombre del Producto:</label> <!-- Etiqueta para el nombre del producto -->
                    <input type="text" name="product_name[]" required> <!-- Campo de texto para el nombre del producto -->
                    <label for="quantity[]">Cantidad:</label> <!-- Etiqueta para la cantidad -->
                    <input type="number" name="quantity[]" min="1" required> <!-- Campo de número para la cantidad, mínimo 1 -->
                    <label for="price[]">Precio Unitario:</label> <!-- Etiqueta para el precio unitario -->
                    <input type="number" name="price[]" min="0" step="0.01" required> <!-- Campo de número para el precio, mínimo 0 y paso de 0.01 -->
                </div>
            </div>

            <button type="button" id="add-product">Agregar Producto</button> <!-- Botón para agregar otro producto -->
            <div class="button-group"> <!-- Grupo de botones -->
                <button type="button" id="clear-form">Limpiar Formulario</button> <!-- Botón para limpiar el formulario -->
                <input type="submit" value="Generar Factura"> <!-- Botón de envío para generar la factura -->
            </div>
        </form>
    </div>

    <script>
        // Función para establecer la fecha y la hora actuales por defecto
        window.onload = function() { // Se ejecuta cuando la página se carga
            var today = new Date(); // Obtiene la fecha y hora actuales
            document.getElementById('invoice_date').value = today.toISOString().split('T')[0]; // Establece la fecha en formato YYYY-MM-DD
            
            // Función para actualizar la hora
            function updateTime() {
                var now = new Date(); // Obtiene la fecha y hora actuales
                var hours = now.getHours(); // Obtiene las horas
                var minutes = String(now.getMinutes()).padStart(2, '0'); // Obtiene los minutos, con ceros a la izquierda
                var seconds = String(now.getSeconds()).padStart(2, '0'); // Obtiene los segundos, con ceros a la izquierda
                var ampm = hours >= 12 ? 'p.m.' : 'a.m.'; // Determina si es a.m. o p.m.
                hours = hours % 12; // Convierte a formato de 12 horas
                hours = hours ? String(hours).padStart(2, '0') : '12'; // Si es 0, lo convierte a 12
                document.getElementById('invoice_time').value = `${hours}:${minutes}:${seconds} ${ampm}`; // Establece la hora
            }

            // Llama a updateTime inmediatamente y luego cada segundo
            updateTime(); // Llama a la función para establecer la hora inicial
            setInterval(updateTime, 1000); // Llama a la función cada segundo para actualizar la hora
        };

        // Evento para agregar un nuevo producto
        document.getElementById('add-product').addEventListener('click', function () {
            var productDiv = document.createElement('div'); // Crea un nuevo contenedor para un producto
            productDiv.classList.add('product'); // Agrega la clase 'product' al nuevo contenedor
            productDiv.innerHTML = ` <!-- HTML del nuevo producto -->
                <label>Nombre del Producto:</label>
                <input type="text" name="product_name[]" required> <!-- Campo para el nombre del producto -->
                <label>Cantidad:</label>
                <input type="number" name="quantity[]" min="1" required> <!-- Campo para la cantidad -->
                <label>Precio Unitario:</label>
                <input type="number" name="price[]" min="0" step="0.01" required> <!-- Campo para el precio unitario -->
            `;
            document.getElementById('product-list').appendChild(productDiv); // Agrega el nuevo producto a la lista de productos
        });

        // Evento para limpiar el formulario
        document.getElementById('clear-form').addEventListener('click', function () {
            document.getElementById('invoice-form').reset(); // Limpia todos los campos del formulario
            document.getElementById('product-list').innerHTML = `<h3>Productos</h3>
                <div class="product">
                    <label for="product_name[]">Nombre del Producto:</label>
                    <input type="text" name="product_name[]" required>
                    <label for="quantity[]">Cantidad:</label>
                    <input type="number" name="quantity[]" min="1" required>
                    <label for="price[]">Precio Unitario:</label>
                    <input type="number" name="price[]" min="0" step="0.01" required>
                </div>`; // Resetea la lista de productos a su estado inicial
            var today = new Date();
            document.getElementById('invoice_date').value = today.toISOString().split('T')[0]; // Resetea la fecha al valor actual
            document.getElementById('invoice_time').value = ""; // Resetea la hora a vacío
        });
    </script>
</body>
</html>
