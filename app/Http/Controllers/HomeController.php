<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Category;
use App\Models\AddressProof;
use App\Models\Curator;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\ArtistType;
use App\Traits\UserTrait;
use Carbon\Carbon;
use App\Http\Requests\UserRegisterRequest;

use DB;
use Hash;
use Image;
use ImageUploadHelper;
use FileUploadHelper;

class HomeController extends Controller
{

    use UserTrait;

    public static $moduleConfig = [
        "imageUploadFolder" => 'uploads/users/',
    ];
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $frontendRoles = Role::where(['status' => 1, 'type' => 2])->get();
        $categories     = Category::where('status', 1)->get();
        $addressProofs  = AddressProof::where('status', 1)->get();
        $countries      = Country::where('status', 1)->whereNotNull('code')->get();
        $artistTypes    = ArtistType::where('status', 1)->get();
        $curators       = Curator::where('status', 1)->get();

        return view('home')->with(['row' => null, 'categories' => $categories, 'addressProofs' => $addressProofs, 'years' => $this->years, 'countries' => $countries, 'artistTypes' => $artistTypes, 'curators' => $curators,'frontendRoles' => $frontendRoles]);
    }

    public function register(UserRegisterRequest $request) {

        $password                       = uniqid();
        $user                           = new User();
        $user->name                     = $request->name;
        $user->email                    = $request->email;
        $user->contact                  = $request->contact;
        $user->artist_type_id           = $request->artist_type_id;
        $user->curator_name             = $request->curator_name;
        $user->category_id              = $request->category_id;
        $user->frontend_role_id         = $request->frontend_role_id;
        $user->password                 = Hash::make($password);
        $user->password_plane           = \Helper::encrypt($password);
        $user->save();
        
        try {
            
            $user->password_plane            = $password;
            \Mail::to($user->email)->send(new \App\Mail\RegisterMailable($user));

            // $user->sendEmailVerificationNotification();

        } catch (Exception $e) {
            
        }

        // \Auth::loginUsingId($user->id);
        // \Flash::success('Please click on the link sent to your email account to verify you email and continue the registration process.');
        \Flash::success('Your registration completed successfully.');
        return \Redirect::route('login');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function terms()
    {
        
    }


}
