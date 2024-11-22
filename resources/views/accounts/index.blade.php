@extends('layouts.master')

@section('content')
    {{-- Aba de pesquisa --}}
    <div class="card mt-3 mb-4 border-light shadow">
        <div class="card-header d-flex justify-content-between">
            <span>Pesquisar</span>
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
                        <button type="submit" class="btn btn-info btn-sm">Pesquisar</button>
                        {{-- Button Limpar --}}
                        <a href="{{ route('account.index') }}" class="btn btn-warning btn-sm">Limpar</a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header d-flex justify-content-between">
            <span>
                Contas
            </span>
            <span>
                {{-- Cadastrar a conta --}}
                <a href="{{ route('account.create') }}" class="btn btn-success btn-sm">Cadastrar Conta</a>
                {{-- Gerar pdf --}}
                {{-- <a href="{{ route('account.generate-pdf') }}" class="btn btn-warning btn-sm">Gerar PDF</a> --}}
                <a href="{{ url('generate-pdf-account?' . request()->getQueryString()) }}" class="btn btn-warning btn-sm">Gerar PDF</a>
            </span>
        </div>

        {{-- Verificando se existe sessão de succes! --}}
        @if (session('success'))
            <div class="alert alert-success m-3" role="alert"> {{ session('success') }}
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Toda a listagem de Contas --}}
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Vencimento</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($accounts as $account)
                        <tr>
                            <td>{{ $account->name }}</td>
                            <td>{{ 'R$' . number_format($account->value, 2, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($account->due_date)->tz('America/Sao_Paulo')->format('d/m/Y') }}</td>
                            <td class="d-md-flex justify-content-center">
                                {{-- Ação visualizar --}}
                                <a href="{{ route('account.show', ['account' => $account->id]) }}"class="btn btn-primary btn-sm me-1">Visualizar</a>
                                {{-- Ação editar --}}
                                <a href="{{ route('account.edit', ['account' => $account->id]) }}" class="btn btn-warning btn-sm me-1">Editar</a>
                                {{-- Ação apagar --}}
                                <form action="{{ route('account.destroy', ['account' => $account->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')" class="btn btn-danger btn-sm me-1">Apagar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger m-3" role="alert"> Nenhuma conta encontrada!
                        </div>
                    @endforelse
                </tbody>
            </table>
            {{-- Paginação --}}
            {{ $accounts->onEachSide(0)->links() }}
        </div>
    </div>
@endsection
