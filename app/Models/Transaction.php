<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const TYPE_DEBIT = 'debit';
    const TYPE_CREDIT = 'credit';

    const REASON_STOCK = 'stock';
    const REASON_REFUND = 'refund';

    protected $fillable = ['wallet_id', 'type', 'value', 'reason'];
}
