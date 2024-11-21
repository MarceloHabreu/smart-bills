@extends('layouts.master')

@section('content')
    <div>
        <a href="{{ route('account.index') }}"><button type="button">Home</button></a><br><br>

        <h2>Cadastrar Conta</h2>

        {{-- Verificar se existe sessão error e imprimir ele --}}
        @if (session('error'))
            <p style="color: #f00">
                {{ session('error') }}
            </p>
        @endif

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
        <form action="{{ route('account.store') }}" method="POST">
            @csrf

            {{-- Nome --}}
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="nome da conta..." value="{{ old('name') }}"> <br>

            {{-- Valor --}}
            <label for="value">Valor:</label>
            <input type="text" name="value" id="value" placeholder="valor..." value="{{ old('value') }}"> <br>

            {{-- Vencimento --}}
            <label for="due_date">Vencimento: </label>
            <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}"> <br>

            {{-- Botão --}}
            <button type="submit">Cadastar</button>
        </form>
    </div>


@endsection
