<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;
use DB;

class PublicApiController extends Controller
{
    public function __construct(){
//       $this->middleware('auth:api');
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

    public function uploadProfilePicture(Request $request)
    {
        $rules = [
            'user_id' => 'numeric|required',
        ];
        $input = Input::all();
    
        $validation = Validator::make($input, $rules);
        if ($validation->fails()) {
            return Response::json(['msg' => 'Failed to Validate Image'], 400);
        }
        
        $file = array_get($input,'image');
        $destinationPath = 'images/users';
        $extension = $file->getClientOriginalExtension();
        $fileName = rand(11111, 99999) . '.' . $extension;
        $upload_success = $file->move($destinationPath, $fileName);
        
        if ($upload_success) {
            $oldPicture = DB::table('users')->select('picture')->where('id', $request->input('user_id'))->first();
            if($oldPicture->picture == 'default.png') {
                exec("python /home/ubuntu/http/current/userModel/user_add.py".$request->input('user_id')." /home/ubuntu/http/current/public/images/users/".$fileName." 2>&1", $output);
            }
            DB::table('users')->where('id', $request->input('user_id'))->update(['picture' => $fileName]);
            return Response::json(['msg' => 'Updated Profile Image'], 200);
        }
        return Response::json(['msg' => 'Failed to Update Image'], 400);
    }

    public function uploadTrainingPicture(Request $request)
    {
        $rules = [
            'user_id' => 'numeric|required',
        ];
        $input = Input::all();
    
        $validation = Validator::make($input, $rules);
        if ($validation->fails()) {
            return Response::json(['msg' => 'Failed to Validate Image'], 400);
        }
        
        $file = array_get($input,'image');
        //TODO MAKEDIR
        $destinationPath = '/home/ubuntu/http/current/usrimg/train/'.$request->input('user_id');
        $extension = $file->getClientOriginalExtension();
        $fileName = rand(11111, 99999) . '.' . $extension;
        $upload_success = $file->move($destinationPath, $fileName);
        
        if ($upload_success) {
            exec("python /home/ubuntu/http/current/userModel/user_train.py ".$request->input('user_id')." /home/ubuntu/http/current/usrimg/train/".$request->input('user_id')." 2>&1", $output);
            return Response::json(['msg' => 'Updated Profile Image'], 200);
        }
        return Response::json(['msg' => 'Failed to Upload Image'], 400);
    }

    public function uploadProductionPicture(Request $request)
    {
        $rules = [
            'user_id' => 'numeric|required',
        ];
        $input = Input::all();
    
        $validation = Validator::make($input, $rules);
        if ($validation->fails()) {
            return Response::json(['msg' => 'Failed to Validate Image'], 400);
        }
        $file = array_get($input,'image');
        $destinationPath = '/home/ubuntu/http/current/public/images/processing/';
        $finalDestination = '/home/ubuntu/http/current/usrimg/production/';
        $extension = $file->getClientOriginalExtension();
        $fileName = rand(11111, 99999) . '.' . $extension;
        $upload_success = $file->move($destinationPath, $fileName);

        if ($upload_success) {
            exec("python /home/ubuntu/http/current/userModel/predict.py http://hack.symerit.com/images/processing/".$fileName." 2>&1", $output);
            $destinationPath .= $fileName;
            exec("mv /home/ubuntu/http/current/public/images/processing/* ".$finalDestination);
            DB::table('production_clarefai')->insert(
                ['user_id' => $request->input('user_id'), 'json' => json_encode($output)]
            );
            return Response::json(['msg' => 'Processed Image'], 200);
        }
        return Response::json(['msg' => 'Failed to Upload Image'], 400);
    }

    public function getProductionJson(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'numeric|required'
        ]);

        $query = DB::table('production_clarefai')->select('json')->where('user_id', $request->input('user_id'))->orderBy('id', 'desc')->first();

        return Response::json(json_decode($query->json), 200);
    }
}
