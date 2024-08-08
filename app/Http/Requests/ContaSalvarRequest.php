<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Conta;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ContaSalvarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Conta::NUMERO => 'required|numeric|unique:'.Conta::TABELA.','.Conta::NUMERO,
            Conta::SALDO => 'required|numeric|between:0,999999999.99',
        ];
    }

    /**
     * Get messages from errors
     *
     * @return array|string[]
     */
    public function messages()
    {
        return [
            Conta::NUMERO.'.required' => 'O campo Numero da Conta e obrigatorio',
            Conta::NUMERO.'.numeric' => 'O campo Numero da conta deve ser do tipo numero',
            Conta::NUMERO.'.unique' => 'Ja existe uma conta com esse numero',
            Conta::SALDO.'.required' => 'O campo Saldo da Conta e obrigatorio',
            Conta::SALDO.'.numeric' => 'O campo Saldo da Conta precisa ser um numero',
            Conta::SALDO.'.between' => 'O campo Saldo da Conta deve estar com valor entre 0 e 999999999.99',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                $validator->errors(),
            ], JsonResponse::HTTP_BAD_REQUEST)
        );
    }
}
