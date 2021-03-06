<?php

namespace ApiVue\Http\Controllers\Auth;

use ApiVue\Http\Controllers\Controller;
use HttpException;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @OA\Post(
     *      tags={"Autentication"},
     *      path="/api/forgot",
     *      summary="Forgot password",
     *      description="Receive an email to change password",
     *      @OA\Parameter(
     *          name="email",
     *          description="Email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       )
     * )
     */

    public function sendResetLinkEmail(Request $request)
    {

        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        try {
            $response = $this->broker()->sendResetLink(
                $this->credentials($request)
            );
        }catch (\Exception $ex){
            throw new \Exception( $ex->getMessage(), $ex->getCode());
        }


        if($response == Password::RESET_LINK_SENT){

            return response()->json([
                'message' => 'Email sended with successfully'
            ]);
        }else{
            throw new \Exception( 'Error to send email', 500);
        }

    }

}
