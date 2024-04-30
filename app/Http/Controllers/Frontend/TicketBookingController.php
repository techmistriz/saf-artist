<?php

namespace App\Http\Controllers\Frontend;

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
use App\Models\Role;
use Carbon\Carbon;
use App\Http\Requests\TicketBookingRequest;
use Hash;
use Image;
use Auth;
use ImageUploadHelper;

class TicketBookingController extends Controller
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

        return view('frontend.ticket_booking.index');
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

        $db_data            =   $ticket->getList($data);

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
    public function create(TicketBooking $ticket)
    {
        $user               = \Auth::user();
        $userId            = $user->id;
        $members = User::where('status', 1)
            ->where('poc_id', $userId)
            ->whereNotIn('id', function($query) {
                $query->select('source_id')
                    ->from('ticket_bookings');
            })
            ->get();
        
        $countries          = Country::where('status', 1)->get();
        $cities             = MetroCity::select('id', 'city_name')->where('status', 1)->get();
        $travelModes        = TravelMode::where('status', 1)->get();
        $projects           = Project::where('status', 1)->get();  //->where('year', date('Y'))

        return view('frontend.ticket_booking.create')->with('row', null)->with(['countries' => $countries, 'cities' => $cities, 'travelModes' => $travelModes, 'projects' => $projects, 'members' => $members, 'user' => $user]);
    }

    /**
     * Create a new {{moduleTitle}}.
     *
     * @param  null
     * @return Redirect
     */
    

    public function store(TicketBookingRequest $request)
    {
        // $pocId = Auth::user()->id;
        // $allowticket = Auth::user()->max_allowed_ticket;
        // $existingticketsCount = TicketBooking::where('poc_id', $pocId)->count();
        // if ($existingticketsCount >= $allowticket) {
        //     \Flash::error('You have allowed to add only'. ' '. $allowticket. ' '. 'tickets.');
        //     return \Redirect::back()->withInput();
        // }

        $ticket                                       = new TicketBooking();

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

        if (isset(Auth::user()->frontendRole->name) && (Auth::user()->frontendRole->name == 'Individual')) {

            $ticket->source_id   = Auth::user()->id;
        }else{            
            $ticket->source_id   = $request->member_id;
        }

        $ticket->name                                 = $request->name;
        $ticket->project_ids                          = $request->project_ids;
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
        $ticket->onward_date                          = $request->onward_date;
        $ticket->return_date                          = $request->return_date;
        $ticket->ticket_status                        = $this->TICKET_STATUS['Added by Group'];
        // dd($ticket);
        $ticket->save();

        \Flash::success('Ticket booking created successfully');
        return \Redirect::route('ticket.booking.list');
    }


    /**
     * Show show  form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id, TicketBooking $ticket){

        $row = TicketBooking::findOrFail($id);
        return view('frontend.ticket_booking.show ')->with('row', $row);
    }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, TicketBooking $ticket){

        $row = TicketBooking::findOrFail($id);
        $countries          = Country::where('status', 1)->get();
        $cities             = MetroCity::select('id', 'city_name')->where('status', 1)->get();
        $travelModes        = TravelMode::where('status', 1)->get();
        $projects           = Project::where('status', 1)->get();  //->where('year', date('Y'))

        $user              = \Auth::user();
        $userId             = $user->id;
        $members            = User::where('status', 1)->where('poc_id', $userId)->get();

        return view('frontend.ticket_booking.edit')->with('row', $row)->with(['countries' => $countries, 'cities' => $cities, 'travelModes' => $travelModes, 'projects' => $projects, 'members' => $members, 'user' => $user]);
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

        if (isset(Auth::user()->frontendRole->name) && (Auth::user()->frontendRole->name == 'Individual')) {

            $ticket->source_id   = Auth::user()->id;
        }else{            
            $ticket->source_id   = $request->member_id;
        }

        $ticket->name                                 = $request->name;
        $ticket->project_ids                          = $request->project_ids;
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
        $ticket->onward_date                          = $request->onward_date;
        $ticket->return_date                          = $request->return_date;
        $ticket->ticket_status                        = $this->TICKET_STATUS['Added by Group'];
        $ticket->save();

        \Flash::success('Ticket booking updated successfully.');
        if (isset(Auth::user()->frontendRole->name) && (Auth::user()->frontendRole->name == 'Individual')) {

            return \Redirect::route('ticket.booking.edit', $ticket->id);
        }else{            
            return \Redirect::route('ticket.booking.list');
        } 
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
        \Flash::success('Ticket booking deleted successfully.'); 
        return \Redirect::route('ticket.booking.list');
    }

}
