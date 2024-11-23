<?php

namespace App\Console\Commands;

use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateAccountStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'accounts:update-status';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualiza o status das contas com base na data de vencimento';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now(); // data atual
        $fiveDaysLater = $now->copy()->addDays(4); // data daqui a 4 dias
        $urgentStatusId = 3; // ID do status "urgente" 
        $pendingStatusId = 2; // ID do status "pendente"
        $overdueStatusId = 5; // ID do status "atrasada" 
        $paidStatusId = 1; // ID do status "paga" 
        $cancelledStatusId = 4; // ID do status "cancelada" 

        // Atualizar status para "urgente" 
        Account::where('status_account_id', $pendingStatusId)
            ->where('due_date', '<=', $fiveDaysLater)
            ->where('due_date', '>=', $now)
            ->update(['status_account_id' => $urgentStatusId]);

        // Atualizar status para "atrasada" 
        Account::where('due_date', '<', $now)->whereNotIn('status_account_id', [$paidStatusId, $cancelledStatusId])->update(['status_account_id' => $overdueStatusId]);
        $this->info('Status das contas atualizados com sucesso!');
    }
}