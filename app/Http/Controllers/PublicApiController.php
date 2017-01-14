<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicApiController extends Controller
{
   public function __construct(){
      $this->middleware('auth:api');
   }

    public function flare() {
        return "false";
    }
}
