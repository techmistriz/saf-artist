<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Curator;
use App\Models\ArtistType;
use App\Models\UserProfile;
use App\Models\User;
use App\Models\GroupMember;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Project;
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
   public function index()
    {
        
        return view('frontend.dashboard');
    }

    public function fetchData(Request $request, UserProfile $user_profile)
    {
        $userEmail = Auth::user()->email;

        $data     = $request->all();

        $db_data  = $user_profile->getList($data, ['project', 'festival', 'user'], ['email'=> $userEmail]);

        $count    = $user_profile->getListCount($data,[], ['email'=> $userEmail]);

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
    public function create(UserProfile $user_profile)
    {
        
        $countries      = Country::where('status', 1)->get();
        $artistTypes    = ArtistType::where('status', 1)->get();
        $categories     = Category::where('status', 1)->get();
        $curators       = Curator::where('status', 1)->get();
        return view('frontend.user.create')
        ->with('row', null)
        ->with('years', $this->years)
        ->with('countries', $countries)
        ->with('artistTypes', $artistTypes)
        ->with('categories', $categories)
        ->with('curators', $curators);
    }

    public function store(UserProfileRequest $request) 
    {
        
        $this->__storeUserProfile($request);

        \Flash::success('Your profile details created successfully.');
        return \Redirect::route('dashboard');
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
        $members = GroupMember::where('status', 1)->where('profile_id', $row->id)->paginate(10);

        return view('frontend.user.show', compact('row', 'members'));
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
        return view('frontend.user.edit')
        ->with('row', $row)
        ->with('years', $this->years)
        ->with('countries', $countries)
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
        return \Redirect::route('dashboard');
    }

}
