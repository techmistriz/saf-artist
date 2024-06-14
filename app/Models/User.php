<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['actions'];

    public static $withoutAppends = false;

	public function setDobAttribute($value){
    	
    	if($value){
        	// $this->attributes['dob'] = Carbon::createFromFormat('d-M-Y', $value)->format('Y-m-d');
            $this->attributes['dob'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    	}
    }

    public function getDobAttribute($value){
    	
    	if($value){
    		return Carbon::createFromFormat('Y-m-d', $value)->format('d-M-Y');
    	}
    }

    public function setYearAttribute($value){
    	
    	$this->attributes['year'] = json_encode($value);
    }

    public function getYearAttribute($value){
    	
    	$v = json_decode($value) ?? [];
    	return !is_array($v) ? [] : $v;
    }

    public function getAge(){

    	if($this->attributes['dob']){
	    	return Carbon::now()->diff($this->attributes['dob'])->format('%y years');
    	}

    	return 0 . ' year';
	}

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function artistType()
    {
        return $this->belongsTo('App\Models\ArtistType', 'artist_type_id', 'id');
    }

    public function frontendRole()
    {
        return $this->belongsTo('App\Models\Role', 'frontend_role_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }

    public function festival()
    {
        return $this->belongsTo('App\Models\Festival', 'festival_id', 'id');
    }

    public function PACountry()
    {
        return $this->belongsTo('App\Models\Country', 'pa_country_id', 'id');
    }

    public function PAState()
    {
        return $this->belongsTo('App\Models\State', 'pa_state_id', 'id');
    }

    public function PACity()
    {
        return $this->belongsTo('App\Models\City', 'pa_city_id', 'id');
    }

    public function CACountry()
    {
        return $this->belongsTo('App\Models\Country', 'ca_country_id', 'id');
    }

    public function CAState()
    {
        return $this->belongsTo('App\Models\State', 'ca_state_id', 'id');
    }

    public function CACity()
    {
        return $this->belongsTo('App\Models\City', 'ca_city_id', 'id');
    }

    public function travelBoarding()
    {
        return $this->belongsTo('App\Models\TravelBoarding', 'travel_id', 'id')->with(['project', 'onwardCity', 'returnCity']);
    }

    public function getList($data, $with = [], $where = []){  

    	

        $records = $this->handleAjax($data);
        if(isset($with) && !empty($with))
        {
           $records->with($with);        
        }
        
        if(isset($where) && !empty($where))
        {
           $records->where($where);     
        }

        // Added for sequence number
        // $page               =   $data['pagination']['page'] ?? 1;
        // $page               =   $page - 1;
        // $perPage            =   $data['pagination']['perpage'] ?? 10;
        // $page               =   $page * $perPage;

        // \DB::select(\DB::raw('SET @row := '. $page));
        // $records->selectRaw('@row := @row + 1 as row, '.$this->getTable().'.*');
        // $records->from(\DB::raw(''.$this->getTable().', (SELECT @row := '.$page.') r'));
        // Added for sequence number
        
        if(!empty($data['query']['search'])){

        	$searchKey = $data['query']['search'];
         	$records->where(function($query) use ($searchKey){
                $query->where('name', 'LIKE', '%'.$searchKey.'%')
                      ->orWhere('email', 'LIKE', '%'.$searchKey.'%')
                      ->orWhere('contact', 'LIKE', '%'.$searchKey.'%');
            });
        }

        return $records->get();
    }

    public function getListCount($data, $with = [], $where = []){  

        $records = $this->query();
        if(isset($with) && !empty($with))
        {
           $records->with($with);        
        }
        
        if(isset($where) && !empty($where))
        {
           $records->where($where);     
        }

        if(!empty($data['query']['search'])){

        	$searchKey = $data['query']['search'];
         	$records->where(function($query) use ($searchKey){
                $query->where('name', 'LIKE', '%'.$searchKey.'%')
                      ->orWhere('email', 'LIKE', '%'.$searchKey.'%')
                      ->orWhere('contact', 'LIKE', '%'.$searchKey.'%');
            });
        }

        return $records->count();
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    }

    public function poc()
    {
      return $this->belongsTo('App\Models\User', 'poc_id', 'id');
    }

    /**
    *   Handle Ajax to set orderby and limit and offset
    *
    */
    function    handleAjax($data){

        $page               =   $data['pagination']['page'] ?? 0 ;
        $page               =   $page - 1;
        $perPage            =   $data['pagination']['perpage'] ?? 10;
        $page               =   $page * $perPage;

        $sort               =   $data['sort']['sort'] ?? 'desc';
        $field              =   $data['sort']['field'] ?? 'created_at';  


        return $this
                    ->orderby($field, $sort)
                    ->skip($page)
                    ->take($perPage);

        
    }

    public function getActionsAttribute() 
    {
        $profileMemberList = '';
        if (isset($this->frontendRole->name) && $this->frontendRole->name != 'Individual') {
            $profileMemberList = '
                <a href="' . route('admin.profile_member.index', ['user_id' => $this->id]) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Profile Member List">
                    <i class="flaticon2-avatar"></i>
                </a>';
        }

        return '
        <span style="overflow: visible; position: relative; width: 125px;" data-id="' . $this->id . '">
            <a href="show/' . $this->id . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Show details">
                <i class="flaticon-eye"></i>
            </a>
            <a href="edit/' . $this->id . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
                <i class="flaticon2-pen"></i>
            </a>
            <a href="' . route('admin.user_profile.index', ['user_id' => $this->id]) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="User profile list">
                <i class="flaticon2-user"></i>
            </a>
            ' . $profileMemberList . '
        </span>';
    }

    protected function getArrayableAppends()
    {
        if(self::$withoutAppends){
            return [];
        }
        return parent::getArrayableAppends();
    }

    public function sendPasswordResetNotification($token){

    	$user = new \stdClass();
    	$user->name = $this->name;
    	$user->reset_url = route('password.reset', ['token' => $token, 'email' => $this->email]);
    	\Mail::to($this->email)->send(new \App\Mail\ResetPasswordMailable($user));
    	
	}
	    
}
