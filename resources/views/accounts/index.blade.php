<div>
    <a href="{{ route('account.create') }}">Cadastrar Conta</a>

    <h2>Lista de Contas</h2>
    <div>
        @forelse ($accounts as $account)
            Nome: {{ $account->name }} <br>
            Valor: {{ 'R$' . number_format($account->value, 2, ',', '.') }} <br>
            Vencimento: {{ \Carbon\Carbon::parse($account->due_date)->tz('America/Sao_Paulo')->format('d/m/Y') }}
            <br>
            <br>
            <a href="{{ route('account.show', ['account' => $account->id]) }}">Visualizar</a>
            <hr>
        @empty
            <span style="color: #f00">Nenhuma conta encontrada!</span>
        @endforelse
    </div>

    {{-- <a href="{{ route('account.edit') }}">Editar</a>
    <a href="{{ route('account.destroy') }}">Apagar</a>  --}}

</div>
