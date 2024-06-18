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

    public function index(Request $request)
    {
        $users       = User::where('status', 1)->whereNotIn('frontend_role_id', [8])->get();
        return view('admin.'.self::$moduleConfig['viewFolder'].'.index')->with('moduleConfig', self::$moduleConfig)->with('users', $users);
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

        $whereArr = [];
        if ($request->user_id) {
            $whereArr = ['user_id' => $request->user_id];
        }
        $db_data            =   $profileMember->getList($data, ['userProfile'], $whereArr);

        $count              =   $profileMember->getListCount($data, [], $whereArr);

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
        // dd($row);
        return view('admin.'.self::$moduleConfig['viewFolder'].'.show ')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, ProfileMember $member)
    {
        $row = ProfileMember::findOrFail($id);
        return view('admin.'.self::$moduleConfig['viewFolder'].'.edit ')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(ProfileMemberRequest $request, $id)
    {
        $member                  = ProfileMember::findOrFail($id);
        $member->user_id         = $request->user_id;
        $member->profile_id      = $request->profile_id;
        $member->name            = $request->name;
        $member->email           = $request->email;
        $member->contact         = $request->contact;
        $member->dob             = $request->dob;
        $member->room_sharing    = $request->room_sharing;
        $member->stage_name      = $request->stage_name;
        $member->artist_bio      = $request->artist_bio;
        $member->instagram_url   = $request->instagram_url;
        $member->facebook_url    = $request->facebook_url;
        $member->linkdin_url     = $request->linkdin_url;
        $member->twitter_url     = $request->twitter_url;
        $member->website         = $request->website;
        $member->status          = $request->input('status', 0);
        $member->save();

        \Flash::success('Profile member updated successfully.');
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
        
        $row = ProfileMember::findOrFail($id);
        $row->delete();
        \Flash::success('Profile member deleted successfully.'); 
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }    

}
