<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfileMember;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Requests\ProfileMemberRequest;
use App\Imports\ProfileMemberImport;
use Maatwebsite\Excel\Facades\Excel;
use Hash;
use Image;
use Auth;
use ImageUploadHelper;

class ProfileMemberController extends Controller
{   
    

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

        return view('frontend.profile_member.index');
    }

    /**
     * Fetch data for datatable via ajax request for {{moduleTitle}}.
     *
     * @param  null
     * @return \Illuminate\Http\Response
     */

    public function fetchData(Request $request, ProfileMember $member)
    {
        $userId = Auth::user()->id;

        $data               =   $request->all();

        $db_data            =   $member->getList($data, ['poc'], ['poc_id'=> $userId]);

        $count 				=  	$member->getListCount($data,[], ['poc_id'=> $userId]);

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
    public function create(ProfileMember $member)
    {
        $userEmail = Auth::user()->email;
        $parents = User::where(['status' => 1, 'email' => $userEmail])->latest('project_year')->get();
        //dd($parents);
        return view('frontend.profile_member.create')->with('row', null)->with('parents', $parents);
    }

    /**
     * Create a new {{moduleTitle}}.
     *
     * @param  null
     * @return Redirect
     */
    

    public function store(ProfileMemberRequest $request)
    {

        $member                   = new ProfileMember();
        $member->name             = $request->name;
        $member->user_id          = Auth::user()->id;
        $member->profile_id       = $request->profile_id;
        $member->email            = $request->email;
        $member->contact          = $request->contact;
        $member->dob              = $request->dob;
        $member->room_sharing     = $request->room_sharing;
        $member->stage_name       = $request->stage_name;
        $member->artist_bio       = $request->artist_bio;
        $member->instagram_url    = $request->instagram_url;
        $member->facebook_url     = $request->facebook_url;
        $member->linkdin_url      = $request->linkdin_url;
        $member->twitter_url      = $request->twitter_url;
        $member->website          = $request->website;
        $member->status           = $request->input('status', 0);
        //dd($member);
        $member->save();

        \Flash::success('Profile member created successfully');
        return \Redirect::route('user.profile.show', $member->profile_id);
    }


    /**
     * Show show  form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id, ProfileMember $member){

        $row = ProfileMember::findOrFail($id);
        return view('frontend.profile_member.show ')->with('row', $row);
    }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, ProfileMember $member){

        $row = ProfileMember::findOrFail($id);
        //dd($row);
        return view('frontend.profile_member.edit')->with('row', $row);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(ProfileMemberRequest $request, $id){

        $member                  = ProfileMember::findOrFail($id);

        $member->user_id         = Auth::user()->id;
        $member->profile_id      = $request->profile_id;
        $member->name            = $request->name;
        $member->email           = $request->email;
        $member->contact         = $request->contact;
        $member->dob             = $request->dob;
        $member->room_sharing    = $request->room_sharing;
        $member->stage_name      = $request->stage_name;
        $member->artist_bio      = $request->artist_bio;
        $member->instagram_url   = $request->instagram_url;
        $member->facebook_url    = $request->facebook_url;
        $member->linkdin_url     = $request->linkdin_url;
        $member->twitter_url     = $request->twitter_url;
        $member->website         = $request->website;
        $member->status          = $request->input('status', 0);
        $member->save();

        \Flash::success('Profile member updated successfully.');
        return \Redirect::route('user.profile.show', $member->profile_id);
    }

    /**
     * Delete {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */

    public function delete($id)
    {
        
        $row = ProfileMember::findOrFail($id);
        $row->delete();
        \Flash::success('Profile member deleted successfully.'); 
        return back();
    }    

    public function import(Request $request) 
    {
        Excel::import(new ProfileMemberImport, $request->file('file'));
        
        flash('Profile members imported successfully from excel sheet.')->success();
        return redirect()->route('profile.member.create');
    }

}
