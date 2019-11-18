<?php

namespace ApiVue\Listeners;

use Dingo\Api\Event\ResponseWasMorphed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Tymon\JWTAuth\JWT;

class addTokenToHeaderListener
{
    private $jwt;
    public function __construct(JWT $jwt)
    {
        $this->jwt = $jwt;
    }

    public function handle(ResponseWasMorphed $event)
    {
        $token = $this->jwt->getToken();
        if($token){
            $event->response->headers->set('Authorization', "Bearer {$token->get()}");
        }
    }

}
