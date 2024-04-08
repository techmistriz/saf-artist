<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\Role;
use Carbon\Carbon;
use App\Http\Requests\ContactUsRequest;
use Hash;
use Image;
use ImageUploadHelper;

class ContactusController extends Controller
{	
	/*
    |--------------------------------------------------------------------------
    | {{moduleTitle}} Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles create, update, delete and show list of {{moduleTitle}}.
    |
    */

    public static $moduleConfig = [
        "routes" => [
            "listRoute" => 'admin.contact_us.index',
            "fetchDataRoute" => 'admin.contact_us.fetch.data', 
            "createRoute" => 'admin.contact_us.create', 
            "storeRoute" => 'admin.contact_us.store', 
            "editRoute" => 'admin.contact_us.edit', 
            "updateRoute" => 'admin.contact_us.update', 
            "deleteRoute" => 'admin.contact_us.delete'
        ],
        "moduleTitle" => 'Contact Us',
        "moduleName" => 'contact_us',
        "viewFolder" => 'contact_us',
        "imageUploadFolder" => 'uploads/contact_us/',
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

    	return view('admin.'.self::$moduleConfig['viewFolder'].'.index')->with('moduleConfig', self::$moduleConfig);
    }

    /**
     * Fetch data for datatable via ajax request for {{moduleTitle}}.
     *
     * @param  null
     * @return \Illuminate\Http\Response
     */

    public function fetchData(Request $request, ContactUs $ContactUs)
	{
		
		$data               =   $request->all();

        $db_data            =   $ContactUs->getList($data);

        $count 				=  	$ContactUs->getListCount($data);

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
    public function create(Admin $Admin){
    	
    	$roles = Role::where('status', 1)->where('type', 1)->get();

    	return view('admin.'.self::$moduleConfig['viewFolder'].'.create')->with('moduleConfig', self::$moduleConfig)->with('row', null)->with('roles', $roles);
    }

    /**
     * Create a new {{moduleTitle}}.
     *
     * @param  null
     * @return Redirect
     */
    public function store (ContactUsRequest $request){

    	$admin = new Admin();
    	$admin->name 				= $request->name;
    	$admin->email 				= $request->email;
    	$admin->role_id				= $request->role_id;
    	$admin->password			= Hash::make($request->password);
    	$admin->save();

    	\Flash::success(self::$moduleConfig['moduleTitle'].' created successfully');
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

	/**
     * Show show  form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id, ContactUs $ContactUs){

    	$row = ContactUs::findOrFail($id);
    	return view('admin.'.self::$moduleConfig['viewFolder'].'.show ')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    }

	/**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, ContactUs $ContactUs){

    	$roles = Role::where('status', 1)->where('type', 1)->get();
    	$row = ContactUs::findOrFail($id);
    	return view('admin.'.self::$moduleConfig['viewFolder'].'.edit')->with('moduleConfig', self::$moduleConfig)->with('row', $row)->with('roles', $roles);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(ContactUsRequest $request, $id){

    	$user 						= ContactUs::findOrFail($id);
    	$user->name 				= $request->name;
    	$user->email 				= $request->email;
    	$user->role_id				= $request->role_id;
    	if($request->has('password') && $request->has('password'))
    	{
	    	$user->password = Hash::make($request->password);
	    }
    	$user->save();

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
    	
    	$row = ContactUs::findOrFail($id);
    	$row->delete();
    	\Flash::success(self::$moduleConfig['moduleTitle'].' deleted successfully.'); 
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

}
