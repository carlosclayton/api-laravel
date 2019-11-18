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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(new OrderByCriteria('ID', 'DESC'));
        $orders = $this->repository->paginate(10);

        return response()->json([
            'data' => $orders,
        ]);
    }


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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->repository->find($id);
        return response()->json([
            'data' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = $this->repository->find($id);
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrderUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
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
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->json([
            'message' => 'Order deleted.'
        ]);

    }

    public function trashed()
    {
        $this->repository->pushCriteria(new OnlyTrashedCriteria());
        $orders = $this->repository->paginate(10);

        return response()->json([
            'data' => $orders,
        ]);
    }

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
