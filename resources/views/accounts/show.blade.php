<div>
    <a href="{{ route('account.index') }}"><button type="button">Home</button></a>
    <br><br>
    <a href="{{ route('account.edit', ['account' => $account->id]) }}"><button type="button">Editar</button></a>

    <div>
        <h2>Detalhes da Conta</h2>

        {{-- Verificando se existe sessão de succes! --}}
        <div>
            @if (session('success'))
                <p style="color: #082">
                    {{ session('success') }}
                </p>
            @endif

            Nome:{{ $account->name }} <br>
            Valor:{{ 'R$' . number_format($account->value, 2, ',', '.') }} <br>
            Data de Vencimento:
            {{ \Carbon\Carbon::parse($account->due_date)->tz('America/Sao_Paulo')->format('d/m/Y') }} <br>
            Cadastrado:
            {{ \Carbon\Carbon::parse($account->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i') }} <br>
            Editado:
            {{ \Carbon\Carbon::parse($account->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i') }}
            <br>
        </div>
    </div>
</div>
