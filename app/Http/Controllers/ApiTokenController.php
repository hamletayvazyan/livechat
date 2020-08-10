<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiTokenController extends Controller
{
    public static function getApiToken(Request $request) {
        return $request->user()->api_token;
    }
    public static function generateAndFill(Request $request){
        $str = Str::random(80);
        $token = hash('sha256', $str.'/'.$request->user()->email);

        $request->user()->forceFill([
            'api_token' => $token,
        ])->save();

        return $token;
    }

    /**
     * Generating unique token
     *
     * @param string $email
     *
     * @return string
     */
    public static function generate(string $email){
        $str = Str::random(80);
        return hash('sha256', $str.'/'.$email);
    }
    public function remove(Request $request)
    {
        $request->user()->forceFill([
            'api_token' => null,
        ])->save();
        return ['message' => 'logged out'];
    }
}
