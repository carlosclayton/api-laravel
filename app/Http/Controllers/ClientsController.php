<?php

namespace ApiVue\Http\Controllers;

use ApiVue\Criteria\OnlyTrashedCriteria;
use ApiVue\Criteria\OrderByCriteria;
use Illuminate\Http\Request;

use ApiVue\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use ApiVue\Http\Requests\ClientCreateRequest;
use ApiVue\Http\Requests\ClientUpdateRequest;
use ApiVue\Repositories\ClientRepository;
use ApiVue\Validators\ClientValidator;

/**
 * Class ClientsController.
 *
 * @package namespace ApiVue\Http\Controllers;
 */
class ClientsController extends Controller
{
    /**
     * @var ClientRepository
     */
    protected $repository;

    /**
     * @var ClientValidator
     */
    protected $validator;

    /**
     * ClientsController constructor.
     *
     * @param ClientRepository $repository
     * @param ClientValidator $validator
     */
    public function __construct(ClientRepository $repository, ClientValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @OA\Get(
     *     tags={"Clients"},
     *     path="/api/clients",
     *     summary="List of clients",
     *     description="Return a list of clients",
     *     @OA\Response(response="200", description="An json"),
     *      security={
     *           {"apiKey": {}}
     *       }
     * )
     */
    public function index()
    {
        $this->repository->pushCriteria(new OrderByCriteria('ID', 'DESC'));
        $clients = $this->repository->paginate(10);
        return response()->json([
            'data' => $clients,
        ]);
    }

    /**
     * @OA\Post(
     *      tags={"Clients"},
     *      path="/api/clients",
     *      summary="Store a client",
     *      description="Return message",
     *      @OA\Parameter(
     *          name="type",
     *          description="Type field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="address",
     *          description="Address field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="city",
     *          description="City field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="state",
     *          description="State field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="zipcode",
     *          description="Zipcode field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="phone",
     *          description="Phone field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="Email field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="website",
     *          description="Website field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
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
     *          description="User ID field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(response="200", description="Store clients"),
     *      security={
     *           {"apiKey": {}}
     *      }
     * )
     */
    public function store(ClientCreateRequest $request)
    {
        try {

            $this->repository->create($request->all());
            return response()->json([
                'message' => 'Client created.',
            ]);

        } catch (ValidatorException $e) {
            return response()->json([
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * @OA\Get(
     *     tags={"Clients"},
     *     path="/api/clients/{id}",
     *     operationId="getClientById",
     *     @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of client to return",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     summary="Show a client",
     *     description="Return a client",
     *     @OA\Response(response="200", description="An json"),
     *     security={
     *           {"apiKey": {}}
     *     }
     * )
     */

    public function show($id)
    {
        $client = $this->repository->find($id);

        return response()->json([
            'data' => $client,
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
        $client = $this->repository->find($id);

        return view('clients.edit', compact('client'));
    }

    /**
     * @OA\Put(
     *      tags={"Clients"},
     *      path="/api/clients/{id}",
     *      summary="Update a client",
     *      description="Update a client",
     *      operationId="getClientById",
     *      @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of client to return",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="type",
     *          description="Type field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="address",
     *          description="Address field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="city",
     *          description="City field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="state",
     *          description="State field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="zipcode",
     *          description="Zipcode field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="phone",
     *          description="Phone field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="Email field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="website",
     *          description="Website field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
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
     *          description="User ID field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(response="200", description="Store categories"),
     *      security={
     *           {"apiKey": {}}
     *      }
     * )
     */
    public function update(ClientUpdateRequest $request, $id)
    {
        try {

            $this->repository->update($request->all(), $id);
            return response()->json([
                'message' => 'Client updated.',
            ]);

        } catch (ValidatorException $e) {
            return response()->json([
                'message' => $e->getMessageBag()
            ]);
        }
    }


    /**
     * @OA\Delete(
     *     tags={"Clients"},
     *     path="/api/clients/{id}",
     *     operationId="getClientById",
     *     @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of client to return",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     summary="Delete a client",
     *     description="Delete a client",
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
            'message' => 'Client deleted.'
        ]);
    }

    /**
     * @OA\Get(
     *     tags={"Clients"},
     *     path="/api/clients/trashed",
     *     summary="List of trashed clients",
     *     description="Return a list of trashed clients",
     *     @OA\Response(response="200", description="An json"),
     *      security={
     *           {"apiKey": {}}
     *       }
     * )
     */
    public function trashed()
    {
        $this->repository->pushCriteria(new OnlyTrashedCriteria());
        $clients = $this->repository->paginate(10);

        return response()->json([
            'data' => $clients,
        ]);
    }


    /**
     * @OA\Put(
     *      tags={"Clients"},
     *      path="/api/clients/restore/{id}",
     *      summary="Restore a client",
     *      description="Restore a client",
     *      operationId="getCategoryById",
     *     @OA\Response(response="200", description="Store clients"),
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
                'data' => 'Client restored.'
            ]);
        } catch (ValidatorException $e) {
            return response()->json([
                'message' => $e->getMessageBag()
            ]);

        }
    }
}
