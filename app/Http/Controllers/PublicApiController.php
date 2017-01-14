<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;

class PublicApiController extends Controller
{
    public function __construct(){
       $this->middleware('auth:api');
    }

    public function sendFlare(Request $request) {
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

        DB::table('flares')->where('user_id', $userId)->update(['cleared_on' => date("Y-m-d H:i:s")]);

        $write = DB::table('flares')->insert([
            ['user_id' => $userId, 'type' => $type, 'long' => $long, 'lat' => $lat]
        ]);

        if(!$write) {
            return Response::json(['msg' => 'Failed to write to DB'], 400);
        } else {
            return Response::json(['msg' => 'Success :)'], 200);
        }
    }

    public function getFlares(Request $request) {
        return "Hello World";
    }

    public function getUserId(Request $request) {
        $this->validate($request, [
            'email' => 'email|required'
        ]);

        $userId = DB::table('users')->select('id')->where('email', $request->input('email'))->first();

        if(!$userId) {
            return Response::json(['msg' => 'Failed to get user id'], 400);
        } else {
            return Response::json($userId, 200);
        }
    }

    public function nearByProfile(Request $request) {
        $this->validate($request, [
            'email' => 'email|required'
        ]);

        $profile = DB::table('users')->select('name', 'picture')->where('email', $request->input('email'))->first();
        
        if (!$profile) {
            return Response::json(['msg' => 'Failed to get user profile'], 400);
        } else {
            return Response::json(['picture' => $profile->picture, 'name' => $profile->name], 200);
        }
    }

    public function uploadProfilePicture(Request $request) {
        $this->validate($request, [
            'user_id' => 'numeric|required',
        ]);

        $name=str_random(30) . '-' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move('image/users',$name);

        DB::table('users')->where('id', $request->input('user_id'))->update(['picture' => $name]);

        return Response::json([['msg' => 'success'], 200);
    }
}
