<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TicketBooking;
use App\Models\ProfileMember;
use App\Models\UserProfile;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Project;
use App\Models\TravelPurpose;
use App\Models\MetroCity;
use App\Models\Role;
use Carbon\Carbon;
use App\Http\Requests\TicketBookingRequest;
use Hash;
use Image;
use Auth;
use FileUploadHelper;

class TicketBookingController extends Controller
{   
    
    public static $moduleConfig = [
        "passportUploadFolder" => 'uploads/passports/',
        "visaUploadFolder" => 'uploads/work_visas/',
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
        $this->getStatus();
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
        $userId   = Auth::user()->id;

        $data               =   $request->all();

        $db_data            =   $ticket->getList($data, ['userProfile.festival'], ['user_id' => $userId]);

        $count 				=  	$ticket->getListCount($data, [], ['user_id' => $userId]);

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
        $userProfiles = UserProfile::where('status', 1)->where('email', $user->email)->get();
        //$userProfiles = UserProfile::where('status', 1)->where('email', $user->email)->get();
        
        $countries          = Country::where('status', 1)->get();
        $travelPurposes     = TravelPurpose::where('status', 1)->get();
        $cities             = MetroCity::select('id', 'city_name')->where('status', 1)->get();
        $projects           = Project::where('status', 1)->get();
        $this->getStatus();
        return view('frontend.ticket_booking.create')
        ->with('row', null)
        ->with(['countries' => $countries, 'cities' => $cities, 'projects' => $projects, 'userProfiles' => $userProfiles, 'travelPurposes' => $travelPurposes]);
    }

    /**
     * Create a new {{moduleTitle}}.
     *
     * @param  null
     * @return Redirect
     */
    

    public function store(TicketBookingRequest $request)
    {

        $ticket                                       = new TicketBooking();

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

        $ticket->user_id                      = Auth::user()->id;
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
        $ticket->international_or_domestic    = $request->international_or_domestic;
        $ticket->work_visa                    = $request->work_visa;
        $ticket->onward_date                  = $request->onward_date;
        $ticket->return_date                  = $request->return_date;
        $ticket->ticket_status                = $request->ticket_status;
        $ticket->pickup_required              = $request->pickup_required;
        $ticket->travel_preferred_time        = $request->travel_preferred_time;
        $ticket->return_preffered_time        = $request->return_preffered_time;
        // $ticket->cab_option                   = $request->cab_option;
        // $ticket->number_of_cabs               = $request->number_of_cabs;
        // $ticket->cab_date_range               = $request->cab_date_range;
        // $ticket->artist_remarks               = $request->artist_remarks;

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
        $this->getStatus();
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
        $user               = \Auth::user();
        $userProfiles = UserProfile::where('status', 1)->where('email', $user->email)->get();
        
        $countries          = Country::where('status', 1)->get();
        $travelPurposes     = TravelPurpose::where('status', 1)->get();
        $cities             = MetroCity::select('id', 'city_name')->where('status', 1)->get();
        $projects           = Project::where('status', 1)->get();
        $this->getStatus();
        return view('frontend.ticket_booking.edit')
        ->with('row', $row)
        ->with(['countries' => $countries, 'cities' => $cities, 'projects' => $projects, 'userProfiles' => $userProfiles, 'travelPurposes' => $travelPurposes]);
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

        $ticket->user_id                      = Auth::user()->id;
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
        $ticket->international_or_domestic    = $request->international_or_domestic;
        $ticket->work_visa                    = $request->work_visa;
        $ticket->onward_date                  = $request->onward_date;
        $ticket->return_date                  = $request->return_date;
        $ticket->ticket_status                = $request->ticket_status;
        $ticket->pickup_required              = $request->pickup_required;
        $ticket->travel_preferred_time        = $request->travel_preferred_time;
        $ticket->return_preffered_time        = $request->return_preffered_time;
        // $ticket->cab_option                   = $request->cab_option;
        // $ticket->number_of_cabs               = $request->number_of_cabs;
        // $ticket->cab_date_range               = $request->cab_date_range;
        // $ticket->artist_remarks               = $request->artist_remarks;
        $ticket->save();

        \Flash::success('Ticket booking updated successfully.');
        return \Redirect::route('ticket.booking.list');
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
