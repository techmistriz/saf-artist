<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use App\Models\AddressProof;
use App\Models\UserCategoryDetail;
use App\Models\UserAccountDetail;
use App\Models\Country;
use App\Models\State;
use App\Models\MetroCity as City;
use App\Models\TravelBoarding;
use App\Models\TravelMode;
use App\Models\Project;
use Carbon\Carbon;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserCategoryDetailsRequest;
use App\Http\Requests\UserAccountDetailsRequest;
use Hash;
use Image;
use ImageUploadHelper;
use FileUploadHelper;
use App\Traits\TravelBoardingTrait;
use App\Traits\UserTrait;

class TravelBoardingController extends Controller
{	
	/*
    |--------------------------------------------------------------------------
    | {{moduleTitle}} Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles create, update, delete and show list of {{moduleTitle}}.
    |
    */

    use UserTrait;
    use TravelBoardingTrait;

    public static $moduleConfig = [
        "routes" => [
            "listRoute" => 'admin.travel_boarding.index',
            "fetchDataRoute" => 'admin.travel_boarding.fetch.data', 
            "createRoute" => 'admin.travel_boarding.create', 
            "storeRoute" => 'admin.travel_boarding.store', 
            "editRoute" => 'admin.travel_boarding.edit', 
            "updateRoute" => 'admin.travel_boarding.update', 
            "deleteRoute" => 'admin.travel_boarding.delete',
            "editCategoryDetailsRoute" => 'admin.travel_boarding.edit.category.details', 
            "updateCategoryDetailsRoute" => 'admin.travel_boarding.update.category.details', 
            "editAccountDetailsRoute" => 'admin.travel_boarding.edit.account.details', 
            "updateAccountDetailsRoute" => 'admin.travel_boarding.update.account.details', 
        ],
        "moduleTitle" => 'Travel, Boarding & Lodging',
        "moduleName" => 'travel_boarding',
        "viewFolder" => 'travel_boarding',
        "viewCategoryDetailsFolder" => 'travel_boarding.category_details',
        "viewAccountDetailsFolder" => 'travel_boarding.account_details',
        "imageUploadFolder" => 'uploads/users/',
    ];

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
     * Show list of {{moduleTitle}}.
     *
     * @param  null
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){

    	// dd(User::with('travelBoarding')->find(\Auth::id()));

    	return view('admin.'.self::$moduleConfig['viewFolder'].'.index')->with('moduleConfig', self::$moduleConfig);
    }

    /**
     * Fetch data for datatable via ajax request for {{moduleTitle}}.
     *
     * @param  null
     * @return \Illuminate\Http\Response
     */

    public function fetchData(Request $request, User $User)
	{
		
		$data               =   $request->all();

        $db_data            =   $User->getList($data, ['category', 'travelBoarding']);

        $count 				=  	$User->getListCount($data);

        $returnArray = array(
            'data' => $db_data,
            'meta' => array(
                'page'          =>      $data['pagination']['page'] ?? 1, 
                'pages'         =>      $data['pagination']['pages'] ?? 1, 
                'perpage'       =>      $data['pagination']['perpage'] ?? 10, 
                'total'         =>      $count, 
                'sort'          =>      $data['sort']['sort'] ?? 'asc', 
                'field'         =>      $data['sort']['field'] ?? '_id', 
            ),
        );

        return $returnArray;
	}

    /**
     * Show create form of {{moduleTitle}}.
     *
     * @param  null
     * @return \Illuminate\Http\Response
     */
    public function create(User $User){
    	
    	$countries 			= Country::where('status', 1)->get();
    	$travelModes		= TravelMode::where('status', 1)->get();
    	$cities 			= City::select('id', 'city_name')->where('status', 1)->get();

    	return view('admin.'.self::$moduleConfig['viewFolder'].'.create')->with('moduleConfig', self::$moduleConfig)->with('row', null)->with('travelModes', $travelModes)->with('countries', $countries)->with('cities', $cities);
    }

    /**
     * Create a new {{moduleTitle}}.
     *
     * @param  null
     * @return Redirect
     */
    public function store (UserRequest $request){

    	\Flash::success(self::$moduleConfig['moduleTitle'].' created successfully');
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

	/**
     * Show show  form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id, User $User){

    	$row = User::with('travelBoarding')->find($id);
    	return view('admin.'.self::$moduleConfig['viewFolder'].'.show ')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    }

	/**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, User $User){

    	$countries 		= Country::where('status', 1)->get();
    	$cities 		= City::where('status', 1)->get();
    	$travelModes	= TravelMode::where('status', 1)->get();
    	$row 			= User::with('travelBoarding')->findOrFail($id);
    	$projects 		= Project::where('status', 1)->where('year', date('Y'))->get();

    	// dd($row->travelBoarding);

    	return view('admin.'.self::$moduleConfig['viewFolder'].'.edit')->with('moduleConfig', self::$moduleConfig)->with('row', $row)->with('countries', $countries)->with('travelModes', $travelModes)->with('cities', $cities)->with('projects', $projects);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(Request $request, $id){

    	// dd($request->all());

    	$this->__updateTravelBoarding($request, $id);

    	\Flash::success(self::$moduleConfig['moduleTitle'].' updated successfully.');
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

    /**
     * Delete {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */

    public function delete($id)
    {
    	
    	\Flash::success(self::$moduleConfig['moduleTitle'].' can\'t be deleted.'); 
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }


	/**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function editCategoryDetails($user_id, User $User){

    	$user 					= User::findOrFail($user_id);
    	$row 					= UserCategoryDetail::where('user_id', $user_id)->first();

    	if(empty($row)){
    		UserCategoryDetail::create(['user_id' => $user_id]);
    		$row 					= UserCategoryDetail::where('user_id', $user_id)->first();
    	}
    	
    	$catViewFile = $this->categoryAdminFormResolver($user->category_id);

    	return view('admin.'.self::$moduleConfig['viewCategoryDetailsFolder'].'.edit')->with('moduleConfig', self::$moduleConfig)->with('row', $row)->with('catViewFile', $catViewFile);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function updateCategoryDetails(UserCategoryDetailsRequest $request, $user_id){

    	// dd($request->all());

    	// $this->__updateCategoryDetails($request);
    	$user 					= User::findOrFail($user_id);
    	$func = $this->categoryFunctionResolver($user->category_id);
    	$this->{$func}($request, $user_id);

    	\Flash::success(self::$moduleConfig['moduleTitle'].' category details updated successfully.');
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

	/**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function showCategoryDetails($user_id, User $User){

    	$row			= UserCategoryDetail::where('user_id', $user_id)->first();

    	if(empty($row)){
    		UserCategoryDetail::create(['user_id' => $user_id]);
    		$row		= UserCategoryDetail::where('user_id', $user_id)->first();
    	}
    	
    	$user			= User::findOrFail($user_id);
    	$catViewFile 	= $this->categoryAdminFormResolver($user->category_id);

    	return view('admin.'.self::$moduleConfig['viewCategoryDetailsFolder'].'.show.' . $catViewFile . '.show')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function editAccountDetails($user_id, User $User){

    	$row 					= UserAccountDetail::where('user_id', $user_id)->first();

    	if(empty($row)) {
    		UserAccountDetail::create(['user_id' => $user_id]);
    		$row 					= UserAccountDetail::where('user_id', $user_id)->first();
    	}
    	
    	// dd($row);
    	
    	return view('admin.'.self::$moduleConfig['viewAccountDetailsFolder'].'.edit')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function updateAccountDetails(UserAccountDetailsRequest $request, $user_id){

    	$this->__updateAccountDetails($request, $user_id);

    	\Flash::success(self::$moduleConfig['moduleTitle'].' account details updated successfully.');
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }


    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function showAccountDetails($user_id, User $User){

    	$row 					= UserAccountDetail::where('user_id', $user_id)->first();

    	if(empty($row)) {
    		UserAccountDetail::create(['user_id' => $user_id]);
    		$row 					= UserAccountDetail::where('user_id', $user_id)->first();
    	}
    	
    	return view('admin.'.self::$moduleConfig['viewAccountDetailsFolder'].'.show')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    }

}
