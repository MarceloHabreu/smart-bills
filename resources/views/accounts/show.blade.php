@extends('layouts.master')

@section('content')
    <div>
        <div class="card mt-4 mb-4 border-light shadow">
            <div class="card-header d-flex justify-content-between">
                <span>
                    Visualizar Conta
                </span>
                <span>
                    <a href="{{ route('account.index') }}" class="btn btn-info btn-sm me-1">Home</a>
                    <a href="{{ route('account.edit', ['account' => $account->id]) }}" class="btn btn-warning btn-sm me-1">Editar</a>
                </span>
            </div>

            {{-- Verificando se existe sessão de succes! --}}
            <x-alert />

            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Nome:</dt>
                    <dd class="col-sm-9">{{ $account->name }}</dd>

                    <dt class="col-sm-3">Valor:</dt>
                    <dd class="col-sm-9">{{ 'R$' . number_format($account->value, 2, ',', '.') }}</dd>

                    <dt class="col-sm-3">Vencimento:</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($account->due_date)->tz('America/Sao_Paulo')->format('d/m/Y') }}</dd>

                    <dt class="col-sm-3">Cadastrado:</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($account->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i') }}</dd>

                    <dt class="col-sm-3">Editado:</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($account->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i') }}</dd>
                </dl>
            </div>
        </div>
    </div>
@endsection
