<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pincode;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Carbon\Carbon;
use App\Http\Requests\PincodeRequest;
use Hash;
use Image;
use ImageUploadHelper;
use Auth;

class PincodeController extends Controller
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
            "listRoute" => 'admin.pincode.index',
            "fetchDataRoute" => 'admin.pincode.fetch.data', 
            "createRoute" => 'admin.pincode.create', 
            "storeRoute" => 'admin.pincode.store', 
            "editRoute" => 'admin.pincode.edit', 
            "updateRoute" => 'admin.pincode.update', 
            "deleteRoute" => 'admin.pincode.delete'
        ],
        "moduleTitle" => 'Pincode',
        "moduleName" => 'pincode',
        "viewFolder" => 'pincode',
        //"imageUploadFolder" => 'uploads/curators/',
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

    public function fetchData(Request $request, Pincode $pincode)
    {
        $data               =   $request->all();

        $db_data            =   $pincode->getList($data, ['country', 'state', 'city']);

        $count              =   $pincode->getListCount($data);

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
    public function create(Pincode $pincode){
        $countries = Country::where('status', 1)->get();
        return view('admin.'.self::$moduleConfig['viewFolder'].'.create')->with('moduleConfig', self::$moduleConfig)->with('row', null)->with('countries', $countries);
    }

    /**
     * Create a new {{moduleTitle}}.
     *
     * @param  null
     * @return Redirect
     */
    public function store (PincodeRequest $request){

        $pincode                      = new Pincode();
        $pincode->pincode             = $request->pincode;
        $pincode->country_id          = $request->country_id;
        $pincode->state_id            = $request->state_id;
        $pincode->city_id             = $request->city_id;
        $pincode->status              = $request->input('status', 0);
        $pincode->created_by          = Auth::user()->id;
        $pincode->save();

        \Flash::success(self::$moduleConfig['moduleTitle'].' created successfully');
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

    /**
     * Show show  form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id, Pincode $pincode){

        $row = Pincode::findOrFail($id);
        return view('admin.'.self::$moduleConfig['viewFolder'].'.show ')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Pincode $pincode){
        
        $countries = Country::where('status', 1)->get();
        $row = Pincode::findOrFail($id);
        return view('admin.'.self::$moduleConfig['viewFolder'].'.edit')->with('moduleConfig', self::$moduleConfig)->with('row', $row)->with('countries', $countries);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(PincodeRequest $request, $id){

        $pincode                      = Pincode::findOrFail($id);
        $pincode->pincode             = $request->pincode;
        $pincode->country_id          = $request->country_id;
        $pincode->state_id            = $request->state_id;
        $pincode->city_id             = $request->city_id;
        $pincode->status              = $request->input('status', 0);
        $pincode->updated_by          = Auth::user()->id;
        $pincode->save();

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
        
        $row = Pincode::findOrFail($id);
        $row->delete();
        \Flash::success(self::$moduleConfig['moduleTitle'].' deleted successfully.'); 
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

}
