<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TicketBooking;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Project;
use App\Models\TravelMode;
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

    public function index(Request $request){

        return view('admin.'.self::$moduleConfig['viewFolder'].'.index')->with('moduleConfig', self::$moduleConfig);
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

        $db_data            =   $ticket->getList($data,['member', 'project']);

        $count 				=  	$ticket->getListCount($data);

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

        $user = User::findOrFail($id);
        
        $row = TicketBooking::where('source_id', $id)->first();
        if (!$row) {
           // \Flash::error('Hotel details not found');
           //  return \Redirect::route('admin.user.index');
        }

        $countries          = Country::where('status', 1)->get();
        $cities             = MetroCity::select('id', 'city_name')->where('status', 1)->get();
        $travelModes        = TravelMode::where('status', 1)->get();
        $projects           = Project::where('status', 1)->get();
        $members            = User::where('status', 1)->where('poc_id', $user->id)->get();

       return view('admin.'.self::$moduleConfig['viewFolder'].'.edit')->with('moduleConfig', self::$moduleConfig)->with('row', $row)->with(['countries' => $countries, 'cities' => $cities, 'travelModes' => $travelModes, 'projects' => $projects, 'members' => $members, 'user' => $user]);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(TicketBookingRequest $request, $id){

        $ticket                  = TicketBooking::findOrFail($id);
        if ($request->hasFile('upload_passport')) {
            $upload_passport         = $request->file('upload_passport');
            $fileName      = ImageUploadHelper::UploadImage(self::$moduleConfig['passportUploadFolder'], $upload_passport);
            $ticket->upload_passport  = $fileName;
        }


        if ($request->hasFile('adhaarcard_driving')) {
            $adhaarcard_driving         = $request->file('adhaarcard_driving');
            $fileName      = ImageUploadHelper::UploadImage(self::$moduleConfig['adhaarcardDrivingUploadFolder'], $adhaarcard_driving);
            $ticket->adhaarcard_driving  = $fileName;
        }

        $ticket->name                                 = $request->name;
        $ticket->project_id                           = $request->project_id;
        $ticket->salutation                           = $request->salutation;
        $ticket->age                                  = $request->age;
        $ticket->email                                = $request->email;
        $ticket->contact                              = $request->contact;
        $ticket->onward_city_id                       = $request->onward_city_id;
        $ticket->onward_city_other                    = $request->onward_city_other;
        $ticket->return_city_id                       = $request->return_city_id;
        $ticket->return_city_other                    = $request->return_city_other;
        $ticket->artist_remarks                       = $request->artist_remarks;
        $ticket->international_or_domestic            = $request->international_or_domestic;
        $ticket->work_visa                            = $request->work_visa;
        $ticket->ticket_status                        = $this->TICKET_STATUS['Added by Admin'];
        $ticket->save();

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
        
        $row = TicketBooking::findOrFail($id);
        $row->delete();
        \Flash::success(self::$moduleConfig['moduleTitle'].' can\'t be deleted.'); 
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

}
