<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Project;
use Carbon\Carbon;
use App\Http\Requests\ProjectRequest;
use Hash;
use Image;
use ImageUploadHelper;

class ProjectController extends Controller
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
            "listRoute" => 'admin.project.index',
            "fetchDataRoute" => 'admin.project.fetch.data', 
            "createRoute" => 'admin.project.create', 
            "storeRoute" => 'admin.project.store', 
            "editRoute" => 'admin.project.edit', 
            "updateRoute" => 'admin.project.update', 
            "deleteRoute" => 'admin.project.delete'
        ],
        "moduleTitle" => 'Project',
        "moduleName" => 'project',
        "viewFolder" => 'project',
        "imageUploadFolder" => 'uploads/projects/',
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

    public function fetchData(Request $request, Project $Project)
    {
        
        $data               =   $request->all();

        $db_data            =   $Project->getList($data, ['category']);

        $count 				=  	$Project->getListCount($data);

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
    public function create(Project $Project){

		$categories 	= Category::where('status', 1)->get();

        return view('admin.'.self::$moduleConfig['viewFolder'].'.create')->with('moduleConfig', self::$moduleConfig)->with('row', null)->with('categories', $categories)->with('years' , $this->years + ['2023' => '2023']);
    }

    /**
     * Create a new {{moduleTitle}}.
     *
     * @param  null
     * @return Redirect
     */
    public function store (ProjectRequest $request){

        $project          		= new Project();
        $project->name        	= $request->name;
        $project->year        	= $request->year;
        $project->category_id	= $request->category_id;
        $project->status      	= $request->input('status', 0);
        $project->save();

        \Flash::success(self::$moduleConfig['moduleTitle'].' created successfully');
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

    /**
     * Show show  form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id, Project $Project){

        $row = Project::findOrFail($id);
        return view('admin.'.self::$moduleConfig['viewFolder'].'.show ')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Project $Project){

    	$categories 	= Category::where('status', 1)->get();
        $row 			= Project::findOrFail($id);

        return view('admin.'.self::$moduleConfig['viewFolder'].'.edit')->with('moduleConfig', self::$moduleConfig)->with('row', $row)->with('categories', $categories)->with('years' , $this->years + ['2023' => '2023']);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(ProjectRequest $request, $id){

        $project                  	= Project::findOrFail($id);
        $project->name				= $request->name;
        $project->year        		= $request->year;
        $project->category_id		= $request->category_id;
        $project->status           	= $request->input('status', 0);
        $project->save();

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
        
        $row = Project::findOrFail($id);
        $row->delete();
        \Flash::success(self::$moduleConfig['moduleTitle'].' deleted successfully.'); 
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

}
