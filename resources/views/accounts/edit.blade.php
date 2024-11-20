<div>
    <a href="{{ route('account.index') }}"><button type="button">Home</button></a>
    <div>
        <h2>Editar Conta</h2>

        {{-- Mensagens de error --}}
        @if ($errors->any())
            <span style="color: #f00">
                @foreach ($errors->all() as $error)
                    {{ $error }} <br>
                @endforeach
            </span>
            <br>
        @endif

        {{-- Form de cadastrar conta --}}
        <form action="{{ route('account.update', ['account' => $account->id]) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nome --}}
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="nome da conta..." value="{{ old('name', $account->name) }}">
            <br>

            {{-- Valor --}}
            <label for="value">Valor:</label>
            <input type="text" name="value" id="value" placeholder="valor..." value="{{ old('value', $account->value) }}"> <br>

            {{-- Vencimento --}}
            <label for="due_date">Vencimento: </label>
            <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $account->due_date) }}"> <br>

            {{-- Botão --}}
            <button type="submit">Atualizar</button>
        </form>
    </div>
</div>
