<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GroupMember;
use Carbon\Carbon;
use App\Http\Requests\GroupMemberRequest;
use Hash;
use Image;
use Auth;
use ImageUploadHelper;

class GroupMemberController extends Controller
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

        return view('frontend.group_member.index');
    }

    /**
     * Fetch data for datatable via ajax request for {{moduleTitle}}.
     *
     * @param  null
     * @return \Illuminate\Http\Response
     */

    public function fetchData(Request $request, GroupMember $member)
    {
        
        $data               =   $request->all();

        $db_data            =   $member->getList($data,['poc']);

        $count 				=  	$member->getListCount($data);

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
    public function create(GroupMember $member){

        return view('frontend.group_member.create')->with('row', null);
    }

    /**
     * Create a new {{moduleTitle}}.
     *
     * @param  null
     * @return Redirect
     */
    

    public function store(GroupMemberRequest $request)
    {
        $pocId = Auth::user()->id;
        $allowMember = Auth::user()->max_allowed_member;
        $existingMembersCount = GroupMember::where('poc_id', $pocId)->count();
        if ($existingMembersCount >= $allowMember) {
            \Flash::error('You have allowed to add only'. ' '. $allowMember. ' '. 'members.');
            return \Redirect::back()->withInput();
        }

        $member = new GroupMember();
        $member->name = $request->name;
        $member->poc_id = $pocId;
        $member->email = $request->email;
        $member->contact = $request->contact;
        $member->dob = $request->dob;
        $member->status = $request->input('status', 0);
        $member->save();

        \Flash::success('Group member created successfully');
        return \Redirect::route('group.member.list');
    }


    /**
     * Show show  form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id, GroupMember $member){

        $row = GroupMember::findOrFail($id);
        return view('frontend.group_member.show ')->with('row', $row);
    }

    /**
     * Show edit form of {{moduleTitle}}.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, GroupMember $member){

        $row = GroupMember::findOrFail($id);
        return view('frontend.group_member.edit')->with('row', $row);
    }

    /**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function update(GroupMemberRequest $request, $id){

        $member                  = GroupMember::findOrFail($id);
        $member->name            = $request->name;
        $member->poc_id          = Auth::user()->id;
        $member->email           = $request->email;
        $member->contact         = $request->contact;
        $member->dob             = $request->dob;
        $member->status          = $request->input('status', 0);
        $member->save();

        \Flash::success('Group member updated successfully.');
        return \Redirect::route('group.member.list');
    }

    /**
     * Delete {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */

    public function delete($id)
    {
        
        $row = GroupMember::findOrFail($id);
        $row->delete();
        \Flash::success('Group member deleted successfully.'); 
        return \Redirect::route('group.member.list');
    }

}
