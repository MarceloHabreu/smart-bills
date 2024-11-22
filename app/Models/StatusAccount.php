<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusAccount extends Model
{
    use HasFactory;

    // indicar nome da tabela
    protected $table = 'status_accounts';

    // indicar colunas
    protected $fillable = [
        'name',
        'color',
    ];

    // relacionamentos
    public function account()
    {
        return $this->hasMany(Account::class);
    }
}
