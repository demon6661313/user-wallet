<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    const CURRENCY_USD = 'USD';
    const CURRENCY_RUB = 'RUB';

    protected $fillable = ['user_id', 'currency', 'balance'];

    public function updateBalance(string $type, int|float $value)
    {
        if ($type == Transaction::TYPE_DEBIT) {
            $this->balance += $value;
        }
        if ($type == Transaction::TYPE_CREDIT) {
            $this->balance -= $value;
        }
        $this->save;
    }
}
