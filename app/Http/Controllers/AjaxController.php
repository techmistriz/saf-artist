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
use App\Models\City;
use App\Models\Project;
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
    
    public function getProject(Request $request)
    {

        $years 			= $request->input('year', '');
        $category_id 	= $request->input('category_id', '');
        $queryModel 	= Project::query();

        if(!empty($years)){
        	$queryModel->whereIn('year', explode(",", $years));
        }

        if(!empty($category_id)){
        	$queryModel->where('category_id', $category_id);
        }

        $results = $queryModel->get();

        if($results->count()) {
            return ['status' => true, 'message' => $years, 'data' => $results];
        }

        return response()->json([
            'status' => false,
            'message' => 'No data found.',
            'data' => new \stdClass()
        ]);
    }

    public function sendOtp(Request $request)
    {
        try {
            $validation = \Validator::make($request->all(), [
                'contact' => 'required|digits:10',
            ]);

            if ($validation->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validation->errors()->first(),
                    'data' => new \stdClass()
                ]);
            }

            $contact = $request->contact;
            $otp = mt_rand(100000, 999999);
            Session::put('otp', $otp);
            Session::put('contact', $contact);

            return response()->json(['success' => true, 'message' => 'OTP Sent Successfully', 'otp' => $otp]);
            
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong.']);
        }
    }


}
