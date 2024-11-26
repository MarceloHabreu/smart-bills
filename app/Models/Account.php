<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    // indicar nome da tabela
    protected $table = 'accounts';

    // indicar colunas
    protected $fillable = [
        'name',
        'value',
        'due_date',
        'status_account_id',
        'user_id',
    ];

    // relacionamento
    public function statusAccount()
    {
        return $this->belongsTo(StatusAccount::class);
    }
}