<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #333;
        }
        .content {
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Detalles de la Reserva</h1>
        </div>
        <div class="content">
            <p><strong>Nombre del viaje:</strong> {{ $details['name_trip'] }}</p>
            <p><strong>Fecha del viaje:</strong> {{ $details['date_trip'] }}</p>
            <p><strong>Nombre del usuario:</strong> {{ $details['full_name'] }}</p>
            <p><strong>Email:</strong> {{ $details['email'] }}</p>
            <p><strong>Teléfono:</strong> {{ $details['phone'] }}</p>
            <p><strong>Descuento:</strong> {{ $details['discount'] ?? 'N/A' }}</p>
            <p><strong>Fecha de llamada:</strong> {{ $details['phone_called_at'] }}</p>
        </div>
        <div class="footer">
            <p>Gracias por usar nuestro servicio.</p>
        </div>
    </div>
</body>
</html>
