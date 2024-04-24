<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class User extends Authenticatable implements MustVerifyEmail
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

    protected $appends = ['actions', 'category_actions', 'account_actions', 'ticket_actions', 'hotel_actions'];

    public static $withoutAppends = false;

	public function setDobAttribute($value){
    	
    	if($value){
        	$this->attributes['dob'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    	}
    }

    public function getDobAttribute($value){
    	
    	if($value){
    		return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
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

    	$userDisciplineIds = \Auth::user()->getUserDisciplineIds();

        $records = $this->handleAjax($data);
        if(isset($with) && !empty($with))
        {
           $records->with($with);        
        }
        
        if(isset($where) && !empty($where))
        {
           $records->where($where);     
        }

        if($userDisciplineIds !== true && is_array($userDisciplineIds)) {
        	$records->whereIn('category_id', $userDisciplineIds);
        }

        // Added for sequence number
        $page               =   $data['pagination']['page'] ?? 1;
        $page               =   $page - 1;
        $perPage            =   $data['pagination']['perpage'] ?? 10;
        $page               =   $page * $perPage;

        \DB::select(\DB::raw('SET @row := '. $page));
        $records->selectRaw('@row := @row + 1 as row, '.$this->getTable().'.*');
        $records->from(\DB::raw(''.$this->getTable().', (SELECT @row := '.$page.') r'));
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

    function getActionsAttribute(){
    
    	$view = '<a href="show/'.$this->id.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Show details">
                   <i class="flaticon-eye"></i>
                </a>';
        $edit = '<a href="edit/'.$this->id.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit personal details">
                   <i class="flaticon2-pen"></i>
                </a>';	

        $rolePermission = session('rolePermission');

    	if( !array_key_exists('view', ($rolePermission['permissions']['UserController'] ?? []))){

    		$view = '';
    	}

    	if( !array_key_exists('edit', ($rolePermission['permissions']['UserController'] ?? []))){

    		$edit = '';
    	}

        return '<span class="overflow: visible; position: relative; width: 125px;" data-id="'.$this->id.'">
                '.$view.$edit.'
           	</span>';
    }

    function getCategoryActionsAttribute(){
    	
       	$view = '<a href="show-category-details/'.$this->id.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Show displine details">
                   <i class="flaticon-eye"></i>
                </a>';
        $edit = '<a href="edit-category-details/'.$this->id.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit displine details">
                   <i class="flaticon2-pen"></i>
                </a>';	

        $rolePermission = session('rolePermission');
        
    	if( !array_key_exists('view', ($rolePermission['permissions']['UserController'] ?? []))){

    		$view = '';
    	}

    	if( !array_key_exists('edit', ($rolePermission['permissions']['UserController'] ?? []))){

    		$edit = '';
    	}

        return '<span class="overflow: visible; position: relative; width: 125px;" data-id="'.$this->id.'">
                '.$view.$edit.'
           	</span>';

    }

    function getAccountActionsAttribute(){

       	$view = '<a href="show-account-details/'.$this->id.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Show Banking details">
                   <i class="flaticon-eye"></i>
                </a>';
        $edit = '<a href="edit-account-details/'.$this->id.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit Banking details">
                   <i class="flaticon2-pen"></i>
                </a>';	

        $rolePermission = session('rolePermission');
        
    	if( !array_key_exists('view', ($rolePermission['permissions']['UserController'] ?? []))){

    		$view = '';
    	}

    	if( !array_key_exists('edit', ($rolePermission['permissions']['UserController'] ?? []))){

    		$edit = '';
    	}

        return '<span class="overflow: visible; position: relative; width: 125px;" data-id="'.$this->id.'">
                '.$view.$edit.'
           	</span>';

    }

    function getTicketActionsAttribute(){

        $view = '<a href="' . route('admin.ticket_booking.show', $this->id) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Show ticket booking details">
                   <i class="flaticon-eye"></i>
                </a>';
        $edit = '<a href="' . route('admin.ticket_booking.edit', $this->id) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit ticket booking details">
                    <i class="flaticon2-pen"></i>
                </a>';  

        $rolePermission = session('rolePermission');
        
        if( !array_key_exists('view', ($rolePermission['permissions']['UserController'] ?? []))){

            $view = '';
        }

        if( !array_key_exists('edit', ($rolePermission['permissions']['UserController'] ?? []))){

            $edit = '';
        }

        return '<span class="overflow: visible; position: relative; width: 125px;" data-id="'.$this->id.'">
                '.$view.$edit.'
            </span>';

    }

    function getHotelActionsAttribute(){

        $view = '<a href="' . route('admin.hotel_booking.show', $this->id) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Show hotel booking details">
                   <i class="flaticon-eye"></i>
                </a>';
        $edit = '<a href="' . route('admin.hotel_booking.edit', $this->id) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit hotel booking details">
                    <i class="flaticon2-pen"></i>
                </a>';  

        $rolePermission = session('rolePermission');
        
        if( !array_key_exists('view', ($rolePermission['permissions']['UserController'] ?? []))){

            $view = '';
        }

        if( !array_key_exists('edit', ($rolePermission['permissions']['UserController'] ?? []))){

            $edit = '';
        }

        return '<span class="overflow: visible; position: relative; width: 125px;" data-id="'.$this->id.'">
                '.$view.$edit.'
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
