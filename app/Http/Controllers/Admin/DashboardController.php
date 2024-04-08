<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Category;
use DB;

class DashboardController extends Controller
{
    

	/**
     * Constructor Method.
     *
     * Setting Authentication
     *
     */

    public function __construct()
    {
    	parent::__construct();
        $this->middleware('auth:admin');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	// dd(\Route::currentRouteName());
		// dd(session('rolePermission'));
		// $user    = \Auth::user();
        // \Mail::to($user->email)->send(new \App\Mail\RegisterMailable($user));

        return view('admin.dashboard');
    }
}
