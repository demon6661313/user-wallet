<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetBalanceRequest extends FormRequest
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
        ];
    }
    public function messages()
    {
        return [
            'wallet_id.required' => 'Требуется id кошелька',
            'wallet_id.exists' => 'Кошелек не найден',
        ];
    }
}
