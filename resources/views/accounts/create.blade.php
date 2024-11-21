@extends('layouts.master')

@section('content')
    <div>
        <div class="card mt-4 mb-4 border-light shadow">
            <div class="card-header d-flex justify-content-between">
                <span>
                    Criar Conta
                </span>
                <span>
                    <a href="{{ route('account.index') }}" class="btn btn-info btn-sm me-1">Home</a>
                </span>
            </div>

            {{-- Verificar se existe sessão error e imprimir ele --}}
            @if (session('error'))
                <div class="alert alert-danger m-3" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Mensagens de error --}}
            @if ($errors->any())
                <div class="alert alert-danger m-3" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }} <br>
                    @endforeach
                </div>
            @endif

            <div class="card-body">
                {{-- Form de cadastrar conta --}}
                <form action="{{ route('account.store') }}" method="POST" class="row g-3">
                    @csrf

                    {{-- Nome --}}
                    <div class="col-12">
                        <label for="name" class="form-label">Nome: </label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nome da conta" value="{{ old('name') }}">
                    </div>

                    {{-- Valor --}}
                    <div class="col-12">
                        <label for="value" class="form-label">Valor: </label>
                        <input type="text" class="form-control" name="value" id="value" placeholder="Valor da conta" value="{{ old('value') }}">
                    </div>

                    {{-- vencimento --}}
                    <div class="col-12">
                        <label for="due_date" class="form-label">Vencimento</label>
                        <input type="date" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') }}">
                    </div>

                    {{-- Botão --}}
                    <div class="col-12"><button type="submit" class="btn btn-success btn-sm">Cadastrar</button></div>
                </form>
            </div>
        </div>
    </div>
@endsection
