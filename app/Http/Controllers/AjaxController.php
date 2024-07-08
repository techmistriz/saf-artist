<?php

namespace App\Http\Controllers;

use DB;
use Input;
use Form;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\TicketBooking;
use App\Models\ProfileMember;
use App\Models\HotelBooking;
use App\Models\City;
use App\Models\Project;
use App\Models\Festival;
use App\Models\ShareRoom;
use App\Models\Pincode;
use App\Models\UserTemp;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function getCountry(Request $request)
    {

        $queryModel = State::query();
        $queryModel->where('status', 1);

        $results = $queryModel->get();

        if($results->count()) {
            return ['status' => true, 'message' => 'Record found.', 'data' => $results];
        }

        return response()->json([
            'status' => false,
            'message' => 'No data found.',
            'data' => new \stdClass()
        ]);
    }
    
    public function getState(Request $request, $country_id = NULL)
    {

        $queryModel = State::query();
        $queryModel->where('status', 1);

        if(!empty($country_id)){
            $queryModel->where('country_id', $country_id);
        }

        $results = $queryModel->get();

        if($results->count()) {
            return ['status' => true, 'message' => 'Record found.', 'data' => $results];
        }

        return response()->json([
            'status' => false,
            'message' => 'No data found.',
            'data' => new \stdClass()
        ]);
    }
    
    public function getCity(Request $request, $state_id = NULL)
    {

        $queryModel = City::query();
        $queryModel->where('status', 1);

        if(!empty($state_id)){
            $queryModel->whereIn('state_id', [$state_id, 0]);

            /*$queryModel->where(function($query) use ($state_id){
                $query->where('state_id', $state_id);
                $query->where('state_id', 0);
            });*/
        }

        $results = $queryModel->get();

        if($results->count()) {
            return ['status' => true, 'message' => 'Record found.', 'data' => $results];
        }

        return response()->json([
            'status' => false,
            'message' => 'No data found.',
            'data' => new \stdClass()
        ]);
    }
    
    public function getFestival(Request $request, $id = NULL)
    {
        $queryModel = \App\Models\Festival::query();
        $queryModel->where('status', 1);

        if(!empty($request->year)){
            $queryModel->where('year', $request->year);
        }
        if (empty($request->festival_id)) {
            $user_email = Auth::user()->email;
            $festivalIdArr = UserProfile::where('status', 1)->where('email', $user_email)->whereNotNull('festival_id')->get()->pluck('festival_id');
            //dd($festival_ids);

            // $festivalId = [];
            // foreach ($users as $user){
            //     $festivalId[] = $user->festival_id;
            // }

            if (!empty($festivalIdArr)) {
                $queryModel->whereNotIn('id', $festivalIdArr);
            }
        }        

        $results = $queryModel->get();
        if($results) {
            return ['status' => true, 'message' => 'Record found.', 'data' => $results];
        }

        return response()->json([
            'status' => false,
            'message' => 'No data found.',
            'data' => new \stdClass()
        ]);
    }

    public function getProfileMemberHotel(Request $request, $id = NULL)
    {
        $queryModel = \App\Models\ProfileMember::query();
        $queryModel->where('status', 1);

        if(!empty($request->profile_id)){
            $queryModel->where('profile_id', $request->profile_id);
        }
        if (empty($request->profile_member_id)) {

            $profileMemberIdArr = HotelBooking::where('status', 1)->where('profile_id', $request->profile_id)->whereNotNull('profile_member_ids')->get()->pluck('profile_member_id');

            if (!empty($profileMemberIdArr)) {
                $queryModel->whereNotIn('id', $profileMemberIdArr);
            }
        }        

        $results = $queryModel->get();
        if($results) {
            return ['status' => true, 'message' => 'Record found.', 'data' => $results];
        }

        return response()->json([
            'status' => false,
            'message' => 'No data found.',
            'data' => new \stdClass()
        ]);
    }

    public function getProfileMemberTicket(Request $request, $id = NULL)
    {
        $queryModel = \App\Models\ProfileMember::query();
        $queryModel->where('status', 1);

        if(!empty($request->profile_id)){
            $queryModel->where('profile_id', $request->profile_id);
        }
        if (empty($request->profile_member_id)) {

            $profileMemberIdArr = TicketBooking::where('status', 1)->where('profile_id', $request->profile_id)->whereNotNull('profile_member_ids')->get()->pluck('profile_member_id');

            if (!empty($profileMemberIdArr)) {
                $queryModel->whereNotIn('id', $profileMemberIdArr);
            }
        }        

        $results = $queryModel->get();
        if($results) {
            return ['status' => true, 'message' => 'Record found.', 'data' => $results];
        }

        return response()->json([
            'status' => false,
            'message' => 'No data found.',
            'data' => new \stdClass()
        ]);
    }

    public function getProject(Request $request, $festival_id = NULL)
    {

        $queryModel = \App\Models\Project::query();
        $queryModel->where('status', 1);

        if(!empty($festival_id)){
            $queryModel->where('festival_id', $festival_id);
        }

        $results = $queryModel->get();

        if($results->count()) {
            return ['status' => true, 'message' => 'Record found.', 'data' => $results];
        }

        return response()->json([
            'status' => false,
            'message' => 'No data found.',
            'data' => new \stdClass()
        ]);
    }  

    public function sendOtp234(Request $request)
    {
        $validation = \Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validation->errors()->first(),
                'data' => new \stdClass()
            ]);
        }

        $userByEmail = \App\Models\User::where('email', $request->email)->first();
        
        if (!empty($userByEmail)) {
            return response()->json([
                'status' => false,
                'message' => "A visitor profile already exists with the same Email ID. Please use a different Email ID.",
                'data' => new \stdClass()
            ]);
        }

        $otp = \App\Helpers\Helper::generateOtp();

        $user = new \stdClass();
        $user->name = $request->name ?? 'User';
        $user->otp = $otp;

        \Mail::to($request->email)->send(new \App\Mail\RegisterOTPMailable($user));

        return response()->json([
            'status' => true,
            'message' => 'An OTP has been shared on your email ID.',
            'data' => new \stdClass()
        ]);
    }

    public function sendOtp(Request $request)
    {
        $validation = \Validator::make($request->all(), [
            'email'                 => 'required|email',
            'contact'               => 'required',
        ]);

        $errors = $validation->errors();

        if(count($errors) > 0){

            return response()->json([
                'status'    => false,
                'message'   => $errors->first(),
                'data'      => new \stdClass()
            ]);
        }

        $user           = \App\Models\User::where('contact', $request->contact)->first();
        //dd($user);
        
        if( !empty($user) ){

            return response()->json([
                'status'    => false,
                'message'   => "A visitor profile already exists with the same phone number / Email Id Please use a different phone number and Email ID.",
                'data'      => new \stdClass()
            ]);
        }

        $userByEmail    = \App\Models\User::where('email', $request->email)->first();
        
        if( !empty($userByEmail) ){

            return response()->json([
                'status'    => false,
                'message'   => "A visitor profile already exists with the same phone number / Email Id Please use a different phone number and Email ID.",
                'data'      => new \stdClass()
            ]);
            
        }

        $otp        = \App\Helpers\Helper::generateOtp();
        $contact = '+91' . $request->contact; 
        // dd($contact);
        $time       = time();

        $userTemp = UserTemp::where('contact', $request->contact)->first();
        
        if($userTemp){

            if( (time() - $userTemp->otp_time) < 60 ){

                return response()->json([
                    'status' => false,
                    'message' => 'You can not request another OTP within 60 seconds.',
                    'data' => new \stdClass()
                ]);
            }

            // if($userTemp->counter >= 5 && (time() - $userTemp->otp_time) < 7200){

            //     return response()->json([
            //         'status' => false,
            //         'message' => 'You can not request more than 5 OTP within 2 hours',
            //         'data' => (time() - $userTemp->otp_time)
            //     ]);
            // }

            $userTemp->counter  = $userTemp->counter + 1;
            $userTemp->otp      = $otp;
            $userTemp->otp_time = $time;

        } else {

            $userTemp           = new UserTemp();
            $userTemp->counter  = 1;
            $userTemp->contact  = $request->contact;
            $userTemp->otp      = $otp;
            $userTemp->otp_time = $time;
        }

        $userTemp->save();

        $status = \App\Notifications\WhatsappNotification::sendRegistrationOTP($contact, $otp);
        $user = $userTemp;
        $user->name = $request->name ?? 'User';
        \Mail::to($request->email)->send(new \App\Mail\RegisterOTPMailable($user));

        if($status !== false){

            return response()->json([
                'status' => true,
                'message' => 'An OTP has been shared on your email id and whatsapp number',
                'data' => new \stdClass()
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Something went wrong!',
            'data' => new \stdClass()
        ]);
    }

    public function getMember(Request $request, $member_id = NULL)
    { 

        $validation = \Validator::make($request->all(), [
            // 'name' => 'required',
        ]);

        $errors = $validation->errors();

        if(count($errors) > 0){

            return response()->json([
                'status'    => false,
                'message'   => $errors->first(),
                'data'      => new \stdClass()
            ]);
        }


        if (!$request->has('member_id') || !$request->filled('member_id')) {
            return ['status' => false, 'message' => 'Member Id not found.', 'data' => null];
        }
        $queryModel = User::query();

        if ($request->has('member_id') && $request->filled('member_id')) {
            $queryModel->where('id', $request->member_id);
        }

        $results = $queryModel->get();
        // dd($results);
        if(!empty($results)) {
            return ['status' => true, 'message' => 'Record found.', 'data' => $results];
        }
    }

    public function deleteShareRoom(Request $request, $id = NULL)
    {

        $row = ShareRoom::find($id);

        if($row) {
            
            $row->delete();
            return ['status' => true, 'message' => 'Record deleted successfully.', 'data' => null];
        }

        return response()->json([
            'status' => false,
            'message' => 'Record counld not deleted.',
            'data' => new \stdClass()
        ]);
    }

    public function getUserDetails(Request $request,$profile_id = NULL)
    { 

        if (!$request->has('profile_id') || !$request->filled('profile_id')) {
            return ['status' => false, 'message' => 'User Id not found.', 'data' => null];
        }
        $queryModel = UserProfile::query();

        if ($request->has('profile_id') && $request->filled('profile_id')) {
            $queryModel->where('id', $request->profile_id);
        }

        $results = $queryModel->get();
        //dd($results);
        if(!empty($results)) {
            return ['status' => true, 'message' => 'Record found.', 'data' => $results];
        }
    }


    // public function getPincodeDate(Request $request, $pincode = NULL)
    // { 
    //     $validation = \Validator::make($request->all(), [
    //         // 'name' => 'required',
    //     ]);

    //     $errors = $validation->errors();

    //     if(count($errors) > 0){

    //         return response()->json([
    //             'status'    => false,
    //             'message'   => $errors->first(),
    //             'data'      => new \stdClass()
    //         ]);
    //     }


    //     if (!$request->has('pincode') || !$request->filled('pincode')) {
    //         return ['status' => false, 'message' => 'Member Id not found.', 'data' => null];
    //     }
    //     $queryModel = Pincode::query();

    //     if ($request->has('pincode') && $request->filled('pincode')) {
    //         $queryModel->where('pincode', $request->pincode);
    //     }

    //     $results = $queryModel->get();
    //     //dd($results);
    //     if(!empty($results)) {
    //         return ['status' => true, 'message' => 'Record found.', 'data' => $results];
    //     }
    // }


}
