<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;

class MeController extends Controller
{

    public function me(Request $request){

        $user = JWTAuth::toUser($request->token);

        return response()->json(
            [
                'result' => [
                    'user' => $user
                ]
            ]
        );
    }

}
