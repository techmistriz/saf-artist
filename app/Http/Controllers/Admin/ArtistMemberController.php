<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArtistMember;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Image;
use ImageUploadHelper;
use FileUploadHelper;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportArtistMember;

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

        $disciplines = \Auth::user()->getUserDisciplines();
        $individuals       = User::where('status', 1)->where('frontend_role_id', 8)->get();
        return view('admin.'.self::$moduleConfig['viewFolder'].'.index')->with('moduleConfig', self::$moduleConfig)->with('disciplines', $disciplines)->with('individuals', $individuals);
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

        $db_data            =   $artistMember->getList($data, ['frontendRole', 'poc'],['poc_id'=> NULL]);

        $count              =   $artistMember->getListCount($data,[],['poc_id'=> NULL]);

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

    public function export(Request $request)
    {
        $category_ids = $request->input('category_ids');
        $individual_ids = $request->input('individual_ids');

        return Excel::download(new ExportArtistMember($category_ids, $individual_ids), 'artist_member.xlsx');
    }

}
