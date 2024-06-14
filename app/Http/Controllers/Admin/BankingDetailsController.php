<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankingDetails;
use App\Models\Country;
use App\Models\UserProfile;
use App\Models\User;
use App\Models\Festival;
use Carbon\Carbon;
use App\Http\Requests\BankingDetailsRequest;
use Hash;
use Image;
use Auth;
use ImageUploadHelper;

class BankingDetailsController extends Controller
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
            "listRoute" => 'admin.banking_details.index',
            "fetchDataRoute" => 'admin.banking_details.fetch.data', 
            "createRoute" => 'admin.banking_details.create', 
            "storeRoute" => 'admin.banking_details.store', 
            "editRoute" => 'admin.banking_details.edit', 
            "updateRoute" => 'admin.banking_details.update', 
            "deleteRoute" => 'admin.banking_details.delete',
        ],
        "moduleTitle" => 'Banking Details',
        "moduleName" => 'banking_details',
        "viewFolder" => 'banking_details',
        "imageUploadFolder" => 'uploads/users/',
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

    public function fetchData(Request $request, BankingDetails $ticket)
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
    // public function create(BankingDetails $ticket)
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
    

    // public function store(BankingDetailsRequest $request)
    // {
    //     $ticket                                       = new BankingDetails();

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
    public function show ($id, BankingDetails $ticket){

        $row = BankingDetails::findOrFail($id);
        return view('admin.'.self::$moduleConfig['viewFolder'].'.show ')->with('moduleConfig', self::$moduleConfig)->with('row', $row);
    }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, BankingDetails $ticket)
    {        
        $row = BankingDetails::findOrFail($id);
        $userIdArr = UserAccountDetail::where('status', 1)->whereNotIn('profile_id', [$row->profile_id])->get()->pluck('profile_id');
        // dd($userIdArr);
        $userEmail     = Auth::user()->email;
        $userProfiles         = UserProfile::where('status', 1)->where('email', $userEmail)->whereNotIn('id', $userIdArr)->get();
        $countries          = Country::where('status', 1)->get();

       return view('admin.'.self::$moduleConfig['viewFolder'].'.edit')->with('moduleConfig', self::$moduleConfig)->with('row', $row)->with('countries', $countries) ->with('userProfiles', $userProfiles);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(BankingDetailsRequest $request, $id){

        $this->__updateAccountDetails($request, $id);
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
        
        $row = BankingDetails::findOrFail($id);
        $row->delete();
        \Flash::success(self::$moduleConfig['moduleTitle'].' can\'t be deleted.'); 
        return \Redirect::route(self::$moduleConfig['routes']['listRoute']);
    }

}
