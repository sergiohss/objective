<?php

namespace App\Http\Controllers;


use App\Exceptions\NotFoundException;
use App\Http\Requests\ContaSalvarRequest;
use App\Http\Requests\ContaVisualizarRequest;
use App\Services\ContaService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;



/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Objective API",
 *      description="",
 *      @OA\Contact(
 *          email="sergio.hss@hotmail.com"
 *      ),
 * )
 *
 * @OA\Server(
 *      url="http://localhost:9191",
 *      description="API Server"
 * )
 *
 *
 * @OA\Tag(
 *     name="Contas",
 *     description="API Endpoints de Contas"
 * )
 */


class ContaController extends Controller
{


    /**
     * @var ContaService
     */
    protected $contaService;

    /**
     * ContaController constructor.
     * @param ContaService $contaService
     */
    public function __construct(ContaService $contaService)
    {
        $this->contaService = $contaService;
    }

    /**
     * @OA\Post(
     *      path="/api/conta",
     *      operationId="CriarConta",
     *      tags={"Conta"},
     *      summary="Criar nova conta",
     *      description="Retorna dados conta",
     *      @OA\RequestBody(
     *       description="Body Params",
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="numero_conta",
     *                          type="int"
     *                      ),
     *                      @OA\Property(
     *                          property="saldo",
     *                          type="float"
     *                      )
     *                 ),
     *                 example={
     *                     "numero_conta":"234",
     *                     "saldo":"180.37"
     *                }
     *           )
     *       )
     *   ),
     *   @OA\Response(response=201, description="Operação realizada com sucesso."),
     *   @OA\Response(response=404, description="Registro não encontrado."),
     *   @OA\Response(response=500, description="Servidor não pode atender à solicitação.")
     * )
     */
    public function criar(ContaSalvarRequest $request)
    {
        try {
            DB::beginTransaction();

            $retorno = $this->contaService->salvar($request->all());

            DB::commit();
            return response()->json(
                $retorno,
                JsonResponse::HTTP_CREATED
            );
        } catch (NotFoundException $e){
            DB::rollBack();
            return response()->json(
                [
                    'message'   => $e->getMessage(),
                    'timestamp' => Carbon::now()->toDateTimeString()
                ],
                JsonResponse::HTTP_NOT_FOUND
            );
        } catch (\Exception $e){
            DB::rollBack();
            return response()->json(
                [
                    'message'   => $e->getMessage(),
                    'timestamp' => Carbon::now()->toDateTimeString()
                ],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @OA\Get(
     *      path="/api/conta",
     *      operationId="BuscarContaPorNumero",
     *      tags={"Conta"},
     *      summary="Visualizar conta",
     *      description="Retorna dados da conta",
     *      @OA\RequestBody(
     *       description="Body Params",
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="numero_conta",
     *                          type="int"
     *                      ),
     *                 ),
     *                 example={
     *                     "numero_conta":"234",
     *                }
     *           )
     *       )
     *   ),
     *   @OA\Response(response=200, description="Busca realizada com sucesso."),
     *   @OA\Response(response=404, description="Registro não encontrado."),
     *   @OA\Response(response=500, description="Servidor não pode atender à solicitação.")
     * )
     */
    public function visualizar(ContaVisualizarRequest $request)
    {
        try {
            return response()->json(
                $this->contaService->visualizar($request->all()),
                JsonResponse::HTTP_OK
            );
        }catch (NotFoundException $e){
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
