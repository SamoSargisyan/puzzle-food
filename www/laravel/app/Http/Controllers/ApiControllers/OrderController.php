<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\ShowRequest;
use App\Http\Requests\Api\Order\StoreRequest;
use App\Http\Requests\Api\Order\UpdateRequest;
use App\Http\Resources\Api\Order\OrderResource;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class OrderController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/orders",
     *     summary="Создание заказа",
     *     tags={"Заказы"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreRequest"),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Заказ успешно создан",
     *         @OA\JsonContent(ref="#/components/schemas/OrderResource"),
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Ошибка авторизации",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/AuthorizationException")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/ValidationException")
     *         )
     *     ),
     * )
     */
    public function store(StoreRequest $request)
    {
        $user = Auth::user();

        $dataArray = $request->validated();
        $dataArray['order_id'] = Uuid::uuid4();
        $order = $user->orders()
            ->create($dataArray);

        return response()->json(OrderResource::make($order));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/orders",
     *     summary="Просмотр заказа",
     *     tags={"Заказы"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ShowRequest"),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Позитивный сценарий",
     *         @OA\JsonContent(ref="#/components/schemas/OrderResource"),
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Ошибка авторизации",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/AuthorizationException")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/ValidationException")
     *         )
     *     ),
     * )
     */
    public function show(ShowRequest $request)
    {
        $order = Order::find($request->id);

        $this->authorize('show', $order);

        return response()->json(OrderResource::make($order));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/orders",
     *     summary="Обновление заказа",
     *     tags={"Заказы"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateRequest"),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Позитивный сценарий",
     *         @OA\JsonContent(ref="#/components/schemas/OrderResource"),
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Ошибка авторизации",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/AuthorizationException")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/ValidationException")
     *         )
     *     ),
     * )
     */
    public function update(UpdateRequest $request)
    {
        $order = Order::find($request->id);
        $dataArray = $request->validated();

        $order->update($dataArray);

        return response()->json(OrderResource::make($order));
    }
}
