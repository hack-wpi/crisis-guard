<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class PageController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.index');
    }

    public function profile()
    {
        $query = DB::table('users')->select('name', 'picture', 'email', 'roles')->where('id', Auth::id())->first();
        return view('pages.profile', ['name'=>$query->name, 'picture'=>$query->picture, 'email'=>$query->email, 'roles'=>$query->roles]);
    }

    public function map()
    {
        return view('pages.map');
    }

}
