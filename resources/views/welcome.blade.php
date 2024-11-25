<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Finance Control - Bem-Vindo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="jumbotron text-center">
                    <h1 class="display-4">Bem-Vindo ao Finance Control!</h1>
                    <p class="lead">Gerencie suas contas de forma fácil e eficiente.</p>
                    <hr class="my-4">
                    <p>Faça seu login ou cadastre-se para gerenciar suas finanças.</p>
                    <a class="btn btn-success btn-lg" href="{{ route('login') }}" role="button">Login</a>
                    <a class="btn btn-info btn-lg" href="{{ route('register') }}" role="button">Registrar</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
