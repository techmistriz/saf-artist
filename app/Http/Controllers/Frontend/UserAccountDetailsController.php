<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAccountDetail;
use App\Models\Country;
use App\Models\UserProfile;
use App\Models\User;
use App\Models\Festival;
use Carbon\Carbon;
use App\Http\Requests\UserAccountDetailsRequest;
use Hash;
use Image;
use Auth;
use ImageUploadHelper;
use App\Traits\UserTrait;

class UserAccountDetailsController extends Controller
{   
    
    use UserTrait;

    public static $moduleConfig = [
        "imageUploadFolder" => 'uploads/users/',
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
        return view('frontend.user_account_details.index');
    }

    /**
     * Fetch data for datatable via ajax request for {{moduleTitle}}.
     *
     * @param  null
     * @return \Illuminate\Http\Response
     */

    public function fetchData(Request $request, UserAccountDetail $account)
    {        
        $userId   = Auth::user()->id;
        $data     = $request->all();
        
        // UserProfile::$withoutAppends = true;
        // Festival::$withoutAppends = true;

        $db_data  = $account->getList($data, ['profile', 'profile.festival'],['user_id' => $userId]);

        $count    = $account->getListCount($data, [],['user_id' => $userId]);

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
    public function create(UserAccountDetail $account)
    {

        $userIdArr = UserAccountDetail::where('status', 1)->whereNotNull('profile_id')->get()->pluck('profile_id');
        // dd($userIdArr);
        $userEmail     = Auth::user()->email;
        $userProfiles         = UserProfile::where('status', 1)->where('email', $userEmail)->whereNotIn('id', $userIdArr)->get();       
        $countries     = Country::where('status', 1)->get();
        return view('frontend.user_account_details.create')
        ->with('countries', $countries)
        ->with('userProfiles', $userProfiles)
        ->with('row', null);
    }

    /**
     * Create a new {{moduleTitle}}.
     *
     * @param  null
     * @return Redirect
     */
    

    public function store(UserAccountDetailsRequest $request)
    {
        
        $this->__storeAccountDetails($request);

        \Flash::success('Your account details created successfully.');
        return redirect()->route('user.account.details.index');
    }


    /**
     * Show show  form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id, UserAccountDetail $account){

        $row = UserAccountDetail::findOrFail($id);
        return view('frontend.user_account_details.show ')->with('row', $row);
    }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, UserAccountDetail $account){
        $row = UserAccountDetail::findOrFail($id);
        $userIdArr = UserAccountDetail::where('status', 1)->whereNotIn('profile_id', [$row->profile_id])->get()->pluck('profile_id');
        // dd($userIdArr);
        $userEmail     = Auth::user()->email;
        $userProfiles         = UserProfile::where('status', 1)->where('email', $userEmail)->whereNotIn('id', $userIdArr)->get();
        $countries          = Country::where('status', 1)->get();

        return view('frontend.user_account_details.edit')
        ->with('countries', $countries)
        ->with('userProfiles', $userProfiles)
        ->with('row', $row);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(UserAccountDetailsRequest $request, $id){

        $this->__updateAccountDetails($request, $id);
        \Flash::success('Your account details updated successfully.');
        return \Redirect::route('user.account.details.index');
    }

    /**
     * Delete {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */

    public function delete($id)
    {
        
        $row = UserAccountDetail::findOrFail($id);
        $row->delete();
        \Flash::success('Group member deleted successfully.'); 
        return \Redirect::route('user.account.details.index');
    }

}
