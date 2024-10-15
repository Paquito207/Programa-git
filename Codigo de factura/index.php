<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Factura</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        h1.center-title {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .container {
            margin: 20px auto;
            padding: 20px;
            width: 80%;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"], 
        input[type="number"], 
        input[type="date"], 
        select {
            background-color: #f5f5f5;
            color: #333;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            margin: 5px 0 10px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="text"]:focus, 
        input[type="number"]:focus, 
        input[type="date"]:focus, 
        select:focus {
            border-color: #007BFF;
            outline: none;
        }

        button, input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }

        button {
            background-color: #096da9;
        }
        input[type="submit"] {
            background-color: #00adb2;
        }
        button:hover, input[type="submit"]:hover {
            transform: scale(1.05);
            opacity: 0.9;
        }

        .product {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-container">
            <img src="jk.png" alt="Logo de la Factura" width="150" height="150">
        </div>

        <h1 class="center-title">Factura</h1>
        <form action="generate_invoice.php" method="POST">
            <label for="client_name">Nombre del Cliente:</label>
            <input type="text" id="client_name" name="client_name" required><br>

            <label for="invoice_date">Fecha de la Factura:</label>
            <input type="date" id="invoice_date" name="invoice_date" required><br>

            <label for="payment_type">Tipo de Pago:</label>
            <select id="payment_type" name="payment_type" required>
                <option value="" disabled selected>Selecciona un tipo de pago</option>
                <option value="efectivo">Efectivo</option>
                <option value="tarjeta_credito">Tarjeta de Crédito</option>
                <option value="tarjeta_debito">Tarjeta de Débito</option>
                <option value="transferencia">Transferencia Bancaria</option>
                <option value="paypal">PayPal</option>
            </select>

            <div id="product-list">
                <h3>Productos</h3>
                <div class="product">
                    <label for="product_name[]">Nombre del Producto:</label>
                    <input type="text" name="product_name[]" required>
                    <label for="quantity[]">Cantidad:</label>
                    <input type="number" name="quantity[]" min="1" required>
                    <label for="price[]">Precio Unitario:</label>
                    <input type="number" name="price[]" min="0" step="0.01" required>
                </div>
            </div>

            <button type="button" id="add-product">Agregar Producto</button><br><br>
            <input type="submit" value="Generar Factura">
        </form>
    </div>

    <script>
        // Función para establecer la fecha actual por defecto
        window.onload = function() {
            var today = new Date().toISOString().split('T')[0]; // Obtiene la fecha en formato YYYY-MM-DD
            document.getElementById('invoice_date').value = today;
        };

        document.getElementById('add-product').addEventListener('click', function () {
            var productDiv = document.createElement('div');
            productDiv.classList.add('product');
            productDiv.innerHTML = `
                <label>Nombre del Producto:</label>
                <input type="text" name="product_name[]" required>
                <label>Cantidad:</label>
                <input type="number" name="quantity[]" min="1" required>
                <label>Precio Unitario:</label>
                <input type="number" name="price[]" min="0" step="0.01" required>
            `;
            document.getElementById('product-list').appendChild(productDiv);
        });
    </script>
</body>
</html>
