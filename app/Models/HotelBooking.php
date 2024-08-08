<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Common\MasterModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class HotelBooking extends MasterModel
{
   use HasFactory;
   use SoftDeletes;

   protected $appends = ['actions', 'frontend_actions', 'banking_status', 'user_profile_status', 'ticket_status'];

   public function setCheckInDateAttribute($value)
   {
      if (!empty($value)) {
         $this->attributes['check_in_date'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
      }
   }

   public function getCreatedAtAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('d-M-Y');
        }
        return null;
    }

    public function getUpdatedAtAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('d-M-Y');
        }
        return null;
    }   

   public function getCheckInDateAttribute($value)
   {
      if (!empty($value)) {
         return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
      }
   }
   
   public function setCheckOutDateAttribute($value)
   {
      if (!empty($value)) {
         $this->attributes['check_out_date'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
      }
   }

   public function getCheckOutDateAttribute($value)
   {
      if (!empty($value)) {
         return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
      }
   }

   public function setPerformanceDateAttribute($value)
   {
      if (!empty($value)) {
         // $this->attributes['performance_date'] = Carbon::createFromFormat('d-M-Y', $value)->format('Y-m-d');
         $this->attributes['performance_date'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
      }
   }

   public function getPerformanceDateAttribute($value)
   {
      if (!empty($value)) {
         return Carbon::createFromFormat('Y-m-d', $value)->format('d-M-Y');
      }
   }

   public function setProfileMemberIdsAttribute($value)
   {
       $this->attributes['profile_member_ids'] = json_encode($value);
   }

   public function getProfileMemberIdsAttribute($value)
   {
       $v = json_decode($value) ?? [];
       return !is_array($v) ? [] : $v;
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
      
      if(!empty($data['query']['search'])){

      $searchKey = $data['query']['search'];
         $records->where(function($query) use ($searchKey){
            $query->WhereHas('travelPurpose', function ($query) use ($searchKey) {
                  $query->where('name', 'LIKE', '%'.$searchKey.'%');
               })
               ->orWhereHas('userProfile.festival', function ($query) use ($searchKey) {
                  $query->where('name', 'LIKE', '%'.$searchKey.'%');
               })
               ->orWhereHas('profile', function ($query) use ($searchKey) {
                  $query->where('project_year', 'LIKE', '%'.$searchKey.'%');
               });
         });
      }
      return $records->get();
   }

   public function userProfile() {

      return $this->belongsTo('App\Models\UserProfile', 'profile_id', 'id');
   }

   public function profileMember()
   {
      if (empty($this->profile_member_ids) || $this->profile_member_ids == 'null') {
         return [];
      }

      $records = ProfileMember::whereIn('id', $this->profile_member_ids)->get()->map(function ($profile_member) {
         return $profile_member->name;
      })->toArray();

      return $records;
   }

   public function travelPurpose() {

      return $this->belongsTo('App\Models\TravelPurpose', 'travel_purpose_id', 'id');
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
               ->orWhereHas('travelPurpose', function ($query) use ($searchKey) {
                  $query->where('name', 'LIKE', '%'.$searchKey.'%');
               })
               ->orWhereHas('userProfile.festival', function ($query) use ($searchKey) {
                  $query->where('name', 'LIKE', '%'.$searchKey.'%');
               })
               ->orWhereHas('profile', function ($query) use ($searchKey) {
                  $query->where('project_year', 'LIKE', '%'.$searchKey.'%');
               });
         });
      }

      return $records->count();
   }

   function getActionsAttribute(){
   
      return '<span class="overflow: visible; position: relative; width: 125px;" data-id="'.$this->id.'">
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
         <a href="' . route('admin.banking_details.index', ['profile_id' => request('profile_id')]) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Banking detail list">
            <i class="la la-bank  icon-xl"></i>
         </a> 
         <a href="' . route('admin.ticket_booking.index', ['profile_id' => request('profile_id')]) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Ticket booking list">
            <i class="la la-ticket  icon-xl"></i>
         </a>
      </span>';
   }

   public function getFrontendActionsAttribute()
   {
      $editDetailButton = '';
      if ($this->hotel_status == 1) {
         $editDetailButton = '
         <a href="' . route('hotel.booking.edit', $this->id) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
         <i class="flaticon2-pen"></i>
         </a>';
      }

      return '
      <span style="overflow: visible; position: relative; width: 125px;" data-id="' . $this->id . '">
         <a href="' . route('hotel.booking.show', $this->id) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Show details">
            <i class="flaticon-eye"></i>
         </a>'
         . $editDetailButton . '
         <a href="' . route('hotel.booking.delete', $this->id) . '" class="btn btn-sm btn-clean btn-icon delete_btn" title="Delete">
            <i class="flaticon2-trash"></i>
         </a>
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

   public function getBankingStatusAttribute()
   {
      $accounts = UserAccountDetail::where(['status' => 1, 'profile_id' => $this->profile_id])->get();
      $bankingStatus = null;
     
      foreach ($accounts as $banking) {
         $bankingStatus = $banking->banking_status;
         break;
      }        
      return $bankingStatus;
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
   
}
