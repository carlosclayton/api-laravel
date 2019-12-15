<?php

namespace ApiVue\Http\Controllers;

use ApiVue\Criteria\OnlyTrashedCriteria;
use ApiVue\Http\Requests\PasswordUpdateRequest;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;
use ApiVue\Http\Requests\UserCreateRequest;
use ApiVue\Http\Requests\UserUpdateRequest;
use ApiVue\Repositories\UserRepository;
use ApiVue\Validators\UserValidator;

/**
 * Class UsersController.
 *
 * @package namespace ApiVue\Http\Controllers;
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param UserValidator $validator
     */
    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @OA\Get(
     *     tags={"Users"},
     *     path="/api/users",
     *     summary="List of users",
     *     description="Return a list of users",
     *     @OA\Response(response="200", description="An json"),
     *      security={
     *           {"apiKey": {}}
     *       }
     * )
     */
    public function index(Request $request)
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $users = $this->repository->paginate($request->get('limit', 10), $request->get('page', 1));

        return response()->json([
            'data' => $users,
        ]);
    }

    /**
     * @OA\Post(
     *      tags={"Users"},
     *      path="/api/users",
     *      summary="Store a user",
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
     *          name="email",
     *          description="Email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="role",
     *          description="Role",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="Password",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *              format="password"
     *          )
     *      ),
     *     @OA\Response(response="200", description="Store categories"),
     *      security={
     *           {"apiKey": {}}
     *      }
     * )
     */
    public function store(UserCreateRequest $request)
    {
        $user['name'] = $request->get('name');
        $user['email'] = $request->get('email');
        $user['role'] = $request->get('role');
        $user['password'] = bcrypt($request->get('password'));

        try {
            $this->repository->create($user);
            return response()->json([
                'message' => 'User created.'
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
     *     tags={"Users"},
     *     path="/api/users/{id}",
     *     operationId="getUserById",
     *     @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of category to return",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     summary="Show a user",
     *     description="Return a user",
     *     @OA\Response(response="200", description="An json"),
     *     security={
     *           {"apiKey": {}}
     *     }
     * )
     */
    public function show($id)
    {
        $user = $this->repository->find($id);
        return response()->json([
            'data' => $user,
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
        $user = $this->repository->find($id);

        return view('users.edit', compact('user'));
    }

    /**
     * @OA\Put(
     *     tags={"Users"},
     *     path="/api/users/{id}",
     *     operationId="getUserById",
     *     summary="Update a user",
     *     description="Return message",
     *     @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of category to return",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
     *          name="email",
     *          description="Email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="role",
     *          description="Role",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="Password",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *              format="password"
     *          )
     *      ),
     *     @OA\Response(response="200", description="Update user"),
     *      security={
     *           {"apiKey": {}}
     *      }
     * )
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user['name'] = $request->get('name');
        $user['email'] = $request->get('email');
        $user['role'] = $request->get('role');
        $user['password'] = bcrypt($request->get('password'));

        try {
            //$this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $this->repository->update($user, $id);

            return response()->json([
                'data' => 'User updated.'
            ]);

        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }


    /**
     * @OA\Delete(
     *     tags={"Users"},
     *     path="/api/users/{id}",
     *     operationId="getUserById",
     *     @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of user",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     summary="Delete a user",
     *     description="Delete a user",
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
            'message' => 'User deleted.',
        ]);
    }

    /**
     * @OA\Get(
     *     tags={"Users"},
     *     path="/api/users/trashed",
     *     summary="List of trashed users",
     *     description="Return a list of users",
     *     @OA\Response(response="200", description="An json"),
     *      security={
     *           {"apiKey": {}}
     *       }
     * )
     */
    public function trashed()
    {
        $this->repository->pushCriteria(new OnlyTrashedCriteria());
        $users = $this->repository->paginate(10);

        return response()->json([
            'data' => $users,
        ]);
    }

    /**
     * @OA\Put(
     *      tags={"Users"},
     *      path="/api/users/restore/{id}",
     *      summary="Restore a user",
     *      description="Restore a user",
     *      operationId="getCategoryById",
     *     @OA\Response(response="200", description="Restore a user"),
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
                'data' => 'User restored.'
            ]);
        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ]);

        }
    }

    public function password(PasswordUpdateRequest $request)
    {
        $data['password'] = bcrypt($request->get('password'));
        try {
            $this->repository->update($data,$request->user('api')->id);
            return response()->json([
                'data' => 'Password updated.'
            ]);
        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ]);

        }
    }
}
