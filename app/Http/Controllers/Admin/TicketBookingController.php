<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TicketBooking;
use App\Models\UserProfile;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Project;
use App\Models\TravelPurpose;
use App\Models\User;
use App\Models\MetroCity;
use Carbon\Carbon;
use App\Http\Requests\TicketBookingRequest;
use Hash;
use Image;
use Auth;
use ImageUploadHelper;

class TicketBookingController extends Controller
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
            "listRoute" => 'admin.ticket_booking.index',
            "fetchDataRoute" => 'admin.ticket_booking.fetch.data', 
            "createRoute" => 'admin.ticket_booking.create', 
            "storeRoute" => 'admin.ticket_booking.store', 
            "editRoute" => 'admin.ticket_booking.edit', 
            "updateRoute" => 'admin.ticket_booking.update', 
            "deleteRoute" => 'admin.ticket_booking.delete',
        ],
        "moduleTitle" => 'Ticket Booking',
        "moduleName" => 'ticket_booking',
        "viewFolder" => 'ticket_booking',
        "passportUploadFolder" => 'uploads/passports/',
        "adhaarcardDrivingUploadFolder" => 'uploads/adhaarcard_drivings/',
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
        $userProfiles       = UserProfile::where('status', 1)->get();
        return view('admin.'.self::$moduleConfig['viewFolder'].'.index')->with('moduleConfig', self::$moduleConfig)->with('userProfiles', $userProfiles);
    }

    /**
     * Fetch data for datatable via ajax request for {{moduleTitle}}.
     *
     * @param  null
     * @return \Illuminate\Http\Response
     */

    public function fetchData(Request $request, TicketBooking $ticket)
    {
        
        $data               =   $request->all();

        $whereArr = [];
        if ($request->profile_id) {
            $whereArr = ['profile_id' => $request->profile_id];
        }
        $db_data            =   $ticket->getList($data, ['userProfile.festival'], $whereArr);

        $count 				=  	$ticket->getListCount($data, [], $whereArr);

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
    // public function create(TicketBooking $ticket)
    // {
    //     $userId = Auth::user()->id;
    //     $members = User::where('status', 1)
    //         ->whereNotNull('poc_id')
    //         ->whereNotIn('id', function($query) {
    //             $query->select('source_id')
    //                 ->from('ticket_bookings');
    //         })
    //         ->get();
        
    //     $countries          = Country::where('status', 1)->get();
    //     $cities             = MetroCity::select('id', 'city_name')->where('status', 1)->get();
    //     $travelModes        = TravelMode::where('status', 1)->get();
    //     $projects           = Project::where('status', 1)->get();  //->where('year', date('Y'))

    //     return view('admin.'.self::$moduleConfig['viewFolder'].'.create')->with('moduleConfig', self::$moduleConfig)->with('row', null)->with(['countries' => $countries, 'cities' => $cities, 'travelModes' => $travelModes, 'projects' => $projects, 'members' => $members]);
    // }

    /**
     * Create a new {{moduleTitle}}.
     *
     * @param  null
     * @return Redirect
     */
    

    // public function store(TicketBookingRequest $request)
    // {
    //     $ticket                                       = new TicketBooking();

    //     if ($request->hasFile('upload_passport')) {
    //         $upload_passport         = $request->file('upload_passport');
    //         $fileName      = ImageUploadHelper::UploadImage(self::$moduleConfig['passportUploadFolder'], $upload_passport);
    //         $ticket->upload_passport  = $fileName;
    //     }


    //     if ($request->hasFile('adhaarcard_driving')) {
    //         $adhaarcard_driving         = $request->file('adhaarcard_driving');
    //         $fileName      = ImageUploadHelper::UploadImage(self::$moduleConfig['adhaarcardDrivingUploadFolder'], $adhaarcard_driving);
    //         $ticket->adhaarcard_driving  = $fileName;
    //     }

    //     $ticket->name                                 = $request->name;
    //     $ticket->source_id                            = $request->member_id;
    //     $ticket->project_id                           = $request->project_id;
    //     $ticket->salutation                           = $request->salutation;
    //     $ticket->age                                  = $request->age;
    //     $ticket->email                                = $request->email;
    //     $ticket->contact                              = $request->contact;
    //     $ticket->onward_city_id                       = $request->onward_city_id;
    //     $ticket->onward_city_other                    = $request->onward_city_other;
    //     $ticket->return_city_id                       = $request->return_city_id;
    //     $ticket->return_city_other                    = $request->return_city_other;
    //     $ticket->artist_remarks                       = $request->artist_remarks;
    //     $ticket->international_or_domestic            = $request->international_or_domestic;
    //     $ticket->work_visa                            = $request->work_visa;
    //     $ticket->ticket_status                        = $this->TICKET_STATUS['Added by Admin'];
    //     $ticket->save();

    //     \Flash::success(self::$moduleConfig['moduleTitle'].' created successfully');
    //     return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    // }


    /**
     * Show show  form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id, TicketBooking $ticket){

        $row = TicketBooking::findOrFail($id);
        return view('admin.'.self::$moduleConfig['viewFolder'].'.show ')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, TicketBooking $ticket){

        $row = TicketBooking::findOrFail($id);
        $user       = User::where('status', 1)->where('id', $row->user_id)->first();
        $userIdArr = TicketBooking::where('status', 1)->whereNotIn('profile_id', [$row->profile_id])->get()->pluck('profile_id');
        $userProfiles = UserProfile::where('status', 1)->where('email', $user->email)->whereNotIn('id', $userIdArr)->get();
        
        $countries          = Country::where('status', 1)->get();
        $travelPurposes     = TravelPurpose::where('status', 1)->get();
        $cities             = MetroCity::select('id', 'city_name')->where('status', 1)->get();
        $projects           = Project::where('status', 1)->get();

       return view('admin.'.self::$moduleConfig['viewFolder'].'.edit')->with('moduleConfig', self::$moduleConfig)->with('row', $row)->with(['countries' => $countries, 'cities' => $cities, 'travelPurposes' => $travelPurposes, 'projects' => $projects, 'userProfiles' => $userProfiles, 'user' => $user]);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(TicketBookingRequest $request, $id){

        $ticket                  = TicketBooking::findOrFail($id);

        if ($request->hasFile('front_side_passport')) {
            $front_side_passport         = $request->file('front_side_passport');
            $fileName      = FileUploadHelper::UploadFile(self::$moduleConfig['passportUploadFolder'], $front_side_passport);
            $ticket->front_side_passport  = $fileName;
        }
        if ($request->hasFile('back_side_passport')) {
            $back_side_passport         = $request->file('back_side_passport');
            $fileName      = FileUploadHelper::UploadFile(self::$moduleConfig['passportUploadFolder'], $back_side_passport);
            $ticket->back_side_passport  = $fileName;
        }

        if ($request->hasFile('upload_visa')) {
            $upload_visa         = $request->file('upload_visa');
            $fileName      = FileUploadHelper::UploadFile(self::$moduleConfig['visaUploadFolder'], $upload_visa);
            $ticket->upload_visa  = $fileName;
        }

        if ($request->hasFile('adhaarcard_driving')) {
            $adhaarcard_driving         = $request->file('adhaarcard_driving');
            $fileName      = FileUploadHelper::UploadFile(self::$moduleConfig['adhaarcardDrivingUploadFolder'], $adhaarcard_driving);
            $ticket->adhaarcard_driving  = $fileName;
        }
        
        if ($request->user_id) {
            $ticket->user_id  = $request->user_id;
        }else{
            $ticket->user_id     = \Auth::user()->id;            
        }
        
        $ticket->ticket_status                = $request->ticket_status;
        $ticket->profile_id                   = $request->profile_id;
        $ticket->profile_member_ids           = $request->profile_member_ids;
        $ticket->travel_purpose_id            = $request->travel_purpose_id;
        $ticket->name                         = $request->name;
        $ticket->project_ids                  = $request->project_ids;
        $ticket->salutation                   = $request->salutation;
        $ticket->age                          = $request->age;
        $ticket->email                        = $request->email;
        $ticket->contact                      = $request->contact;
        $ticket->onward_city                  = $request->onward_city;
        $ticket->return_city                  = $request->return_city;
        $ticket->artist_remarks               = $request->artist_remarks;
        $ticket->international_or_domestic    = $request->international_or_domestic;
        $ticket->work_visa                    = $request->work_visa;
        $ticket->onward_date                  = $request->onward_date;
        $ticket->return_date                  = $request->return_date;
        $ticket->save();

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
        
        $row = TicketBooking::findOrFail($id);
        $row->delete();
        \Flash::success(self::$moduleConfig['moduleTitle'].' can\'t be deleted.'); 
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

}
