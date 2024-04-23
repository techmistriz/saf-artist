<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HotelBooking;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Role;
use App\Models\Project;
use App\Models\TravelMode;
use App\Models\MetroCity;
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
        
        $data               =   $request->all();

        $db_data            =   $hotel->getList($data);

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
    public function create(HotelBooking $hotel)
    {
        $userId = Auth::user()->id;
        $members = User::where('status', 1)
            ->where('poc_id', $userId)
            ->whereNotIn('id', function($query) {
                $query->select('source_id')
                    ->from('hotel_bookings');
            })
            ->get();

        return view('frontend.hotel_booking.create')->with('row', null)->with('members', $members);
    }

    /**
     * Create a new {{moduleTitle}}.
     *
     * @param  null
     * @return Redirect
     */
    

    public function store(HotelBookingRequest $request)
    {
        $hotel                                       = new HotelBooking();

        if (isset(Auth::user()->frontendRole->name) && (Auth::user()->frontendRole->name == 'Individual')) {

            $hotel->source_id   = Auth::user()->id;
        }else{            
            $hotel->source_id   = $request->member_id;
        }


        $hotel->accomodation                         = $request->accomodation;
        $hotel->check_in_date                        = $request->check_in_date;
        $hotel->check_out_date                       = $request->check_out_date;
        $hotel->total_room_nights                    = $request->total_room_nights;
        $hotel->artist_remarks                       = $request->artist_remarks;
        $hotel->hotel_status                         = $this->HOTEL_STATUS['Added by Group'];
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

        $userId = Auth::user()->id;
        $members            = User::where('status', 1)->where('poc_id', $userId)->get();

        return view('frontend.hotel_booking.edit')->with('row', $row)->with('members', $members);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(HotelBookingRequest $request, $id){

        $hotel                  = HotelBooking::findOrFail($id);
        
        if (isset(Auth::user()->frontendRole->name) && (Auth::user()->frontendRole->name == 'Individual')) {

            $hotel->source_id   = Auth::user()->id;
        }else{            
            $hotel->source_id   = $request->member_id;
        }

        $hotel->accomodation                         = $request->accomodation;
        $hotel->check_in_date                        = $request->check_in_date;
        $hotel->check_out_date                       = $request->check_out_date;
        $hotel->total_room_nights                    = $request->total_room_nights;
        $hotel->artist_remarks                       = $request->artist_remarks;
        $hotel->hotel_status                         = $this->HOTEL_STATUS['Added by Group'];
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