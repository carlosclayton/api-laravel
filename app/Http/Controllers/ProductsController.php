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
     * @OA\Get(
     *     tags={"Products"},
     *     path="/api/products",
     *     summary="List of products",
     *     description="Return a list of products",
     *     @OA\Response(response="200", description="An json"),
     *      security={
     *           {"apiKey": {}}
     *       }
     * )
     */
    public function index()
    {
        $this->repository->pushCriteria(new OrderByCriteria('ID', 'DESC'));
        $products = $this->repository->paginate(10);

        return response()->json([
            'data' => $products,
        ]);
    }

    /**
     * @OA\Post(
     *      tags={"Products"},
     *      path="/api/products",
     *      summary="Store a product",
     *      description="Return message",
     *      @OA\Parameter(
     *          name="name",
     *          description="Name field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="price",
     *          description="Price field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="number",
     *              format="float"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="category_id",
     *          description="Category ID field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="description",
     *          description="Description",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(response="200", description="Store products"),
     *      security={
     *           {"apiKey": {}}
     *      }
     * )
     */
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
     * @OA\Get(
     *     tags={"Products"},
     *     path="/api/products/{id}",
     *     operationId="getProductById",
     *     @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of product to return",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     summary="Show a product",
     *     description="Return a product",
     *     @OA\Response(response="200", description="An json"),
     *     security={
     *           {"apiKey": {}}
     *     }
     * )
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
     * @OA\Put(
     *      tags={"Products"},
     *      path="/api/products/{id}",
     *      summary="Update a product",
     *      description="Return message",
     *     operationId="getProductById",
     *     @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of product to return",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="name",
     *          description="Name field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="price",
     *          description="Price field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="number",
     *              format="float"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="category_id",
     *          description="Category ID field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="description",
     *          description="Description",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(response="200", description="Store products"),
     *      security={
     *           {"apiKey": {}}
     *      }
     * )
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
     * @OA\Delete(
     *     tags={"Products"},
     *     path="/api/products/{id}",
     *     operationId="getProductsById",
     *     @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of products to return",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     summary="Delete a product",
     *     description="Delete a product",
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
            'message' => 'Product deleted.'
        ]);

    }

    /**
     * @OA\Get(
     *     tags={"Products"},
     *     path="/api/products/trashed",
     *     summary="List of trashed products",
     *     description="Return a list of trashed products",
     *     @OA\Response(response="200", description="An json"),
     *      security={
     *           {"apiKey": {}}
     *       }
     * )
     */
    public function trashed()
    {
        $this->repository->pushCriteria(new OnlyTrashedCriteria());
        $categories = $this->repository->paginate(10);

        return response()->json([
            'data' => $categories,
        ]);
    }

    /**
     * @OA\Put(
     *      tags={"Products"},
     *      path="/api/products/restore/{id}",
     *      summary="Restore a product",
     *      description="Restore a product",
     *      operationId="getProductById",
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
