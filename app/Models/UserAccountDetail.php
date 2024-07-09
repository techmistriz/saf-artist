<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Common\MasterModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAccountDetail extends MasterModel
{
    use HasFactory;
    use SoftDeletes;

    protected $appends = ['actions', 'frontend_actions', 'ticket_status', 'user_profile_status', 'hotel_status'];
    protected $guarded = [];

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

        // // Added for sequence number
        // $page               =   $data['pagination']['page'] ?? 1;
        // $page               =   $page - 1;
        // $perPage            =   $data['pagination']['perpage'] ?? 10;
        // $page               =   $page * $perPage;

        // \DB::select(\DB::raw('SET @row := '. $page));
        // $records->selectRaw('@row := @row + 1 as row, '.$this->getTable().'.*');
        // $records->from(\DB::raw(''.$this->getTable().', (SELECT @row := '.$page.') r'));
        // // Added for sequence number

        if(!empty($data['query']['search'])){

            $searchKey = $data['query']['search'];
            $records->where(function($query) use ($searchKey){
                $query->where('name', 'LIKE', '%'.$searchKey.'%')
                ->orWhereHas('profile.festival', function ($query) use ($searchKey) {
                  $query->where('name', 'LIKE', '%'.$searchKey.'%');
                })
                ->orWhereHas('profile', function ($query) use ($searchKey) {
                  $query->where('project_year', 'LIKE', '%'.$searchKey.'%');
                });
            });
        }

        return $records->get();
    }

    public function country()
    {
      return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }
    
    public function profile()
    {
      return $this->belongsTo('App\Models\UserProfile', 'profile_id', 'id');
    }

    public function state()
    {
       return $this->belongsTo('App\Models\State', 'state_id', 'id');
    }

    public function city()
    {
      return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }

    function getActionsAttribute() {
        return '<span style="overflow: visible; position: relative; width: 125px;" data-id="'.$this->id.'">
            <a href="show/'.$this->id.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Show details">
               <i class="flaticon-eye"></i>
            </a>
            <a href="edit/'.$this->id.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
               <i class="flaticon2-pen"></i>
            </a>
            <a href="delete/'.$this->id.'" class="btn btn-sm btn-clean btn-icon delete_btn" title="Delete">
               <i class="flaticon2-trash"></i>
            </a>
            <a href="'.route('admin.user_profile.index').'" class="btn btn-sm btn-clean btn-icon mr-2" title="Back User Profile List">
               <i class="fa fa-user"></i>
            </a>
            <a href="' . route('admin.ticket_booking.index', ['profile_id' => request('profile_id')]) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Ticket booking list">
                <i class="la la-ticket  icon-xl"></i>
            </a> 
            <a href="' . route('admin.hotel_booking.index', ['profile_id' => request('profile_id')]) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Hotel booking list">
                <i class="la la-hotel  icon-xl"></i>
            </a>
        </span>';
    }


    function getFrontendActionsAttribute(){
    
        $view = '<a href="' . route('user.account.details.show', $this->id) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Show Account Details">
                   <i class="flaticon-eye"></i>
                </a>';

        $edit = '';
        if ($this->banking_status == 1) {
            $edit = '<a href="' . route('user.account.details.edit', $this->id) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit Account Details">
                   <i class="flaticon2-pen"></i>
                </a>';
        }        

        return '<span class="overflow: visible; position: relative; width: 125px;" data-id="'.$this->id.'">
                '.$view.$edit.'
            </span>';
    }

    public function getUserProfileStatusAttribute()
    {
        $userProfiles = UserProfile::where(['status' => 1, 'id' => $this->profile_id])->get();
        $userProfileStatus = null;
        foreach ($userProfiles as $userProfile) {
            $userProfileStatus = $userProfile->profile_status;
            break;
        }        
        return $userProfileStatus;
    }

    public function getTicketStatusAttribute()
    {
        $tickets = TicketBooking::where(['status' => 1, 'profile_id' => $this->profile_id])->get();
        $ticketStatus = null;
        
        foreach ($tickets as $ticket) {
            $ticketStatus = $ticket->ticket_status;
            break;
        }        
        return $ticketStatus;
    }

    public function getHotelStatusAttribute()
    {
        $hotels = HotelBooking::where(['status' => 1, 'profile_id' => $this->profile_id])->get();
        $hotelStatus = null;        
        foreach ($hotels as $hotel) {
            $hotelStatus = $hotel->hotel_status;
            break;
        }        
        return $hotelStatus;
    }   
    
}
