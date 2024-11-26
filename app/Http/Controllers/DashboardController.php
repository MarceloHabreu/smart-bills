<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::id();
        // total de contas registradas
        $totalAccounts = Account::where('user_id', $user)->count();

        // Quantidade de contas pendentes este mês
        $quantityPending = Account::where('user_id', $user)
            ->where('status_account_id', 2)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        // Quantidade de contas pagas este mês
        $quantityPaid = Account::where('user_id', $user)
            ->where('status_account_id', 1)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        // Total gasto com contas pagas este mês
        $totalSpent = Account::where('user_id', $user)
            ->where('status_account_id', 1)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('value');

        // Contas urgentes
        $urgentAccounts = Account::where('user_id', $user)
            ->where('status_account_id', 3)
            ->get();

        // Contas atrasadas
        $overdueAccounts = Account::where('user_id', $user)
            ->where('status_account_id', 5)
            ->get();

        // Lógica para o gráfico de contas pagas 
        $paidAccountsByMonth = Account::where('user_id', $user)
            ->where('status_account_id', 1)
            ->selectRaw('MONTH(created_at) as month, SUM(value) as total')  //aqui vai pegar o mês da data de pagamento da conta e somando o total
            ->groupBy('month') // agrupando todas pagas neste mês
            ->pluck('total', 'month') // aqui gera tipo chave e valor, e o mês é a chave!
            ->toArray(); // passando em forma de array
        // Gerar array com 12 meses 
        $monthlyPayments = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyPayments[] = $paidAccountsByMonth[$i] ?? 0;  // se tiver um mês sem contas pagas será 0
        }

        // Retornar a view passando todas as informações
        return view('dashboard', compact('totalAccounts', 'quantityPending', 'quantityPaid', 'totalSpent', 'urgentAccounts', 'overdueAccounts', 'monthlyPayments'));
    }
}