<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Models\Account;
use App\Models\StatusAccount;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    // Listar contas
    public function index(Request $request)
    {
        // todo método de pesquisar
        $user = Auth::id();  // Obtém o usuário autenticado
        $accounts = Account::where('user_id', $user)
            ->when($request->has('name'), function ($whenQuery) use ($request) {
                $whenQuery->where('name', 'like', '%' . $request->name . '%');
            })
            ->when($request->filled('start_date'), function ($whenQuery) use ($request) {
                $whenQuery->where('due_date', '>=', \Carbon\Carbon::parse($request->start_date)->format('Y-m-d'));
            })
            ->when($request->filled('end_date'), function ($whenQuery) use ($request) {
                $whenQuery->where('due_date', '<=', \Carbon\Carbon::parse($request->end_date)->format('Y-m-d'));
            })
            ->with('statusAccount')
            ->orderByDesc('created_at')
            ->paginate(3)
            ->withQueryString();

        return view('accounts.index', [
            'accounts' => $accounts,
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
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
        /// Recuperar do banco de dados as situações (status), exceto 'Atrasada'
        $statusAccounts = StatusAccount::where('name', '!=', 'Atrasada')
            ->orderBy('name', 'asc')
            ->get();

        return view('accounts.create', [
            'statusAccounts' => $statusAccounts,
        ]);
    }

    // Armazenar nova conta
    public function store(AccountRequest $request)
    {
        try {
            // cadastrando no banco de dados
            $account = Account::create([
                'user_id' => Auth::id(),  // Associa o usuário autenticado à conta
                'name' => $request->name,
                'value' => str_replace(',', '.', str_replace('.', '', $request->value)),
                'due_date' => $request->due_date,
                'status_account_id' => $request->status_account_id,
            ]);
            // Salvar Log
            Log::info('Conta salva com sucesso', ['id' => $account->id, 'account' => $account]);

            // redirecionar para view show
            return redirect()->route('account.show', ['account' => $account->id])->with('success', 'Conta cadastrada com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log::warning('Conta não cadastrada', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Erro ao cadastrar a conta!');
        }
    }

    // Carregar form de editar conta
    public function edit(Account $account)
    {
        // Recuperar do banco de dados as situações (status), exceto 'Atrasada'
        $statusAccounts = StatusAccount::where('name', '!=', 'Atrasada')
            ->orderBy('name', 'asc')
            ->get();

        return view('accounts.edit', [
            'account' => $account,
            'statusAccounts' => $statusAccounts,
        ]);
    }

    // atualizar dados da nova conta
    public function update(AccountRequest $request, Account $account)
    {

        // editando as info no banco de dados
        try {
            $account->update([
                'name' => $request->name,
                'value' => str_replace(',', '.', str_replace('.', '', $request->value)),
                'due_date' => $request->due_date,
                'status_account_id' => $request->status_account_id,
            ]);

            // Salvar Log
            Log::info('Conta editado com sucesso', ['id' => $account->id, 'account' => $account]);

            // redirecionando após atualização
            return redirect()->route('account.show', ['account' => $account->id])->with('success', 'Conta editada com succeso!');
        } catch (Exception $e) {

            // Salvar Log
            Log::warning('Conta não editada', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Erro ao editar a conta!');
        }
    }

    // apagar uma conta
    public function destroy(Account $account)
    {
        // excluir registro do banco de dados
        $deleted = $account->delete();

        if ($deleted) {
            return redirect()->route('account.index')->with('success', 'Conta apagada com succeso!');
        }
        return redirect()->route('account.index')->with('error', 'Erro ao editar a conta!');
    }


    // metodo gerar pdf
    public function generatePdf(Request $request)
    {
        // id do usuário
        $user = Auth::id();
        // recuperando as contas
        $accounts = Account::where('user_id', $user)
            ->when($request->has('name'), function ($whenQuery) use ($request) {
                $whenQuery->where('name', 'like', '%' . $request->name . '%');
            })
            ->when($request->filled('start_date'), function ($whenQuery) use ($request) {
                $whenQuery->where('due_date', '>=', \Carbon\Carbon::parse($request->start_date)->format('Y-m-d'));
            })
            ->when($request->filled('end_date'), function ($whenQuery) use ($request) {
                $whenQuery->where('due_date', '<=', \Carbon\Carbon::parse($request->end_date)->format('Y-m-d'));
            })
            ->orderBy('due_date')
            ->get();

        // calcular a soma total dos valores
        $totalValue = $accounts->sum('value');

        // Gerando pdf
        $pdf = PDF::loadView('accounts.generate-pdf', [
            'accounts' => $accounts,
            'totalValue' => $totalValue,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('minhas_contas.pdf');
    }

    // alterar a situação da conta
    public function changeStatus(Account $account)
    {
        try {
            // editar as info do registro no banco de dados
            $account->update([
                'status_account_id' => $account->status_account_id == 1 ? 2 : 1,
            ]);

            // Salvar Log
            Log::info('Situação da conta editado com sucesso', ['id' => $account->id, 'account' => $account]);

            // manter na página após atualizar o status
            return back()->with('success', 'Situação da conta atualizada com sucesso!');
        } catch (Exception $e) {
            // Salvar Log
            Log::warning('Situação da conta não editada', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Erro ao editar a situação da conta!');
        }
    }

    // metodo gerar excel
    public function generateExcel(Request $request)
    {
        // id do usuário
        $user = Auth::id();
        // recuperando as contas
        $accounts = Account::where('user_id', $user)
            ->when($request->has('name'), function ($whenQuery) use ($request) {
                $whenQuery->where('name', 'like', '%' . $request->name . '%');
            })
            ->when($request->filled('start_date'), function ($whenQuery) use ($request) {
                $whenQuery->where('due_date', '>=', \Carbon\Carbon::parse($request->start_date)->format('Y-m-d'));
            })
            ->when($request->filled('end_date'), function ($whenQuery) use ($request) {
                $whenQuery->where('due_date', '<=', \Carbon\Carbon::parse($request->end_date)->format('Y-m-d'));
            })
            ->with('statusAccount')
            ->orderBy('due_date')
            ->get();

        // Calcular a soma total dos valores
        $totalValue = $accounts->sum('value');

        // Criar um arquivo temporário
        $csvFileName = tempnam(sys_get_temp_dir(), 'csv_');

        // Abrir o arquivo na forma de escrita
        $openFile = fopen($csvFileName, 'w');

        // Criar o cabeçalho do Excel
        $cabecalho = ['Nome', 'Vencimento', mb_convert_encoding('Situação', 'ISO-8859-1', 'UTF-8'), 'Valor'];

        // Escrever o cabeçalho no arquivo
        fputcsv($openFile, $cabecalho, ';');

        // Ler os registros recuperados do banco de dados
        foreach ($accounts as $account) {
            // Criar o array com os dados de linha do Excel
            $accountArray = [
                'name' => mb_convert_encoding($account->name, 'ISO-8859-1', 'UTF-8'),
                'due_date' => \Carbon\Carbon::parse($account->due_date)->format('d/m/Y'),
                'status' => mb_convert_encoding($account->statusAccount->name, 'ISO-8859-1', 'UTF-8'),
                'value' => number_format($account->value, 2, ',', '.'),
            ];

            // Escrever o conteúdo no arquivo
            fputcsv($openFile, $accountArray, ';');
        }

        // Criar o rodapé do Excel
        $rodape = ['', '', '', number_format($totalValue, 2, ',', '.')];

        // Escrever o conteúdo no arquivo
        fputcsv($openFile, $rodape, ';');

        // Fechar o arquivo após a escrita
        fclose($openFile);

        // Realizar o download do arquivo
        return response()->download($csvFileName, 'relatorio_contas_financeControl_' . Str::ulid() . '.csv');
    }
}