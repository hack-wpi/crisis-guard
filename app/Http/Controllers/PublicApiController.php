<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PublicApiController extends Controller
{
    public function __construct(){
       $this->middleware('auth:api');
    }

    public function flare(Request $request) {
        $this->validate($request, [
            'longitude' => 'numeric|required',
            'lat' => 'numeric|required',
            'user_token' => 'required',
            'type' => 'max:255',

        ]);

        $long = $request->input('longitude');
        $lat = $request->input('lat');
        $type = ($request->input('type'))? $request->input('type') : 'global';
        
        $userId = DB::table('oauth_access_tokens')->select('user_id')->where('id', $request->input('user_token'))->first();
        $write = DB::table('flares')->insert([
            ['user_id' => $userId, 'type' => $type, 'long' => $long, 'lat' => $lat]
        ]);

        if(!$write) {
            return response('', 400)
                  ->header('Content-Type', 'text/plain');
        } else {
            return response('', 200)
                  ->header('Content-Type', 'text/plain');
        }
    }
}
