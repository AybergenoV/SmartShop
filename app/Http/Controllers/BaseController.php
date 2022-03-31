<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public static function response(bool $successful = false, string $message = 'text', array $payload = [], int $code = 200){
        return response([
            'successful'=>$successful,
            'code'=>$code,
            'message'=>$message,
            'payload'=>$payload
        ], $code);
    }
}
