<div>
    <a href="{{ route('account.create') }}"><button type="button">Cadastrar Conta</button></a>

    <h2>Lista de Contas</h2>

    {{-- Verificando se existe sessão de succes! --}}
    <div>
        @if (session('success'))
            <p style="color: #082">
                {{ session('success') }}
            </p>
        @endif
    </div>

    <div>
        {{-- Listagem de Contas --}}
        @forelse ($accounts as $account)
            Nome: {{ $account->name }} <br>
            Valor: {{ 'R$' . number_format($account->value, 2, ',', '.') }} <br>
            Vencimento: {{ \Carbon\Carbon::parse($account->due_date)->tz('America/Sao_Paulo')->format('d/m/Y') }}
            <br>
            <br>

            {{-- Ação visualizar --}}
            <a href="{{ route('account.show', ['account' => $account->id]) }}"><button type="button">Visualizar</button></a>
            <br>
            {{-- Ação editar --}}
            <a href="{{ route('account.edit', ['account' => $account->id]) }}"><button type="button">Editar</button></a>
            <br>
            {{-- Ação apagar --}}
            <form action="{{ route('account.destroy', ['account' => $account->id]) }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
            </form>
            <hr>
        @empty
            <span style="color: #f00">Nenhuma conta encontrada!</span>
        @endforelse
    </div>
</div>
