<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    // Visualizar contas
    public function index()
    {
        $accounts = Account::orderByDesc('created_at')->get();

        return view('accounts.index', [
            'accounts' => $accounts,
        ]);
    }

    // Detalhar uma conta
    public function show(Account $account)
    {

        return view('accounts.show', ['account' => $account]);
    }

    // Carregar form cadastrar nova conta
    public function create()
    {
        return view('accounts.create');
    }

    // Armazenar nova conta
    public function store(AccountRequest $request)
    {
        // cadastrando no banco de dados
        $registred = Account::create($request->all());

        // redirecionar para view show
        if ($registred) {
            return redirect()->route('account.show', ['account' => $registred->id])->with('success', 'Conta cadastrada com sucesso!');
        }
        return redirect()->route('account.index')->with('error', 'Erro ao cadastrar a conta!');
    }

    // Carregar form de editar conta
    public function edit()
    {
        return view('accounts.edit');
    }

    // atualizar dados da nova conta
    public function update()
    {
        dd('Editar');
    }

    // apagar uma conta
    public function destroy()
    {
        dd('Apagar');
    }
}