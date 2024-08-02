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

    protected $appends = ['actions', 'frontend_actions', 'banking_status', 'ticket_status', 'hotel_status'];

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
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }

    public function PAState()
    {
        return $this->belongsTo('App\Models\State', 'state_id', 'id');
    }

    public function PACity()
    {
        return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }

    public function curator()
    {
        return $this->belongsTo('App\Models\Curator', 'curator_id', 'id');
    }

    public function getList($data, $with = [], $where = [], $whereNotIn = [])
{  
    $records = $this->handleAjax($data);

    if (isset($with) && !empty($with)) {
        $records->with($with);        
    }
    
    if (isset($where) && !empty($where)) {
        $records->where($where);     
    }

    if (isset($whereNotIn) && !empty($whereNotIn)) {
        foreach ($whereNotIn as $key => $values) {
            $records->whereNotIn($key, $values);     
        }
    }

    if (!empty($data['query']['search'])) {
        $searchKey = $data['query']['search'];
        $records->where(function($query) use ($searchKey) {
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


    public function getListCount($data, $with = [], $where = [], $whereNotIn = []){  

        $records = $this->query();
        if(isset($with) && !empty($with))
        {
           $records->with($with);        
        }
        
        if(isset($where) && !empty($where))
        {
           $records->where($where);     
        }

        // if(isset($whereNotIn) && !empty($whereNotIn))
        // {
        //    $records->whereNotIn($whereNotIn);     
        // }

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

    public function getBankingStatusAttribute()
    {
        $accounts = UserAccountDetail::where(['status' => 1, 'profile_id' => $this->id])->get();
        $bankingStatus = null;
        
        foreach ($accounts as $banking) {
            $bankingStatus = $banking->banking_status;
            break;
        }        
        return $bankingStatus;
	}

    public function getTicketStatusAttribute()
    {
        $tickets = TicketBooking::where(['status' => 1, 'profile_id' => $this->id])->get();
        $ticketStatus = null;
        
        foreach ($tickets as $ticket) {
            $ticketStatus = $ticket->ticket_status;
            break;
        }        
        return $ticketStatus;
    } 

    public function getHotelStatusAttribute()
    {
        $hotels = HotelBooking::where(['status' => 1, 'profile_id' => $this->id])->get();
        $hotelStatus = null;        
        foreach ($hotels as $hotel) {
            $hotelStatus = $hotel->hotel_status;
            break;
        }        
        return $hotelStatus;
    }     
}
