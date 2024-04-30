<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curator;
use Carbon\Carbon;
use App\Http\Requests\CuratorRequest;
use Hash;
use Image;
use ImageUploadHelper;

class CuratorController extends Controller
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
            "listRoute" => 'admin.curator.index',
            "fetchDataRoute" => 'admin.curator.fetch.data', 
            "createRoute" => 'admin.curator.create', 
            "storeRoute" => 'admin.curator.store', 
            "editRoute" => 'admin.curator.edit', 
            "updateRoute" => 'admin.curator.update', 
            "deleteRoute" => 'admin.curator.delete'
        ],
        "moduleTitle" => 'Curators',
        "moduleName" => 'curator',
        "viewFolder" => 'curator',
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

    public function fetchData(Request $request, Curator $curator)
    {
        
        $data               =   $request->all();

        $db_data            =   $curator->getList($data);

        $count 				=  	$curator->getListCount($data);

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
    public function create(Curator $curator){

        return view('admin.'.self::$moduleConfig['viewFolder'].'.create')->with('moduleConfig', self::$moduleConfig)->with('row', null);
    }

    /**
     * Create a new {{moduleTitle}}.
     *
     * @param  null
     * @return Redirect
     */
    public function store (CuratorRequest $request){

        $curator          = new Curator();
        $curator->name        = $request->name;
        $curator->status      = $request->input('status', 0);
        $curator->save();

        \Flash::success(self::$moduleConfig['moduleTitle'].' created successfully');
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

    /**
     * Show show  form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    // public function show ($id, Curator $curator){

    //     $row = Curator::findOrFail($id);
    //     return view('admin.'.self::$moduleConfig['viewFolder'].'.show ')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    // }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Curator $curator){

        $row = Curator::findOrFail($id);
        return view('admin.'.self::$moduleConfig['viewFolder'].'.edit')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(CuratorRequest $request, $id){

        $curator                  = Curator::findOrFail($id);
        $curator->name                = $request->name;
        $curator->status              = $request->input('status', 0);
        $curator->save();

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
        
    //     $row = Curator::findOrFail($id);
    //     $row->delete();
    //     \Flash::success(self::$moduleConfig['moduleTitle'].' deleted successfully.'); 
    //     return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    // }

}
