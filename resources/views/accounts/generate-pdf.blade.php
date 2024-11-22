<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Contas</title>
</head>

<body style="font-size: 12px">
    <h2 style="text-align: center">Contas</h2>

    <table style="border-collapse: collapse; width: 100%">
        <thead>
            <tr style="background-color: #adb5bd">
                <th style="border: 1px solid #ccc">Nome:</th>
                <th style="border: 1px solid #ccc">Vencimento:</th>
                <th style="border: 1px solid #ccc">Valor:</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($accounts as $account)
                <tr>
                    <td style="border: 1px solid #ccc; border-top: none">{{ $account->name }}</td>
                    <td style="border: 1px solid #ccc; border-top: none">{{ \Carbon\Carbon::parse($account->due_date)->tz('America/Sao_Paulo')->format('d/m/Y') }}</td>
                    <td style="border: 1px solid #ccc; border-top: none">{{ 'R$' . number_format($account->value, 2, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhuma conta encontrada!</td>
                </tr>
            @endforelse
            <tr>
                <td colspan="2" style="border: 1px solid #ccc">Valor Total</td>
                <td style="border: 1px solid #ccc">{{ 'RS ' . number_format($totalValue, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
