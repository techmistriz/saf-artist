<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileMemberRequest;
use App\Models\ProfileMember;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Image;
use ImageUploadHelper;
use FileUploadHelper;

class ProfileMemberController extends Controller
{   
    

    public static $moduleConfig = [
        "routes" => [
            "listRoute" => 'admin.profile_member.index',
            "fetchDataRoute" => 'admin.profile_member.fetch.data', 
            "createRoute" => 'admin.profile_member.create', 
            "storeRoute" => 'admin.profile_member.store', 
            "editRoute" => 'admin.profile_member.edit', 
            "updateRoute" => 'admin.profile_member.update', 
            "deleteRoute" => 'admin.profile_member.delete', 
        ],
        "moduleTitle" => 'Profile Member',
        "moduleName" => 'profile_member',
        "viewFolder" => 'profile_member',
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

    public function fetchData(Request $request, ProfileMember $profileMember)
    {
        
        $data               =   $request->all();

        $db_data            =   $profileMember->getList($data, ['userProfile']);

        $count              =   $profileMember->getListCount($data);

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


    public function show ($id, ProfileMember $profileMember){

        $row = ProfileMember::findOrFail($id);
        return view('admin.'.self::$moduleConfig['viewFolder'].'.show ')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    }

}
