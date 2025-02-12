<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificação de Pedido</title>
    <style>
        /* Estilos básicos para e-mails */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            width: 100%;
            background-color: #ffffff;
            padding: 20px;
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            background-color: #1a73e8;
            color: white;
            padding: 20px 0;
        }
        .content {
            margin: 20px 0;
            color: #333;
            font-size: 16px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
        .footer a {
            color: #1a73e8;
            text-decoration: none;
        }
        .button {
            background-color: #1a73e8;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        /* Responsividade */
        @media screen and (max-width: 600px) {
            .email-container {
                padding: 10px;
            }
            .content {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Cabeçalho -->
        <div class="header">
            <h1>Meu App</h1>
        </div>

        <!-- Conteúdo do E-mail -->
        <div class="content">
            <p>Olá, {{ $dados['nome'] }}!</p>
            <p>{{ $dados['mensagem'] }}</p>
        </div>

        <!-- Rodapé -->
        <div class="footer">
            <p><a href="{{ route('dashboard.config') }}">Clique aqui</a> para cancelar o recebimento deste tipo de e-mail</p>
        </div>
    </div>
</body>
</html>
