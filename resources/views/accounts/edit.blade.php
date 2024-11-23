@extends('layouts.master')

@section('content')
    <div>
        <div class="card mt-4 mb-4 border-light shadow">
            <div class="card-header d-flex justify-content-between">
                <span>
                    Editar Conta
                </span>
                <span>
                    <a href="{{ route('account.index') }}" class="btn btn-info btn-sm me-1">Home</a>
                    <a href="{{ route('account.show', ['account' => $account->id]) }}" class="btn btn-primary btn-sm me-1">Visualizar</a>
                </span>
            </div>

            {{-- Verificando se existe sessão de succes ou error! --}}
            <x-alert />

            <div class="card-body">
                {{-- Form de editar conta --}}
                <form action="{{ route('account.update', ['account' => $account->id]) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')

                    {{-- Nome --}}
                    <div class="col-md-12 col-sm-12">
                        <label for="name" class="form-label">Nome: </label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nome da conta" value="{{ old('name', $account->name) }}">
                    </div>

                    {{-- Valor --}}
                    <div class="col-md-4 col-sm-12">
                        <label for="value" class="form-label">Valor: </label>
                        <input type="text" class="form-control" name="value" id="value" placeholder="Valor da conta"
                            value="{{ old('value', isset($account->value) ? number_format($account->value, '2', ',', '.') : '') }}">
                    </div>

                    {{-- vencimento --}}
                    <div class="col-md-4 col-sm-12">
                        <label for="due_date" class="form-label">Vencimento</label>
                        <input type="date" class="form-control" name="due_date" id="due_date" value="{{ old('due_date', $account->due_date) }}">
                    </div>

                    {{-- situaçcao/status --}}
                    <div class="col-md-4 col-sm-12 ">
                        <label for="status_account_id" class="form-label">Situação da Conta</label>
                        <select name="status_account_id" id="status_account_id" class="form-select">
                            <option value="">Selecione</option>
                            @forelse ($statusAccounts as $statusAccount)
                                <option value="{{ $statusAccount->id }}" {{ old(' status_account_id', $account->status_account_id) == $statusAccount->id ? 'selected' : '' }}>{{ $statusAccount->name }}
                                </option>
                            @empty
                                <option value="">Nenhuma situação de conta encontrada</option>
                            @endforelse
                        </select>
                    </div>

                    {{-- Botão --}}
                    <div class="col-12"><button type="submit" class="btn btn-warning btn-sm">Atualizar</button></div>
                </form>
            </div>
        </div>
    </div>
@endsection
