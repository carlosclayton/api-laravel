<?php

namespace ApiVue\Http\Controllers\Auth;

use ApiVue\Http\Controllers\Controller;
use ApiVue\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Prettus\Validator\Exceptions\ValidatorException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';


    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param UserValidator $validator
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \ApiVue\Models\User
     */
    public function store(Request $request)
    {

        $user['name'] = $request->get('name');
        $user['email'] = $request->get('email');
        $user['password'] = bcrypt($request->get('password'));
        $user['role'] = 2;

        try {
            $u = $this->repository->updateOrCreate(
                ['email' => $request->get('email')],
                ['name' => $request->get('name'), 'password' => bcrypt($request->get('password')), 'role' => 2]
            );
            $credentials = $request->only('email', 'password');
            $token = \Auth::guard('api')->attempt($credentials);
            return response()->json([
                'token' => $token
            ]);


        } catch (ValidatorException $e) {
            return response()->json([
                'message' => $e->getMessageBag()
            ]);
        }
    }

}
