<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportReport;

class ReportController extends Controller
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
            "createRoute" => 'admin.report.create', 
            "exportRoute" => 'admin.report.export'
        ],
        "moduleTitle" => 'Reports',
        "moduleName" => 'report',
        "viewFolder" => 'report',
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
     * Show create form of {{moduleTitle}}.
     *
     * @param  null
     * @return \Illuminate\Http\Response
     */
    public function create(){

        return view('admin.'.self::$moduleConfig['viewFolder'].'.create')->with('moduleConfig', self::$moduleConfig);
    }
    
    public function export(Request $request)
    {
        $requestPayload = $request->except('_token', 'submit');
        return Excel::download(new ExportReport($requestPayload), 'report.xlsx');
    }

}
