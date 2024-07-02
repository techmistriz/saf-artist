<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use App\Models\AddressProof;
use App\Models\UserCategoryDetail;
use App\Models\UserAccountDetail;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Project;
use App\Models\ArtistType;
use App\Models\Curator;
use Carbon\Carbon;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserCategoryDetailsRequest;
use App\Http\Requests\UserAccountDetailsRequest;
use Hash;
use Image;
use ImageUploadHelper;
use FileUploadHelper;
use App\Traits\UserTrait;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportUser;

class UserController extends Controller
{   
    /*
    |--------------------------------------------------------------------------
    | {{moduleTitle}} Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles create, update, delete and show list of {{moduleTitle}}.
    |
    */

    use UserTrait;

    public static $moduleConfig = [
        "routes" => [
            "listRoute" => 'admin.user.index',
            "fetchDataRoute" => 'admin.user.fetch.data', 
            "createRoute" => 'admin.user.create', 
            "storeRoute" => 'admin.user.store', 
            "editRoute" => 'admin.user.edit', 
            "updateRoute" => 'admin.user.update', 
            "deleteRoute" => 'admin.user.delete',
            "editCategoryDetailsRoute" => 'admin.user.edit.category.details', 
            "updateCategoryDetailsRoute" => 'admin.user.update.category.details', 
            "editAccountDetailsRoute" => 'admin.user.edit.account.details', 
            "updateAccountDetailsRoute" => 'admin.user.update.account.details',
            // "artistMemberListRoute" => 'admin.user.artist.member.index',
            // "artistMemberFetchDataRoute" => 'admin.user.artist.member.fetch.data', 
        ],
        "moduleTitle" => 'Users',
        "moduleName" => 'user',
        "viewFolder" => 'user',
        // "viewArtistMemberFolder" => 'artist_member',
        "viewCategoryDetailsFolder" => 'user.category_details',
        "viewAccountDetailsFolder" => 'user.account_details',
        "imageUploadFolder" => 'uploads/users/',
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

        $disciplines       = \Auth::user()->getUserDisciplines();
        $userRoleCode      = \Auth::user()->getUserRoleCode();
        $individuals       = User::where('status', 1)->where('frontend_role_id', 8)->get();

        return view('admin.'.self::$moduleConfig['viewFolder'].'.index')->with('moduleConfig', self::$moduleConfig)->with('disciplines', $disciplines)->with('userRoleCode', $userRoleCode)->with('individuals', $individuals);
    }

    /**
     * Fetch data for datatable via ajax request for {{moduleTitle}}.
     *
     * @param  null
     * @return \Illuminate\Http\Response
     */

