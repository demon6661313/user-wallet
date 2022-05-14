<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'wallet_id' => ['required', Rule::exists('wallets', 'id')],
            'type' => ['required', Rule::in([Transaction::TYPE_DEBIT, Transaction::TYPE_CREDIT])],
            'value' => ['required', 'integer'],
            'currency' => ['required', Rule::in([Wallet::CURRENCY_USD, Wallet::CURRENCY_RUB])],
            'reason' => ['required', Rule::in([Transaction::REASON_STOCK, Transaction::REASON_REFUND])]
        ];
    }
    public function messages()
    {
        return [
            '*.required' => 'поле обязательно',
            'wallet_id.exists' => 'Кошелек не найден',
            'type.in' => 'Допустимые значения: debit, credit',
            'value.integer' => 'Должно быть числом',
            'currency.in' => 'Допустимые значения: RUB, USD',
            'reason.in' => 'Допустимые значения: stock, refund'
        ];
    }
}
