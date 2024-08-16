<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
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
        $users = User::where('status', 1)->get();
        $admins = Admin::where('status', 1)->get();
        // dd($roles);
        return view('admin.dashboard')->with('users', $users)->with('admins', $admins);
    }
}
