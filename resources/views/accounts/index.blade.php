@extends('layouts.master')

@section('content')
    <div>
        <div class="card mt-4 mb-4 border-light shadow">
            <div class="card-header d-flex justify-content-between">
                <span>
                    Contas
                </span>
                <span>
                    <a href="{{ route('account.create') }}" class="btn btn-success btn-sm">Cadastrar Conta</a>
                </span>
            </div>

            {{-- Verificando se existe sessão de succes! --}}
            @if (session('success'))
                <div class="alert alert-success m-3" role="alert"> {{ session('success') }}
                    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

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
                        {{-- Listagem de Contas --}}
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
                            <span style="color: #f00">Nenhuma conta encontrada!</span>
                        @endforelse
                    </tbody>
                </table>
                {{ $accounts->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection
