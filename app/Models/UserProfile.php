<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use App\Models\Common\MasterModel;

class UserProfile extends MasterModel 
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];    

    protected $appends = ['actions', 'frontend_actions'];

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

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
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
                ->orWhere('contact', 'LIKE', '%'.$searchKey.'%')
                ->orWhereHas('user', function ($query) use ($searchKey) {
                  $query->where('name', 'LIKE', '%'.$searchKey.'%');
               });
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
                ->orWhere('contact', 'LIKE', '%'.$searchKey.'%')
                ->orWhereHas('user', function ($query) use ($searchKey) {
                  $query->where('name', 'LIKE', '%'.$searchKey.'%');
               });
            });
        }

        return $records->count();
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

    public function getFrontendActionsAttribute()
    {
        $user = auth()->user();
        $addMemberButton = '';

        if (isset($user->frontendRole->name) && ($user->frontendRole->name != 'Individual')) {
            $addMemberButton = '
                <a href="' . route('profile.member.create', ['profile_id' => $this->id]) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Add member">
                    <i class="flaticon2-avatar"></i>
                </a>';
        }

        $editDetailButton = '';
        if ($this->profile_status == 1) {
            $editDetailButton = '
                <a href="' . route('user.profile.edit', $this->id) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
                    <i class="flaticon2-pen"></i>
                </a>';
        }

        return '
            <span style="overflow: visible; position: relative; width: 125px;" data-id="' . $this->id . '">
                <a href="' . route('user.profile.show', $this->id) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Show details">
                    <i class="flaticon-eye"></i>
                </a>'
                . $editDetailButton .
                $addMemberButton . 
            '</span>';
    }

    function getActionsAttribute(){
   
      return '<span class="overflow: visible; position: relative; width: 125px;" data-id="'.$this->id.'">
         <a href="show/'.$this->id.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Show details">
            <i class="flaticon-eye"></i>
         </a>
         <a href="edit/'.$this->id.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit user profile">
            <i class="flaticon2-pen"></i>
         </a> 
         <a href="' . route('admin.banking_details.index', ['profile_id' => $this->id]) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Banking detail list">
            <i class="la la-bank  icon-xl"></i>
         </a> 
         <a href="' . route('admin.ticket_booking.index', ['profile_id' => $this->id]) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Ticket booking list">
            <i class="la la-ticket  icon-xl"></i>
         </a> 
         <a href="' . route('admin.hotel_booking.index', ['profile_id' => $this->id]) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Hotel booking list">
            <i class="la la-hotel  icon-xl"></i>
         </a>         
      </span>';
    }
	    
}
