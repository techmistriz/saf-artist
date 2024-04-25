<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Common\MasterModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class HotelBooking extends MasterModel
{
   use HasFactory;
   use SoftDeletes;

   protected $appends = ['actions'];

   public function setCheckInDateAttribute($value)
   {
      if (!empty($value)) {
         $this->attributes['check_in_date'] = \Carbon\Carbon::parse($value)->format('Y-m-d');        
      }
   }

   

   public function getCheckInDateAttribute($value)
   {
      if (!empty($value)) {
         return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
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
         return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
      }
   }

   public function setPerformanceDateAttribute($value)
   {
      if (!empty($value)) {
         // $this->attributes['performance_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
         $this->attributes['performance_date'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
      }
   }

   public function getPerformanceDateAttribute($value)
   {
      if (!empty($value)) {
         return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
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
               ->orWhere('contact', 'LIKE', '%'.$searchKey.'%');
         });
      }
      return $records->get();
   }

   public function member() {

      return $this->belongsTo('App\Models\User', 'source_id', 'id');
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
