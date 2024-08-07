<?php

namespace App\Http\Controllers;

use App\Enums\HTTPStatus;
use App\Exceptions\NotFoundException;
use App\Http\Requests\ContaStoreRequest;
use App\Services\ContaService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/**
 * Class ContaController
 * @package App\Http\Controllers
 */
class ContaController extends Controller
{

    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Objective API",
     *      description="",
     *      @OA\Contact(
     *          email="sergio.hss@hotmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url="http://localhost:9191",
     *      description="API Server"
     * )

     *
     * @OA\Tag(
     *     name="Contas",
     *     description="API Endpoints de Contas"
     * )
     */

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
     *      path="/api/v1/conta",
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
     *                     property="numero_conta",
     *                     type="int",
     *                     example="234"
     *                  ),
     *                  @OA\Property(
     *                     property="saldo",
     *                     type="float",
     *                     example="180.37"
     *                  ),
     *           )
     *       )
     *   ),
     *      @OA\Response(
     *          response=201,
     *          description="Operação Realizada com Sucesso."
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Servidor não pode atender à solicitação."
     *      )
     * )
     */

    /**
     * @param ContaStoreRequest $request
     * @return JsonResponse
     */
    public function criar(ContaStoreRequest $request)
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
                JsonResponse::HTTP_BAD_REQUEST
            );
        }


    }
}
