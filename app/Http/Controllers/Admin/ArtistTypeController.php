<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArtistType;
use Carbon\Carbon;
use App\Http\Requests\ArtistTypeRequest;
use Hash;
use Image;
use ImageUploadHelper;

class ArtistTypeController extends Controller
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
            "listRoute" => 'admin.artist_type.index',
            "fetchDataRoute" => 'admin.artist_type.fetch.data', 
            "createRoute" => 'admin.artist_type.create', 
            "storeRoute" => 'admin.artist_type.store', 
            "editRoute" => 'admin.artist_type.edit', 
            "updateRoute" => 'admin.artist_type.update', 
            "deleteRoute" => 'admin.artist_type.delete'
        ],
        "moduleTitle" => 'Artist Types',
        "moduleName" => 'artist_type',
        "viewFolder" => 'artist_type',
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

    public function fetchData(Request $request, ArtistType $artistType)
    {
        
        $data               =   $request->all();

        $db_data            =   $artistType->getList($data);

        $count 				=  	$artistType->getListCount($data);

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
    public function create(ArtistType $artistType){

        return view('admin.'.self::$moduleConfig['viewFolder'].'.create')->with('moduleConfig', self::$moduleConfig)->with('row', null);
    }

    /**
     * Create a new {{moduleTitle}}.
     *
     * @param  null
     * @return Redirect
     */
    public function store (ArtistTypeRequest $request){

        $artistType          = new ArtistType();
        $artistType->name        = $request->name;
        $artistType->status      = $request->input('status', 0);
        $artistType->save();

        \Flash::success(self::$moduleConfig['moduleTitle'].' created successfully');
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

    /**
     * Show show  form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    // public function show ($id, ArtistType $artistType){

    //     $row = ArtistType::findOrFail($id);
    //     return view('admin.'.self::$moduleConfig['viewFolder'].'.show ')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    // }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, ArtistType $artistType){

        $row = ArtistType::findOrFail($id);
        return view('admin.'.self::$moduleConfig['viewFolder'].'.edit')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(ArtistTypeRequest $request, $id){

        $artistType                  = ArtistType::findOrFail($id);
        $artistType->name                = $request->name;
        $artistType->status              = $request->input('status', 0);
        $artistType->save();

        \Flash::success(self::$moduleConfig['moduleTitle'].' updated successfully.');
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

    /**
     * Delete {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */

    // public function delete($id)
    // {
        
    //     $row = ArtistType::findOrFail($id);
    //     $row->delete();
    //     \Flash::success(self::$moduleConfig['moduleTitle'].' deleted successfully.'); 
    //     return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    // }

}