    public function fetchData(Request $request, User $User)
    {
        
        $data               =   $request->all();

        $db_data            =   $User->getList($data, ['category', 'frontendRole'],['poc_id'=> NULL]);

        $count              =   $User->getListCount($data, [] ,['poc_id'=> NULL]);

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
    public function create(User $User){
        
        $categories     = Category::where('status', 1)->get();
        $addressProofs  = AddressProof::where('status', 1)->get();
        $countries      = Country::where('status', 1)->get();
        $artistTypes    = ArtistType::where('status', 1)->get();
        $curators       = Curator::where('status', 1)->orderBy('name', 'asc')->get();
        $projects       = Project::where('status', 1)->where('year', date('Y'))->get();
        $frontendRoles  = Role::where(['status' => 1, 'type' => 2])->get();

        return view('admin.'.self::$moduleConfig['viewFolder'].'.create')
            ->with('moduleConfig', self::$moduleConfig)
            ->with('row', null)
            ->with('categories', $categories)
            ->with('addressProofs', $addressProofs)
            ->with('years' , $this->years)
            ->with('countries', $countries)
            ->with('artistTypes', $artistTypes)
            ->with('curators', $curators)
            ->with('frontendRoles', $frontendRoles)
            ->with('projects', $projects);
    }

    /**
     * Create a new {{moduleTitle}}.
     *
     * @param  null
     * @return Redirect
     */
    public function store (UserRequest $request){

        $this->__updateProfile($request);

        \Flash::success(self::$moduleConfig['moduleTitle'].' created successfully');
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

    /**
     * Show show  form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id, User $User){

        $row = User::with(['category', 'artistType', 'PACountry', 'PAState', 'PACity'])->findOrFail($id);
        $members = User::where('status', 1)->where('poc_id', $row->id)->get();
        $userCategoryDetails = UserCategoryDetail::where('status', 1)->where('user_id', $row->id)->first();
        return view('admin.'.self::$moduleConfig['viewFolder'].'.show ')->with('moduleConfig', self::$moduleConfig)->with('row', $row)->with('members', $members)->with('userCategoryDetails', $userCategoryDetails);
    }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id, User $User){

        // $user    = User::findOrFail($user_id);
        // \Mail::to($user->email)->send(new \App\Mail\RegisterMailable($user));
        // \App\Notifications\WhatsappNotification::sendRegistrationMessage($user);
        // \App\Notifications\WhatsappNotification::sendUpdateAccountDetailsMessage($user);
        
        $categories     = Category::where('status', 1)->get();
        $addressProofs  = AddressProof::where('status', 1)->get();
        $countries      = Country::where('status', 1)->get();
        $artistTypes    = ArtistType::where('status', 1)->get();
        $curators       = Curator::where('status', 1)->orderBy('name', 'asc')->get();
        $projects       = Project::where('status', 1)->where('year', date('Y'))->get();
        $frontendRoles  = Role::where(['status' => 1, 'type' => 2])->get();

        $row            = User::findOrFail($user_id);
        return view('admin.'.self::$moduleConfig['viewFolder'].'.edit')
            ->with('moduleConfig', self::$moduleConfig)
            ->with('row', $row)
            ->with('categories', $categories)
            ->with('addressProofs', $addressProofs)
            ->with('years' , $this->years)
            ->with('countries', $countries)
            ->with('artistTypes', $artistTypes)
            ->with('curators', $curators)
            ->with('frontendRoles', $frontendRoles)
            ->with('projects', $projects);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(UserRequest $request, $id){

        $this->__updateProfile($request, $id);

        $user   = User::findOrFail($id);
        // \Mail::to($user->email)->send(new \App\Mail\UserDetailsUpdateMailable($user));
        \App\Notifications\WhatsappNotification::sendUpdateAccountDetailsMessage($user);

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
        
        \Flash::success(self::$moduleConfig['moduleTitle'].' can\'t be deleted.'); 
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

    /**
     * Delete {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */

    // public function export(Request $request)
    // {
    //     // dd($request->all());

    //     return Excel::download(new ExportUser($request->category_ids), 'users.xlsx');
    // }

    public function export(Request $request)
    {
        $category_ids = $request->input('category_ids');
        $individual_ids = $request->input('individual_ids');

        return Excel::download(new ExportUser($category_ids, $individual_ids), 'artist_member.xlsx');
    }


    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function editCategoryDetails($user_id, User $User){

        $user           = User::findOrFail($user_id);
        $row            = UserCategoryDetail::where('user_id', $user_id)->first();
        $projects       = Project::where('status', 1)->where('year', date('Y'))->get();

        if(empty($row)){
            UserCategoryDetail::create(['user_id' => $user_id]);
            $row        = UserCategoryDetail::where('user_id', $user_id)->first();
        }
        
        $catViewFile    = $this->categoryAdminFormResolver($user->category_id);

        // dd($catViewFile);

        $categories     = Category::where('status', 1)->get();

        return view('admin.'.self::$moduleConfig['viewCategoryDetailsFolder'].'.edit')->with('moduleConfig', self::$moduleConfig)->with('row', $row)->with('catViewFile', $catViewFile)->with('projects', $projects)->with('categories', $categories);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function updateCategoryDetails(UserCategoryDetailsRequest $request, $user_id){

        // dd($request->all());

        // $this->__updateCategoryDetails($request);
        $user  = User::findOrFail($user_id);
        $func  = $this->categoryFunctionResolver($user->category_id);
        
        // \Mail::to($user->email)->send(new \App\Mail\UserDetailsUpdateMailable($user));
        \App\Notifications\WhatsappNotification::sendUpdateAccountDetailsMessage($user);
        
        return $this->{$func}($request, $user_id);

        // \Flash::success(self::$moduleConfig['moduleTitle'].' category details updated successfully.');
        // return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function showCategoryDetails($user_id, User $User){

        $row            = UserCategoryDetail::with(['otherProjectCategory', 'otherProject'])->where('user_id', $user_id)->first();

        if(empty($row)){
            UserCategoryDetail::create(['user_id' => $user_id]);
            $row        = UserCategoryDetail::where('user_id', $user_id)->first();
        }
        
        $user           = User::findOrFail($user_id);
        $catViewFile    = $this->categoryAdminFormResolver($user->category_id);

        return view('admin.'.self::$moduleConfig['viewCategoryDetailsFolder'].'.show.' . $catViewFile . '.show')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function editAccountDetails($user_id, User $User){

        $user                   = User::find($user_id);
        $row                    = UserAccountDetail::where('user_id', $user_id)->first();
        
        if(empty($row)) {
            UserAccountDetail::create(['user_id' => $user_id]);
            $row                    = UserAccountDetail::where('user_id', $user_id)->first();
        }
        
        // dd($row);
        
        return view('admin.'.self::$moduleConfig['viewAccountDetailsFolder'].'.edit')->with('moduleConfig', self::$moduleConfig)->with('row', $row)->with('user', $user);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function updateAccountDetails(UserAccountDetailsRequest $request, $user_id){

        $this->__updateAccountDetails($request, $user_id);

        $user   = User::findOrFail($user_id);

        // \Mail::to($user->email)->send(new \App\Mail\UserDetailsUpdateMailable($user));
        \App\Notifications\WhatsappNotification::sendUpdateAccountDetailsMessage($user);
        
        \Flash::success(self::$moduleConfig['moduleTitle'].' account details updated successfully.');
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }


    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function showAccountDetails($user_id, User $User){

        $row                    = UserAccountDetail::where('user_id', $user_id)->first();

        if(empty($row)) {
            UserAccountDetail::create(['user_id' => $user_id]);
            $row                    = UserAccountDetail::where('user_id', $user_id)->first();
        }
        
        return view('admin.'.self::$moduleConfig['viewAccountDetailsFolder'].'.show')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    }


    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */

    public function updateFreezeStatus (Request $request, $id = NULL){

        // dd($request->all());
        $user = User::find($id);

        if($user){
            $user->is_freeze = !$user->is_freeze;
            $user->save();
        }

        \Flash::success('Freeze status updated successfully');
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }


    // public function artistMemberIndex(Request $request){

    //     return view('admin.'.self::$moduleConfig['viewArtistMemberFolder'].'.index')->with('moduleConfig', self::$moduleConfig);
    // }

    /**
     * Fetch data for datatable via ajax request for {{moduleTitle}}.
     *
     * @param  null
     * @return \Illuminate\Http\Response
     */

    // public function artistMemberFetchData(Request $request, ArtistMember $artistMember)
    // {
        
    //     $data               =   $request->all();

    //     $db_data            =   $artistMember->getList($data, ['frontendRole', 'poc']);

    //     $count              =   $artistMember->getListCount($data);

    //     $returnArray = array(
    //         'data' => $db_data,
    //         'meta' => array(
    //             'page'          =>      $data['pagination']['page'] ?? 1, 
    //             'pages'         =>      $data['pagination']['pages'] ?? 1, 
    //             'perpage'       =>      $data['pagination']['perpage'] ?? 10, 
    //             'total'         =>      $count, 
    //             'sort'          =>      $data['sort']['sort'] ?? 'asc', 
    //             'field'         =>      $data['sort']['field'] ?? '_id', 
    //         ),
    //     );

    //     return $returnArray;
    // }

}
