<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserCategoryDetail;
use App\Models\UserAccountDetail;
use App\Models\Category;
use App\Models\AddressProof;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use DB;
use Carbon\Carbon;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserCategoryDetailsRequest;
use App\Http\Requests\UserAccountDetailsRequest;
use Hash;
use Image;
use ImageUploadHelper;
use FileUploadHelper;
use App\Traits\UserTrait;

class FrontendController extends Controller
{
	use UserTrait;
	
	public static $moduleConfig = [
        "imageUploadFolder" => 'uploads/users/',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	$user_id		= \Auth::user()->id;
		$categories 	= Category::where('status', 1)->get();
    	$addressProofs 	= AddressProof::where('status', 1)->get();
    	$countries 		= Country::where('status', 1)->get();
    	$row 			= User::findOrFail($user_id);

        return view('frontend.dashboard')->with('row', $row)->with('categories', $categories)->with('addressProofs', $addressProofs)->with('years', $this->years)->with('countries', $countries);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function updateProfile(UserRequest $request) {

	 	$this->__updateProfile($request);

    	\Flash::success('Your personal details updated successfully.');
        return \Redirect::route('dashboard');
    }

    public function editCategoryDetails()
    {
        $user			= \Auth::user();
        $user_id		= $user->id;
        $row			= UserCategoryDetail::where('user_id', $user_id)->first();

    	if(empty($row)){
    		UserCategoryDetail::create(['user_id' => $user_id]);
    		$row		= UserCategoryDetail::where('user_id', $user_id)->first();
    	}

    	$viewFile = $this->categoryFormResolver();
    	
        return view($viewFile)->with('row', $row);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function updateCategoryDetails(UserCategoryDetailsRequest $request){

    	// $this->__updateCategoryDetails($request);
    	$func = $this->categoryFunctionResolver();
    	$this->{$func}($request);

    	\Flash::success('Your category details updated successfully.');
        return \Redirect::route('edit.category.details');
    }

    public function editAccountDetails()
    {
        $user_id 			= \Auth::user()->id;
        $row				= UserAccountDetail::where('user_id', $user_id)->first();
    	if(empty($row)) {
    		UserAccountDetail::create(['user_id' => $user_id]);
    		$row			= UserAccountDetail::where('user_id', $user_id)->first();
    	}

        return view('frontend.account_details.edit')->with('row', $row);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function updateAccountDetails(UserAccountDetailsRequest $request){

    	$this->__updateAccountDetails($request);

    	\Flash::success('Your account details updated successfully.');
        return \Redirect::route('edit.account.details');
    }

    public function terms()
    {
        return view('includes.common.terms_conditions');
    }
}
