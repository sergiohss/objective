<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Transacao;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class TransacaoPagamentoRequest extends FormRequest
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
            Transacao::NUMERO_CONTA => 'required|numeric',
            Transacao::VALOR => 'required|numeric|between:0,999999999.99',
            Transacao::FORMA_PAGAMENTO => 'required',
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
            Transacao::NUMERO_CONTA.'.required' => 'O campo Numero da Conta e obrigatorio',
            Transacao::NUMERO_CONTA.'.numeric' => 'O campo Numero da Conta deve ser to tipo numero',
            Transacao::VALOR.'.required' => 'O campo valor e obrigatorio',
            Transacao::VALOR.'.numeric' => 'O campo valor deve ser do tipo numero',
            Transacao::VALOR.'.between' => 'O campo valor deve estar com valor entre 0 e 999999999.99',
            Transacao::FORMA_PAGAMENTO.'.required' => 'O campo forma de pagamento e obrigatorio',
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
