<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAccountDetail;
use App\Models\Country;
use App\Models\User;
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
        if (request('user_id')) {            
            return view('frontend.user_account_details.index');
        }
        else{
            return redirect()->route('dashboard');
        }
    }

    /**
     * Fetch data for datatable via ajax request for {{moduleTitle}}.
     *
     * @param  null
     * @return \Illuminate\Http\Response
     */

    public function fetchData(Request $request, UserAccountDetail $account)
    {
        $user           = User::find(request('user_id'));
        $userIdArr = User::where('email', $user->email)->pluck('id');

        $data               =   $request->all();

        $db_data            =   $account->getList($data, ['country'],[], $userIdArr);

        $count 				=  	$account->getListCount($data, [],[], $userIdArr);

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
    public function create(UserAccountDetail $account){

        $user            = User::findOrFail(request('user_id'));
        $countries          = Country::where('status', 1)->get();
        return view('frontend.user_account_details.create')
        ->with('countries', $countries)
        ->with('user', $user)
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
        return redirect()->route('user.account.details.index', ['user_id' => $request->user_id]);
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

        $countries          = Country::where('status', 1)->get();
        $row = UserAccountDetail::findOrFail($id);

        return view('frontend.user_account_details.edit')
        ->with('countries', $countries)
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
        return \Redirect::route('user.account.details.index', ['user_id' => $request->user_id]);
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
        return \Redirect::route('group.member.list');
    }

}
