<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\UserCategoryDetail;
use App\Models\UserAccountDetail;
use App\Models\Category;
use App\Models\AddressProof;
use App\Models\User;
use App\Models\TravelBoarding;
use Carbon\Carbon;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserCategoryDetailsRequest;
use App\Http\Requests\UserAccountDetailsRequest;
use DB;
use Hash;
use Image;
use Auth;
use ImageUploadHelper;
use FileUploadHelper;

trait TravelBoardingTrait
{
	/**
     * Update a {{moduleTitle}}.
     *
     * @param  $id
     * @return Redirect
     */
    public function __updateTravelBoarding(Request $request, $user_id = NULL) {

    	if(empty($user_id)){

    		$user_id 									= \Auth::user()->id;
    		$travelBoarding 							= TravelBoarding::where( "user_id", $user_id)->first();
    		
    	} else {
    		
    		$travelBoarding 							= TravelBoarding::where( "user_id", $user_id)->first();

    		if(empty($travelBoarding)){

    			$travelBoarding = new TravelBoarding();
    		}
    	}

    	$user = User::find($user_id);

    	$travelBoarding->user_id = $user_id;
    	
    	if($request->has('project_name') && $request->filled('project_name')) {
	    	$travelBoarding->project_name = $request->project_name;
	    }

    	if($request->has('cost_center') && $request->filled('cost_center')) {
	    	$travelBoarding->cost_center = $request->cost_center;
	    }

    	if($request->has('prog_manager') && $request->filled('prog_manager')) {
	    	$travelBoarding->prog_manager = $request->prog_manager;
	    }

    	if($request->has('poc2') && $request->filled('poc2')) {
	    	$travelBoarding->poc2 = $request->poc2;
	    }

    	if($request->has('salutation') && $request->filled('salutation')) {
	    	$travelBoarding->salutation = $request->salutation;
	    }

    	if($request->has('name') && $request->filled('name')) {
	    	$travelBoarding->name = $request->name;
	    }

    	if($request->has('age') && $request->filled('age')) {
	    	$travelBoarding->age = $request->age;
	    }

    	if($request->has('contact') && $request->filled('contact')) {
	    	$travelBoarding->contact = $request->contact;
	    }

    	if($request->has('email') && $request->filled('email')) {
	    	$travelBoarding->email = $request->email;
	    }

    	if($request->has('mode_of_travel') && $request->filled('mode_of_travel')) {
	    	$travelBoarding->mode_of_travel = $request->mode_of_travel;
	    }

    	if($request->has('onward_city_id') && $request->filled('onward_city_id')) {
	    	$travelBoarding->onward_city_id = $request->onward_city_id;
	    }

    	if($request->has('onward_city_other') && $request->filled('onward_city_other')) {
	    	$travelBoarding->onward_city_other = $request->onward_city_other;
	    }

    	if($request->has('date_of_travel') && $request->filled('date_of_travel')) {
	    	$travelBoarding->date_of_travel = $request->date_of_travel;
	    }

    	if($request->has('preferred_time_to_reach_goa') && $request->filled('preferred_time_to_reach_goa')) {
	    	$travelBoarding->preferred_time_to_reach_goa = $request->preferred_time_to_reach_goa;
	    }

    	if($request->has('preferred_flight_train_no_to_reach_goa') && $request->filled('preferred_flight_train_no_to_reach_goa')) {
	    	$travelBoarding->preferred_flight_train_no_to_reach_goa = $request->preferred_flight_train_no_to_reach_goa;
	    }

    	if($request->has('return_city_id') && $request->filled('return_city_id')) {
	    	$travelBoarding->return_city_id = $request->return_city_id;
	    }

    	if($request->has('return_city_other') && $request->filled('return_city_other')) {
	    	$travelBoarding->return_city_other = $request->return_city_other;
	    }

    	if($request->has('return_date') && $request->filled('return_date')) {
	    	$travelBoarding->return_date = $request->return_date;
	    }

    	if($request->has('preferred_time_to_leave_goa') && $request->filled('preferred_time_to_leave_goa')) {
	    	$travelBoarding->preferred_time_to_leave_goa = $request->preferred_time_to_leave_goa;
	    }

    	if($request->has('preferred_flight_train_no_to_leave_goa') && $request->filled('preferred_flight_train_no_to_leave_goa')) {
	    	$travelBoarding->preferred_flight_train_no_to_leave_goa = $request->preferred_flight_train_no_to_leave_goa;
	    }

    	if($request->has('excess_luggage_in_kgs') && $request->filled('excess_luggage_in_kgs')) {
	    	$travelBoarding->excess_luggage_in_kgs = $request->excess_luggage_in_kgs;
	    }

    	if($request->has('artist_remarks') && $request->filled('artist_remarks')) {
	    	$travelBoarding->artist_remarks = $request->artist_remarks;
	    }

    	if($request->has('poc_remarks') && $request->filled('poc_remarks')) {
	    	$travelBoarding->poc_remarks = $request->poc_remarks;
	    }

    	if($request->has('accomodation') && $request->filled('accomodation')) {
	    	$travelBoarding->accomodation = $request->accomodation;
	    }

    	if($request->has('room_type') && $request->filled('room_type')) {
	    	$travelBoarding->room_type = $request->room_type;
	    }

    	if($request->has('check_in_date') && $request->filled('check_in_date')) {
	    	$travelBoarding->check_in_date = $request->check_in_date;
	    }

    	if($request->has('check_out_date') && $request->filled('check_out_date')) {
	    	$travelBoarding->check_out_date = $request->check_out_date;
	    }

    	if($request->has('total_room_nights') && $request->filled('total_room_nights')) {
	    	$travelBoarding->total_room_nights = $request->total_room_nights;
	    }

    	if($request->has('hotel_artist_remarks') && $request->filled('hotel_artist_remarks')) {
	    	$travelBoarding->hotel_artist_remarks = $request->hotel_artist_remarks;
	    }

    	if($request->has('hotel_poc_remarks') && $request->filled('hotel_poc_remarks')) {
	    	$travelBoarding->hotel_poc_remarks = $request->hotel_poc_remarks;
	    }

    	if($request->has('airport_transfer') && $request->filled('airport_transfer')) {
	    	$travelBoarding->airport_transfer = $request->airport_transfer;
	    }

    	if($request->has('airport_drop_required_date') && $request->filled('airport_drop_required_date')) {
	    	$travelBoarding->airport_drop_required_date = $request->airport_drop_required_date;
	    }

    	if($request->has('no_of_dedicated_cab') && $request->filled('no_of_dedicated_cab')) {
	    	$travelBoarding->no_of_dedicated_cab = $request->no_of_dedicated_cab;
	    }

    	if($request->has('dedicated_cab_required_starting_date') && $request->filled('dedicated_cab_required_starting_date')) {
	    	$travelBoarding->dedicated_cab_required_starting_date = $request->dedicated_cab_required_starting_date;
	    }

    	if($request->has('dedicated_cab_required_end_date') && $request->filled('dedicated_cab_required_end_date')) {
	    	$travelBoarding->dedicated_cab_required_end_date = $request->dedicated_cab_required_end_date;
	    }

    	if($request->has('group_poc_name') && $request->filled('group_poc_name')) {
	    	$travelBoarding->group_poc_name = $request->group_poc_name;
	    }

    	if($request->has('group_poc_whatsapp_number') && $request->filled('group_poc_whatsapp_number')) {
	    	$travelBoarding->group_poc_whatsapp_number = $request->group_poc_whatsapp_number;
	    }

    	if($request->has('ground_transport_artist_remarks') && $request->filled('ground_transport_artist_remarks')) {
	    	$travelBoarding->ground_transport_artist_remarks = $request->ground_transport_artist_remarks;
	    }

    	if($request->has('ground_transport_poc_remarks') && $request->filled('ground_transport_poc_remarks')) {
	    	$travelBoarding->ground_transport_poc_remarks = $request->ground_transport_poc_remarks;
	    }
	    
    	$travelBoarding->save();

    	$user->travel_id = $travelBoarding->id;
    	$user->save();
    }

}