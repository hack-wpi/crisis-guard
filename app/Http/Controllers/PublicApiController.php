<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;

class PublicApiController extends Controller
{
    public function __construct(){
//       $this->middleware('auth:api');
    }

    public function flare(Request $request) {
        $this->validate($request, [
            'longitude' => 'numeric|required',
            'lat' => 'numeric|required',
            'user_id' => 'numeric|required',
            'type' => 'max:255',
        ]);

        $long = $request->input('longitude');
        $lat = $request->input('lat');
        $type = ($request->input('type'))? $request->input('type') : 'global';

        $userId = $request->input('user_id');

        $write = DB::table('flares')->insert([
            ['user_id' => $userId, 'type' => $type, 'long' => $long, 'lat' => $lat]
        ]);

        if(!$write) {
            return Response::json(['msg' => 'Failed to write to DB'], 400);
        } else {
            return Response::json(['msg' => 'Success :)'], 200);
        }
    }

    public function getUserId(Request $request) {
        $this->validate($request, [
            'email' => 'max:255|required'
        ]);

        $userId = DB::table('users')->select('id')->where('email', $request->input('email'))->first();

        if(!$userId) {
            return Response::json(['msg' => 'Failed to get user id'], 400);
        } else {
            return Response::json($userId, 200);
        }
    }
}
