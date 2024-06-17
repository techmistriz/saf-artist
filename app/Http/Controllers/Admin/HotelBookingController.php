<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HotelBooking;
use App\Models\UserProfile;
use App\Models\Project;
use App\Models\User;
use App\Models\ShareRoom;
use App\Models\TravelPurpose;
use Carbon\Carbon;
use App\Http\Requests\HotelBookingRequest;
use Hash;
use Image;
use Auth;
use ImageUploadHelper;

class HotelBookingController extends Controller
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
            "listRoute" => 'admin.hotel_booking.index',
            "fetchDataRoute" => 'admin.hotel_booking.fetch.data', 
            "createRoute" => 'admin.hotel_booking.create', 
            "storeRoute" => 'admin.hotel_booking.store', 
            "editRoute" => 'admin.hotel_booking.edit', 
            "updateRoute" => 'admin.hotel_booking.update', 
            "deleteRoute" => 'admin.hotel_booking.delete',
        ],
        "moduleTitle" => 'Hotel Booking',
        "moduleName" => 'hotel_booking',
        "viewFolder" => 'hotel_booking',
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
        $userProfiles       = UserProfile::where('status', 1)->get();
        return view('admin.'.self::$moduleConfig['viewFolder'].'.index')->with('moduleConfig', self::$moduleConfig)->with('userProfiles', $userProfiles);
    }

    /**
     * Fetch data for datatable via ajax request for {{moduleTitle}}.
     *
     * @param  null
     * @return \Illuminate\Http\Response
     */

    public function fetchData(Request $request, HotelBooking $hotel)
    {
        
        $data               =   $request->all();

        $whereArr = [];
        if ($request->profile_id) {
            $whereArr = ['profile_id' => $request->profile_id];
        }
        $db_data            =   $hotel->getList($data, ['userProfile.festival'], $whereArr);

        $count 				=  	$hotel->getListCount($data, [], $whereArr);

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
    public function show ($id, HotelBooking $hotel){

        $row = HotelBooking::findOrFail($id);
        $shareRooms = ShareRoom::where(['hotel_booking_id' => $id])->get(); 
        return view('admin.'.self::$moduleConfig['viewFolder'].'.show ')->with('moduleConfig', self::$moduleConfig)->with('row', $row)->with('shareRooms', $shareRooms);
    }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $row = HotelBooking::findOrFail($id);
        $user       = User::where('status', 1)->where('id', $row->user_id)->first();
        $userIdArr = HotelBooking::where('status', 1)->whereNotIn('profile_id', [$row->profile_id])->get()->pluck('profile_id');
        $userProfiles = UserProfile::where('status', 1)->where('email', $user->email)->whereNotIn('id', $userIdArr)->get();
        $travelPurposes     = TravelPurpose::where('status', 1)->get();

        return view('admin.'.self::$moduleConfig['viewFolder'].'.edit')->with('moduleConfig', self::$moduleConfig)->with('row', $row)->with('userProfiles', $userProfiles)->with('travelPurposes', $travelPurposes)->with('user', $user);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(HotelBookingRequest $request, $id){

        $hotel                  = HotelBooking::findOrFail($id);

        if ($request->user_id) {
            $hotel->user_id  = $request->user_id;
        }else{
            $hotel->user_id     = \Auth::user()->id;            
        }
        $hotel->profile_id             = $request->profile_id;
        $hotel->profile_member_ids     = $request->profile_member_ids;
        $hotel->travel_purpose_id      = $request->travel_purpose_id;
        $hotel->accomodation           = $request->accomodation;
        $hotel->check_in_date          = $request->check_in_date;
        $hotel->check_out_date         = $request->check_out_date;
        $hotel->total_room_nights      = $request->total_room_nights;
        $hotel->artist_remarks         = $request->artist_remarks;
        $hotel->venue_id               = $request->venue_id;
        $hotel->hotel_budget           = $request->hotel_budget;
        $hotel->room_sharing           = $request->room_sharing;
        $hotel->local_travel           = $request->local_travel;
        $hotel->performance_date       = $request->performance_date;
        $hotel->save();

        $sharing_room_Arr              = $request->sharing_room;
        $name_1_Arr                    = $request->name_1;
        $name_2_Arr                    = $request->name_2;
        $name_3_Arr                    = $request->name_3;
        $sharing_room_ids_arr          = $request->sharing_room_ids;

        if(isset($sharing_room_Arr) && !empty($sharing_room_Arr) && is_array($sharing_room_Arr)){
            foreach ($sharing_room_Arr as $key => $value) {

                if(isset($sharing_room_Arr[$key]) && !empty($sharing_room_Arr[$key])){

                    $shareRoom         = ShareRoom::find($sharing_room_ids_arr[$key]);

                    if(empty($shareRoom)){
                        $shareRoom     = new ShareRoom();
                    }

                    $shareRoom->hotel_booking_id     = $hotel->id;
                    $shareRoom->sharing_room         = $sharing_room_Arr[$key];
                    $shareRoom->name_1               = $name_1_Arr[$key];
                    $shareRoom->name_2               = $name_2_Arr[$key];
                    $shareRoom->name_3               = $name_3_Arr[$key];
                    $shareRoom->save();
                }
            }
        }

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
        
        $row = HotelBooking::findOrFail($id);
        ShareRoom::where('hotel_booking_id', $id)->delete();
        $row->delete();
        \Flash::success(self::$moduleConfig['moduleTitle'].' can\'t be deleted.'); 
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

}
