<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function updateProfilePicture(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $response = $http->post('http://hack.symerit.com/api/uploadProfilePicture', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$request->cookie('access_token'),
            ],
            'form_params' => [
                'user_id' => Auth::id(),
                'image' => $request->file('image'),
            ],
        ]);

        return $responce;
    }
}
