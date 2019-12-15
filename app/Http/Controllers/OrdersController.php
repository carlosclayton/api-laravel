<?php

namespace ApiVue\Http\Controllers;

use ApiVue\Criteria\OnlyTrashedCriteria;
use ApiVue\Criteria\OrderByCriteria;
use Illuminate\Http\Request;

use ApiVue\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use ApiVue\Http\Requests\OrderCreateRequest;
use ApiVue\Http\Requests\OrderUpdateRequest;
use ApiVue\Repositories\OrderRepository;
use ApiVue\Validators\OrderValidator;

/**
 * Class OrdersController.
 *
 * @package namespace ApiVue\Http\Controllers;
 */
class OrdersController extends Controller
{
    /**
     * @var OrderRepository
     */
    protected $repository;

    /**
     * @var OrderValidator
     */
    protected $validator;

    /**
     * OrdersController constructor.
     *
     * @param OrderRepository $repository
     * @param OrderValidator $validator
     */
    public function __construct(OrderRepository $repository, OrderValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @OA\Get(
     *     tags={"Orders"},
     *     path="/api/orders",
     *     summary="List of orders",
     *     description="Return a list of orders",
     *     @OA\Response(response="200", description="An json"),
     *      security={
     *           {"apiKey": {}}
     *       }
     * )
     */
    public function index()
    {
        $this->repository->pushCriteria(new OrderByCriteria('ID', 'DESC'));
        $orders = $this->repository->paginate(10);

        return response()->json([
            'data' => $orders,
        ]);
    }

    /**
     * @OA\Post(
     *      tags={"Orders"},
     *      path="/api/orders",
     *      summary="Store a order",
     *      description="Return message",
     *      @OA\Parameter(
     *          name="status",
     *          description="Status field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="user_id",
     *          description="User ID",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="product_id",
     *          description="Product ID",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(response="200", description="Store a order"),
     *      security={
     *           {"apiKey": {}}
     *      }
     * )
     */
    public function store(OrderCreateRequest $request)
    {
        try {
            $this->repository->create($request->all());
            return response()->json([
                'message' => 'Order created.',
            ]);

        } catch (ValidatorException $e) {
            return response()->json([
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * @OA\Get(
     *     tags={"Orders"},
     *     path="/api/orders/{id}",
     *     operationId="getOrderById",
     *     @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of order",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     summary="Show a order",
     *     description="Return a order",
     *     @OA\Response(response="200", description="An json"),
     *     security={
     *           {"apiKey": {}}
     *     }
     * )
     */
    public function show($id)
    {
        $order = $this->repository->find($id);
        return response()->json([
            'data' => $order,
        ]);
    }


    public function edit($id)
    {
        $order = $this->repository->find($id);
        return view('orders.edit', compact('order'));
    }

    /**
     * @OA\Put(
     *      tags={"Orders"},
     *      path="/api/orders/{id}",
     *      operationId="getOrderById",
     *      summary="Update a order",
     *      description="Return message",
     *      @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of order",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="status",
     *          description="Status field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="user_id",
     *          description="User ID",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="product_id",
     *          description="Product ID",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(response="200", description="Store a order"),
     *      security={
     *           {"apiKey": {}}
     *      }
     * )
     */
    public function update(OrderUpdateRequest $request, $id)
    {
        try {
            $this->repository->update($request->all(), $id);
            return response()->json([
                'message' => 'Order updated.'
            ]);

        } catch (ValidatorException $e) {
            return response()->json([
                'message' => $e->getMessageBag()
            ]);
        }
    }


    /**
     * @OA\Delete(
     *     tags={"Orders"},
     *     path="/api/orders/{id}",
     *     operationId="getOrderById",
     *     @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of order",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     summary="Delete a order",
     *     description="Delete a order",
     *     @OA\Response(response="200", description="An json"),
     *     security={
     *           {"apiKey": {}}
     *     }
     * )
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->json([
            'message' => 'Order deleted.'
        ]);

    }



    /**
     * @OA\Get(
     *     tags={"Orders"},
     *     path="/api/orders/trashed",
     *     summary="List of trashed orders",
     *     description="Return a list of trashed orders",
     *     @OA\Response(response="200", description="An json"),
     *      security={
     *           {"apiKey": {}}
     *       }
     * )
     */
    public function trashed()
    {
        $this->repository->pushCriteria(new OnlyTrashedCriteria());
        $orders = $this->repository->paginate(10);

        return response()->json([
            'data' => $orders,
        ]);
    }

    /**
     * @OA\Put(
     *      tags={"Orders"},
     *      path="/api/orders/restore/{id}",
     *      summary="Restore a order",
     *      description="Restore a order",
     *      operationId="getOrderById",
     *     @OA\Response(response="200", description="Store categories"),
     *      security={
     *           {"apiKey": {}}
     *      }
     * )
     */
    public function restore($id)
    {
        try {
            $this->repository->restore($id);
            return response()->json([
                'data' => 'Order restored.'
            ]);
        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ]);

        }
    }
}
