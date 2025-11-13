<!DOCTYPE html>
<html>
<head>
    <title>Nuevo mensaje de contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #5170ff;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .field {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #333333;
        }
        .value {
            color: #555555;
            margin-top: 5px;
        }
        .message-box {
            margin-top: 10px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
            border: 1px solid #ddd;
            color: #333333;
            font-size: 14px;
            white-space: pre-wrap;
        }
        .footer {
            text-align: center;
            padding: 15px;
            background-color: #f4f4f7;
            font-size: 12px;
            color: #888888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nuevo mensaje de contacto</h1>
        </div>
        <div class="content">
            <div class="field">
                <span class="label">Nombre:</span>
                <div class="value">{{ $name }}</div>
            </div>
            <div class="field">
                <span class="label">Correo:</span>
                <div class="value">{{ $email }}</div>
            </div>
            <div class="field">
                <span class="label">Teléfono:</span>
                <div class="value">{{ $telefono }}</div>
            </div>
            <div class="field">
                <span class="label">Mensaje:</span>
                <div class="message-box">
                    {!! nl2br(e($content)) !!}
                </div>
            </div>
        </div>
        <div class="footer">
            Este mensaje fue enviado desde el formulario de contacto de GoodTrav. Por favor, no responda a este correo electrónico.
        </div>
    </div>
</body>
</html>