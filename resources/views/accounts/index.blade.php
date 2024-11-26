@extends('layouts.master')

@section('content')
    {{-- Aba de pesquisa --}}
    <div class="card mt-3 mb-4 border-light shadow">
        <div class="card-header d-flex justify-content-between">
            <span class="font-weight-bold">Pesquisar</span>
        </div>
        <div class="card-body">
            <form action="{{ route('account.index') }}">
                <div class="row">
                    {{-- Input para fazer a query pelo nome --}}
                    <div class="col-md-3 col-sm-12">
                        <label for="name" class="form-label">Nome:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $name }}" placeholder="Nome da conta">
                    </div>
                    {{-- Input para fazer a query pela data inicio --}}
                    <div class="col-md-3 col-sm-12">
                        <label for="start_date" class="form-label">Data Início:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $start_date }}">
                    </div>

                    {{-- Input para fazer a query pela data fim --}}
                    <div class="col-md-3 col-sm-12">
                        <label for="end_date" class="form-label">Data Fim:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $end_date }}">
                    </div>

                    <div class="col-md-3 col-sm-12 mt-3 pt-4">
                        {{-- Button Pesquisar --}}
                        <button type="submit" class="btn btn-info btn-sm"><i class="bi bi-search"></i> Pesquisar</button>
                        {{-- Button Limpar --}}
                        <a href="{{ route('account.index') }}" class="btn btn-warning btn-sm"><i class="bi bi-x-circle"></i> Limpar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="font-weight-bold">Contas</span>
            <span>
                {{-- Cadastrar a conta --}}
                <a href="{{ route('account.create') }}" class="btn btn-success btn-sm"><i class="bi bi-plus-circle"></i> Cadastrar Conta</a>
                {{-- Gerar pdf --}}
                <a href="{{ url('generate-pdf-account?' . request()->getQueryString()) }}" class="btn btn-warning btn-sm"><i class="bi bi-file-earmark-pdf"></i> Gerar PDF</a>
                {{-- Gerar excel --}}
                <a href="{{ url('generate-excel-account?' . request()->getQueryString()) }}" class="btn btn-success btn-sm"><i class="bi bi-file-earmark-excel"></i> Gerar Excel</a>
            </span>
        </div>

        {{-- Verificando se existe sessão de sucesso ou erro --}}
        <x-alert />

        {{-- Toda a listagem de Contas --}}
        <div class="card-body">
            @if ($accounts->isEmpty())
                <div class="alert alert-info d-flex align-items-center justify-content-center mt-4" role="alert">
                    <i class="bi bi-info-circle me-2"></i>
                    <span class="fs-5">Nenhuma Conta Cadastrada!</span>
                </div>
            @else
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Vencimento</th>
                            <th scope="col">Situação</th>
                            <th scope="col" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accounts as $account)
                            <tr>
                                {{-- Nome --}}
                                <td>{{ $account->name }}</td>

                                {{-- Valor --}}
                                <td>{{ 'R$' . number_format($account->value, 2, ',', '.') }}</td>

                                {{-- Adicionando 1 dia na visualização pois tem um erro que está atrasando um dia e ainda não identifiquei --}}
                                <td>{{ \Carbon\Carbon::parse($account->due_date)->addDay()->tz('America/Sao_Paulo')->format('d/m/Y') }}</td>

                                {{-- Status --}}
                                <td>
                                    <a href="{{ route('account.change-status', ['account' => $account->id]) }}">
                                        {!! '<span class="badge" style="background-color: ' . $account->statusAccount->color . '; color: white;">' . $account->statusAccount->name . '</span>' !!}
                                    </a>
                                </td>

                                <td class="d-md-flex justify-content-center">
                                    {{-- Ação visualizar --}}
                                    <a href="{{ route('account.show', ['account' => $account->id]) }}" class="btn btn-primary btn-sm me-1"><i class="bi bi-eye"></i> Visualizar</a>
                                    {{-- Ação editar --}}
                                    <a href="{{ route('account.edit', ['account' => $account->id]) }}" class="btn btn-warning btn-sm me-1"><i class="bi bi-pencil-square"></i> Editar</a>
                                    {{-- Ação apagar --}}
                                    <form id="formDelete{{ $account->id }}" action="{{ route('account.destroy', ['account' => $account->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="deleteConfirm(event, {{ $account->id }})" class="btn btn-danger btn-sm me-1"><i class="bi bi-trash"></i> Apagar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- Paginação --}}
        {{ $accounts->onEachSide(0)->links() }}
    </div>
    </div>
@endsection
