<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Common\MasterModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class TicketBooking extends MasterModel
{
   use HasFactory;
   use SoftDeletes;

   protected $appends = ['actions', 'frontend_actions'];

   public function setProjectIdsAttribute($value){
    
      $this->attributes['project_ids'] = json_encode($value);
   }

   public function getProjectIdsAttribute($value){
     
      $v = json_decode($value) ?? [];
      return !is_array($v) ? [] : $v;
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

   public function setReturnDateAttribute($value)
   {
      $this->attributes['return_date'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
   }

   public function getReturnDateAttribute($value)
   {
      if($value){
         return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
      }
   }

   public function setOnwardDateAttribute($value)
   {
      $this->attributes['onward_date'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
   }

   public function getOnwardDateAttribute($value)
   {
      if($value){
         return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
      }
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
      return $records->get();
   }

   public function project()
   {
      if (empty($this->project_ids) || $this->project_ids == 'null') {
         return [];
      }

      $records = Project::whereIn('id', $this->project_ids)->get()->map(function ($project) {
         return $project->name;
      })->toArray();

      return $records;
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

   public function onwardCity() {

      return $this->belongsTo('App\Models\MetroCity', 'onward_city_id', 'id');
   }

   public function returnCity() {

      return $this->belongsTo('App\Models\MetroCity', 'return_city_id', 'id');
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
      </span>';
   }

   public function getFrontendActionsAttribute()
   {
       $editDetailButton = '';
       if ($this->ticket_status == 1) {
           $editDetailButton = '
               <a href="' . route('ticket.booking.edit', $this->id) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
                   <i class="flaticon2-pen"></i>
               </a>';
       }

       return '
           <span style="overflow: visible; position: relative; width: 125px;" data-id="' . $this->id . '">
               <a href="' . route('ticket.booking.show', $this->id) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Show details">
                   <i class="flaticon-eye"></i>
               </a>'
               . $editDetailButton . '
               <a href="' . route('ticket.booking.delete', $this->id) . '" class="btn btn-sm btn-clean btn-icon delete_btn" title="Delete">
                   <i class="flaticon2-trash"></i>
               </a>
           </span>';
   }

   
}
