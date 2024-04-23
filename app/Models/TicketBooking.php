<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Common\MasterModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketBooking extends MasterModel
{
   use HasFactory;
   use SoftDeletes;

   protected $appends = ['actions'];

   public function setDobAttribute($value)
   {
      $formattedDate = date('Y-m-d', strtotime(str_replace('/', '-', $value)));

      $this->attributes['dob'] = $value ? \Carbon\Carbon::parse($formattedDate)->format('Y-m-d') : now()->format('Y-m-d');
   }

   public function getDobAttribute($value)
   {
      return $value ? date('d-M-Y', strtotime($value)) : null;
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
               ->orWhere('contact', 'LIKE', '%'.$searchKey.'%');
         });
      }
      return $records->get();
   }

   public function project() {

      return $this->belongsTo('App\Models\Project', 'project_id', 'id');
   }

   public function member() {

      return $this->belongsTo('App\Models\User', 'source_id', 'id');
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
               ->orWhere('contact', 'LIKE', '%'.$searchKey.'%');
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
   
}