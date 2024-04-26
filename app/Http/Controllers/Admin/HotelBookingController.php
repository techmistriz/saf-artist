<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HotelBooking;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Project;
use App\Models\Venue;
use App\Models\TravelMode;
use App\Models\MetroCity;
use App\Models\ShareRoom;
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
        // "passportUploadFolder" => 'uploads/passports/',
        // "adhaarcardDrivingUploadFolder" => 'uploads/adhaarcard_drivings/',
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

    public function fetchData(Request $request, HotelBooking $hotel)
    {
        
        $data               =   $request->all();

        $db_data            =   $hotel->getList($data,['member']);

        $count 				=  	$hotel->getListCount($data);

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
    // public function create(HotelBooking $hotel)
    // {
    //     $userId = Auth::user()->id;
    //     $members = User::where('status', 1)
    //         ->whereNotNull('poc_id')
    //         ->whereNotIn('id', function($query) {
    //             $query->select('source_id')
    //                 ->from('hotel_bookings');
    //         })
    //         ->get();

    //    return view('admin.'.self::$moduleConfig['viewFolder'].'.create')->with('moduleConfig', self::$moduleConfig)->with('row', null)->with('members', $members);
    // }

    /**
     * Create a new {{moduleTitle}}.
     *
     * @param  null
     * @return Redirect
     */
    

    // public function store(HotelBookingRequest $request)
    // {
    //     $hotel                                       = new HotelBooking();

    //     $hotel->source_id                            = $request->member_id;
    //     $hotel->accomodation                         = $request->accomodation;
    //     $hotel->check_in_date                        = $request->check_in_date;
    //     $hotel->check_out_date                       = $request->check_out_date;
    //     $hotel->total_room_nights                    = $request->total_room_nights;
    //     $hotel->artist_remarks                       = $request->artist_remarks;
    //     $hotel->hotel_status                         = $this->HOTEL_STATUS['Added by Admin'];
    //     $hotel->save();

    //     \Flash::success(self::$moduleConfig['moduleTitle'].' created successfully');
    //     return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    // }


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

        $user = User::findOrFail($id);
        
        $row = HotelBooking::where('source_id', $id)->first();
        if (!$row) {
           // \Flash::error('Hotel details not found');
           //  return \Redirect::route('admin.user.index');
        }
        // $userId             = Auth::user()->id;
        $venues             = Venue::where('status', 1)->get();
        $members            = User::where('status', 1)->where('poc_id', $user->id)->get();
        $shareRooms         = ShareRoom::where(['hotel_booking_id' => $id])->get();

        return view('admin.'.self::$moduleConfig['viewFolder'].'.edit')->with('moduleConfig', self::$moduleConfig)->with('row', $row)->with('members', $members)->with('venues', $venues)->with('shareRooms', $shareRooms)->with('user', $user);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(HotelBookingRequest $request, $id){

        $hotel                  = HotelBooking::findOrFail($id);

        $hotel->source_id                            = $request->member_id;
        $hotel->accomodation                         = $request->accomodation;
        $hotel->check_in_date                        = $request->check_in_date;
        $hotel->check_out_date                       = $request->check_out_date;
        $hotel->total_room_nights                    = $request->total_room_nights;
        $hotel->artist_remarks                       = $request->artist_remarks;
        $hotel->venue_id                             = $request->venue_id;
        $hotel->hotel_budget                         = $request->hotel_budget;
        $hotel->room_sharing                         = $request->room_sharing;
        $hotel->local_travel                         = $request->local_travel;
        $hotel->performance_date                     = $request->performance_date;
        $hotel->hotel_status                         = $this->HOTEL_STATUS['Added by Admin'];
        $hotel->save();

        $room_no_Arr              = $request->room_no;
        $name_1_Arr               = $request->name_1;
        $name_2_Arr               = $request->name_2;
        $room_no_ids_arr          = $request->room_no_ids;

        if(isset($room_no_Arr) && !empty($room_no_Arr) && is_array($room_no_Arr)){
            foreach ($room_no_Arr as $key => $value) {

                if(isset($room_no_Arr[$key]) && !empty($room_no_Arr[$key])){

                    $shareRoom         = ShareRoom::find($room_no_ids_arr[$key]);

                    if(empty($shareRoom)){
                        $shareRoom     = new ShareRoom();
                    }

                    $shareRoom->hotel_booking_id     = $hotel->id;
                    $shareRoom->room_no              = $room_no_Arr[$key];
                    $shareRoom->name_1             = $name_1_Arr[$key];
                    $shareRoom->name_2               = $name_2_Arr[$key];
                    $shareRoom->save();
                }
            }
        }

        \Flash::success(self::$moduleConfig['moduleTitle'].' updated successfully.');
        return \Redirect::route('admin.user.index');
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
