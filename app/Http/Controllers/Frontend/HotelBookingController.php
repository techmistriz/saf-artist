<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HotelBooking;
use App\Models\UserProfile;
use App\Models\TravelPurpose;
use Carbon\Carbon;
use App\Http\Requests\HotelBookingRequest;
use Hash;
use Image;
use Auth;
use ImageUploadHelper;

class HotelBookingController extends Controller
{   
    
    public static $moduleConfig = [
        "passportUploadFolder" => 'uploads/passports/',
        "adhaarcardDrivingUploadFolder" => 'uploads/adhaarcard_drivings/',
    ];

	/**
     * Constructor Method.
     *
     * Setting Authentication
     *
     */

    // public function __construct()
    // {
    // 	parent::__construct();
    //     $this->middleware('auth:admin');

    // }


    /**
     * Show list of {{moduleTitle}}.
     *
     * @param  null
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){

        return view('frontend.hotel_booking.index');
    }

    /**
     * Fetch data for datatable via ajax request for {{moduleTitle}}.
     *
     * @param  null
     * @return \Illuminate\Http\Response
     */

    public function fetchData(Request $request, HotelBooking $hotel)
    {
        $userId   = Auth::user()->id;

        $data               =   $request->all();

        $db_data            =   $hotel->getList($data, ['userProfile.festival'], ['user_id' => $userId]);

        $count 				=  	$hotel->getListCount($data, [], ['user_id' => $userId]);

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
    public function create(HotelBooking $hotel)
    {
        $user               = \Auth::user();
        $userProfiles = UserProfile::where('status', 1)->where('email', $user->email)->get();
        $travelPurposes     = TravelPurpose::where('status', 1)->get();

        return view('frontend.hotel_booking.create')
        ->with('row', null)
        ->with('travelPurposes', $travelPurposes)
        ->with('userProfiles', $userProfiles);
    }

    /**
     * Create a new {{moduleTitle}}.
     *
     * @param  null
     * @return Redirect
     */
    

    public function store(HotelBookingRequest $request)
    {
        $hotel                           = new HotelBooking();
        $hotel->user_id                  = Auth::user()->id;
        $hotel->profile_id               = $request->profile_id;
        $hotel->profile_member_ids       = $request->profile_member_ids;
        $hotel->travel_purpose_id        = $request->travel_purpose_id;
        $hotel->accomodation             = $request->accomodation;
        $hotel->occupant                 = $request->occupant;
        $hotel->check_in_date            = $request->check_in_date;
        $hotel->check_out_date           = $request->check_out_date;
        $hotel->total_room_nights        = $request->total_room_nights;
        $hotel->artist_remarks           = $request->artist_remarks;
        $hotel->hotel_status             = $request->hotel_status;
        $hotel->save();

        \Flash::success(' Hotel booking created successfully');
        return \Redirect::route('hotel.booking.list');
    }


    /**
     * Show show  form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id, HotelBooking $hotel){

        $row = HotelBooking::findOrFail($id);
        return view('frontend.hotel_booking.show ')->with('row', $row);
    }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, HotelBooking $hotel){

        $row = HotelBooking::findOrFail($id);

        $user               = \Auth::user();
        $userProfiles = UserProfile::where('status', 1)->where('email', $user->email)->get();
        $travelPurposes     = TravelPurpose::where('status', 1)->get();

        return view('frontend.hotel_booking.edit')
        ->with('row', $row)
        ->with('travelPurposes', $travelPurposes)
        ->with('userProfiles', $userProfiles);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(HotelBookingRequest $request, $id){

        $hotel                       = HotelBooking::findOrFail($id);        
        $hotel->user_id              = Auth::user()->id;
        $hotel->profile_id           = $request->profile_id;
        $hotel->profile_member_ids   = $request->profile_member_ids;
        $hotel->travel_purpose_id    = $request->travel_purpose_id;
        $hotel->accomodation         = $request->accomodation;
        $hotel->occupant             = $request->occupant;
        $hotel->check_in_date        = $request->check_in_date;
        $hotel->check_out_date       = $request->check_out_date;
        $hotel->total_room_nights    = $request->total_room_nights;
        $hotel->artist_remarks       = $request->artist_remarks;
        $hotel->hotel_status         = $request->hotel_status;
        $hotel->save();

        \Flash::success('Hotel booking updated successfully.');
        return \Redirect::route('hotel.booking.list');        
    }

    /**
     * Delete {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */

    public function delete($id)
    {
        
        $row = HotelBooking::findOrFail($id);
        $row->delete();
        \Flash::success('Hotel booking deleted successfully.'); 
        return \Redirect::route('hotel.booking.list');
    }

}
