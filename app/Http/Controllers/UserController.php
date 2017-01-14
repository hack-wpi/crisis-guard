<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function updateProfileImage(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $response = $http->post('http://your-app.com/oauth/token', [
            'form_params' => [
                'user_id' => Auth::id(),
                'image' => $request->file('image'),
            ],
        ]);

        return $responce;
    }
}
