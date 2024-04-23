<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArtistMember;
use Carbon\Carbon;
use Hash;
use Image;
use ImageUploadHelper;
use FileUploadHelper;

class ArtistMemberController extends Controller
{   
    

    public static $moduleConfig = [
        "routes" => [
            "listRoute" => 'admin.artist_member.index',
            "fetchDataRoute" => 'admin.artist_member.fetch.data', 
            "createRoute" => 'admin.artist_member.create', 
            "storeRoute" => 'admin.artist_member.store', 
            "editRoute" => 'admin.artist_member.edit', 
            "updateRoute" => 'admin.artist_member.update', 
            "deleteRoute" => 'admin.artist_member.delete', 
        ],
        "moduleTitle" => 'Artist Member',
        "moduleName" => 'artist_member',
        "viewFolder" => 'artist_member',
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

    public function fetchData(Request $request, ArtistMember $artistMember)
    {
        
        $data               =   $request->all();

        $db_data            =   $artistMember->getList($data, ['frontendRole', 'poc']);

        $count              =   $artistMember->getListCount($data);

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


    public function show ($id, ArtistMember $artistMember){

        $row = ArtistMember::findOrFail($id);
        return view('admin.'.self::$moduleConfig['viewFolder'].'.show ')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    }

}
