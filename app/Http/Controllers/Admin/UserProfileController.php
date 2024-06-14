<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Curator;
use App\Models\ArtistType;
use App\Models\UserProfile;
use App\Models\User;
use App\Models\ProfileMember;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Project;
use App\Models\Role;
use App\Http\Requests\UserProfileRequest;
use Carbon\Carbon;
use DB;
use Hash;
use Image;
use Auth;
use ImageUploadHelper;
use FileUploadHelper;
use App\Traits\UserTrait;

class UserProfileController extends Controller
{
    use UserTrait;
    
    public static $moduleConfig = [
        "routes" => [
            "listRoute" => 'admin.user_profile.index',
            "fetchDataRoute" => 'admin.user_profile.fetch.data', 
            "createRoute" => 'admin.user_profile.create', 
            "storeRoute" => 'admin.user_profile.store', 
            "editRoute" => 'admin.user_profile.edit', 
            "updateRoute" => 'admin.user_profile.update', 
            "deleteRoute" => 'admin.user_profile.delete',
        ],
        "moduleTitle" => 'User Profiles',
        "moduleName" => 'user_profile',
        "viewFolder" => 'user_profile',
        "imageUploadFolder" => 'uploads/users/',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $users       = User::where('status', 1)->get();
        return view('admin.'.self::$moduleConfig['viewFolder'].'.index')->with('moduleConfig', self::$moduleConfig)->with('users', $users);
    }

    public function fetchData(Request $request, UserProfile $user_profile)
    {
        $data     = $request->all();
        
        $whereArr = [];
        if ($request->user_id) {
            $whereArr = ['user_id' => $request->user_id];
        }
        $db_data  = $user_profile->getList($data, ['project', 'festival', 'user'], $whereArr);

        $count    = $user_profile->getListCount($data, [], $whereArr);

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
     * Show show  form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = UserProfile::findOrFail($id);
        $members = ProfileMember::where('status', 1)->where('profile_id', $row->id)->paginate(10);

        return view('admin.'.self::$moduleConfig['viewFolder'].'.show ')->with('moduleConfig', self::$moduleConfig)->with('row', $row)->with('members', $members);
    }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $row            = UserProfile::findOrFail($id);
        $countries      = Country::where('status', 1)->get();
        $artistTypes    = ArtistType::where('status', 1)->get();
        $categories     = Category::where('status', 1)->get();
        $curators       = Curator::where('status', 1)->get();
        $roles          = Role::where('status', 1)->where('type', 2)->get();
        // dd($roles);
        return view('admin.'.self::$moduleConfig['viewFolder'].'.edit')
        ->with('moduleConfig', self::$moduleConfig)
        ->with('row', $row)
        ->with('years', $this->years)
        ->with('countries', $countries)
        ->with('roles', $roles)
        ->with('artistTypes', $artistTypes)
        ->with('categories', $categories)
        ->with('curators', $curators);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(UserProfileRequest $request, $id){
        
        $this->__updateUserProfile($request, $id);

        \Flash::success('Your profile details updated successfully.');
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

}
