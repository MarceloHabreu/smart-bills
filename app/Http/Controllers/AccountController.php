<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    // Visualizar contas
    public function index()
    {
        return view('accounts.index');
    }

    // Detalhar uma conta
    public function show()
    {
        return view('accounts.show');
    }

    // Carregar form cadastrar nova conta
    public function create()
    {
        return view('accounts.create');
    }

    // Armazenar nova conta
    public function store()
    {
        dd('Criar');
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