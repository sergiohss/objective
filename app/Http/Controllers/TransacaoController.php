<?php

namespace App\Http\Controllers;


use App\Exceptions\NotFoundException;
use App\Http\Requests\TransacaoPagamentoRequest;
use App\Services\TransacaoService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;



class TransacaoController extends Controller
{

    /**
     * @var TransacaoService
     */
    protected $transacaoService;

    /**
     * TransacaoController constructor.
     * @param TransacaoService $transacaoService
     */
    public function __construct(TransacaoService $transacaoService)
    {
        $this->transacaoService = $transacaoService;
    }

    /**
     * @OA\Post(
     *      path="/api/transacao",
     *      operationId="FazerPagamento",
     *      tags={"Transacao"},
     *      summary="Realizar pagamento",
     *      description="Realiza pagamento e retorna novo saldo da conta",
     *      @OA\RequestBody(
     *       description="Body Params",
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="forma_pagamento",
     *                          type="enum"
     *                      ),
     *                      @OA\Property(
     *                          property="numero_conta",
     *                          type="int"
     *                      ),
     *                      @OA\Property(
     *                          property="valor",
     *                          type="float"
     *                      )
     *                 ),
     *                 example={
     *                     "forma_pagamento":"D",
     *                     "numero_conta":"234",
     *                     "saldo":"180.37"
     *                }
     *           )
     *       )
     *   ),
     *   @OA\Response(response=201, description="Operação realizada com sucesso."),
     *   @OA\Response(response=404, description="A conta não possui saldo disponivel."),
     *   @OA\Response(response=500, description="Servidor não pode atender à solicitação.")
     * )
     */
    public function pagamento(TransacaoPagamentoRequest $request)
    {
        try {
            DB::beginTransaction();

            $retorno = $this->transacaoService->realizarPagamento($request->all());

            DB::commit();
            return response()->json(
                $retorno,
                JsonResponse::HTTP_CREATED
            );
        } catch (NotFoundException $e){

            return response()->json(
                [
                    'message'   => $e->getMessage(),
                    'timestamp' => Carbon::now()->toDateTimeString()
                ],
                JsonResponse::HTTP_NOT_FOUND
            );
        } catch (\Exception $e){

            return response()->json(
                [
                    'message'   => $e->getMessage(),
                    'timestamp' => Carbon::now()->toDateTimeString()
                ],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


}
