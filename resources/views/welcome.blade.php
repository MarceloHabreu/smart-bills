<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Bills - Bem-Vindo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets\logo-smartbills\SmartBills\favicon_transparent_32x32.ico') }}" type="image/x-icon" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=El+Messiri:wght@400..700&display=swap');

        body {
            font-family: 'El Messiri', sans-serif;
        }

        .text-custom-color-title {
            color: #5AED83;
            /* Substitua esta cor pela cor desejada */
        }

        .text-custom-color-p {
            color: #498452;
            /* Substitua esta cor pela cor desejada */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="jumbotron text-center" style="background-color: #1F1717">
                    <img src="{{ asset('assets/logo-smartbills/SmartBills/logoDoWelcome.png') }}" alt="SmartBills Logo" class="mb-2" style="max-width: 200px;">
                    <h1 class="display-4 text-custom-color-title">Bem-Vindo ao SmartBills!</h1>
                    <p class="lead text-custom-color-p">Um controle inteligente para suas contas.</p>
                    <hr class="my-4" style="color: #fff">
                    <p style="color: #F8F8FF">Faça seu login ou cadastre-se para gerenciar suas finanças.</p> <a class="btn btn-success btn-lg" href="{{ route('login') }}" role="button">Login</a> <a
                        class="btn btn-info btn-lg" href="{{ route('register') }}" role="button">Registrar</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
