<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Finance Control</title>
</head>

<body>
    <h2>Bem-Vindo Projeto Controle Finanças</h2>
    <div>
        <a href="{{ route('account.index') }}">Listar Contas</a>
    </div>

    @yield('content')
</body>

</html>
