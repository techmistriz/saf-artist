<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserCategoryDetail;
use App\Models\UserAccountDetail;
use App\Models\Category;
use App\Models\Curator;
use App\Models\ArtistType;
use App\Models\AddressProof;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\MetroCity;
use App\Models\Project;
use App\Models\Faq;
use App\Models\Role;
use App\Models\TravelMode;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserCategoryDetailsRequest;
use App\Http\Requests\UserAccountDetailsRequest;
use App\Http\Requests\UserTravelBoardingDetailsRequest;
use Carbon\Carbon;
use DB;
use Hash;
use Image;
use Auth;
use ImageUploadHelper;
use FileUploadHelper;
use App\Traits\UserTrait;
use App\Traits\TravelBoardingTrait;

class UserController extends Controller
{
	use UserTrait;
	use TravelBoardingTrait;
	
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

    public function fetchData(Request $request, User $user)
    {
        $userEmail = Auth::user()->email;

        $data               =   $request->all();

        $db_data            =   $user->getList($data, ['project', 'festival'], ['email'=> $userEmail]);

        $count              =   $user->getListCount($data,[], ['email'=> $userEmail]);

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
    public function create(User $user)
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

    public function store(UserRequest $request) 
    {
        $existingUser = User::where('festival_id', $request->festival_id)->first();

        if ($existingUser) {
            \Flash::error('Festival ID already exists for this user.');
            return redirect()->back();
        }
        $this->__storeUser($request);

        \Flash::success('Your personal details created successfully.');
        return \Redirect::route('dashboard');
    }

    /**
     * Show show  form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id)
    {

        $row = User::findOrFail($id);
        $members = User::where('status', 1)->where('poc_id', $row->id)->get();
       // dd($members);
        return view('frontend.user.show')->with('row', $row)->with('members', $members);
    }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $row = User::findOrFail($id);
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
    public function update(UserRequest $request, $id){

        $this->__updateProfile($request, $id);

        \Flash::success('Your personal details updated successfully.');
        return \Redirect::route('dashboard');
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function updateProfilePicture(Request $request) {

	 	$user_id 						= \Auth::user()->id;
		$user 							= User::findOrFail($user_id);
		if ($request->hasFile('profile_image')) {

            $profile_image       		= $request->file('profile_image');
            $profile_image_fileName		= ImageUploadHelper::UploadImage(self::$moduleConfig['imageUploadFolder'], $profile_image, $request->input('title'), 900, 900, true);
            $user->profile_image_1 		= $profile_image_fileName;
        }

        $user->save();

    	\Flash::success('Your proofile picture updated successfully.');
        return \Redirect::route('dashboard');
    }

    public function editCategoryDetails()
    {

        $user			= \Auth::user();
        $user_id		= $user->id;
        $row			= UserCategoryDetail::where('user_id', $user_id)->first();
        $categories 	= Category::where('status', 1)->get();
        $projects 		= Project::where('status', 1)->where('year', date('Y'))->get();

    	if(empty($row)){
    		UserCategoryDetail::create(['user_id' => $user_id]);
    		$row		= UserCategoryDetail::where('user_id', $user_id)->first();
    	}

    	$viewFile = $this->roleFormResolver();

    	// dd($viewFile);
    	
        return view($viewFile)->with('row', $row)->with('categories', $categories)->with('projects', $projects)->with('user', $user);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function updateCategoryDetails(Request $request){

    	$this->__updateCategoryDetails_performing_arts($request);
    	$func = $this->categoryFunctionResolver();
    	return $this->{$func}($request);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function updateCategory(Request $request){

    	$user_id			= \Auth::user()->id;
		$user				= User::findOrFail($user_id);
		$user->category_id 	= $request->category_id;
		$user->save();

    	\Flash::success('Your category updated successfully.');
        return \Redirect::route('edit.category.details');
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function editHotelBookingDetails()
    {
        $user 				= \Auth::user();
        $user_id 			= $user->id;
        $countries 			= Country::where('status', 1)->get();
    	$cities 			= MetroCity::select('id', 'city_name')->where('status', 1)->get();
    	$travelModes		= TravelMode::where('status', 1)->get();
    	$projects 			= Project::where('status', 1)->where('year', date('Y'))->get();

        $row				= TravelBoarding::where('user_id', $user_id)->first();
    	if(empty($row)) {
    		TravelBoarding::create(['user_id' => $user_id]);
    		$row			= TravelBoarding::where('user_id', $user_id)->first();
    	}

        return view('frontend.hotel_booking_details.edit')->with(['row' => $row, 'countries' => $countries, 'cities' => $cities, 'travelModes' => $travelModes, 'user' => $user, 'projects' => $projects]);
    }

    public function editTicketBookingDetails()
    {
        $user               = \Auth::user();
        $user_id            = $user->id;
        $countries          = Country::where('status', 1)->get();
        $cities             = MetroCity::select('id', 'city_name')->where('status', 1)->get();
        $travelModes        = TravelMode::where('status', 1)->get();
        $projects           = Project::where('status', 1)->where('year', date('Y'))->get();

        $row                = TravelBoarding::where('user_id', $user_id)->first();
        if(empty($row)) {
            TravelBoarding::create(['user_id' => $user_id]);
            $row            = TravelBoarding::where('user_id', $user_id)->first();
        }

        return view('frontend.ticket_booking_details.edit')->with(['row' => $row, 'countries' => $countries, 'cities' => $cities, 'travelModes' => $travelModes, 'user' => $user, 'projects' => $projects]);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function updateTravelBoardingDetails(UserTravelBoardingDetailsRequest $request){

    	$this->__updateTravelBoarding($request);

    	\Flash::success('Your account details updated successfully.');
        return \Redirect::route('edit.travel_boarding.details');
    }

    public function FaqDetails()
    {
        $faqs        = Faq::where('status', 1)->get();
        return view('frontend.faq_details.details')->with('faqs', $faqs);
    }

}
