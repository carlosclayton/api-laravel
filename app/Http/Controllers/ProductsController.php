<?php

namespace ApiVue\Http\Controllers;

use ApiVue\Criteria\OnlyTrashedCriteria;
use ApiVue\Criteria\OrderByCriteria;
use Illuminate\Http\Request;

use ApiVue\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use ApiVue\Http\Requests\ProductCreateRequest;
use ApiVue\Http\Requests\ProductUpdateRequest;
use ApiVue\Repositories\ProductRepository;
use ApiVue\Validators\ProductValidator;

/**
 * Class ProductsController.
 *
 * @package namespace ApiVue\Http\Controllers;
 */
class ProductsController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $repository;

    /**
     * @var ProductValidator
     */
    protected $validator;

    /**
     * ProductsController constructor.
     *
     * @param ProductRepository $repository
     * @param ProductValidator $validator
     */
    public function __construct(ProductRepository $repository, ProductValidator $validator)
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
        $products = $this->repository->paginate(10);

        return response()->json([
            'data' => $products,
        ]);
    }

    public function store(ProductCreateRequest $request)
    {
        try {

            $this->repository->create($request->all());
            return response()->json([
                'message' => 'Product created.',
            ]);

        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
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
        $product = $this->repository->find($id);
        return response()->json([
            'data' => $product,
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
        $product = $this->repository->find($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        try {
            $this->repository->update($request->all(), $id);
            return response()->json([
                'message' => 'Product updated.',
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
            'message' => 'Product deleted.'
        ]);

    }

    public function trashed()
    {
        $this->repository->pushCriteria(new OnlyTrashedCriteria());
        $categories = $this->repository->paginate(10);

        return response()->json([
            'data' => $categories,
        ]);
    }

    public function restore($id)
    {
        try {
            $this->repository->restore($id);
            return response()->json([
                'data' => 'Product restored.'
            ]);
        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ]);

        }
    }
}
