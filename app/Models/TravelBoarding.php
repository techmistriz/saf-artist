<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Common\MasterModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class TravelBoarding extends MasterModel
{
    use HasFactory;
    use SoftDeletes;

    protected $appends = ['actions'];
    protected $guarded = [];

    public function project() {

        return $this->belongsTo('App\Models\Project', 'project_name', 'id');
    }

    public function onwardCity() {

        return $this->belongsTo('App\Models\MetroCity', 'onward_city_id', 'id');
    }

    public function returnCity() {

        return $this->belongsTo('App\Models\MetroCity', 'return_city_id', 'id');
    }

    public function setDateOfTravelAttribute($value){
    	
    	if($value){
        	$this->attributes['date_of_travel'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    	}
    }

    public function getDateOfTravelAttribute($value){
    	
    	if($value){
    		return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
    	}
    }

    public function setReturnDateAttribute($value){
    	
    	if($value){
        	$this->attributes['return_date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    	}
    }

    public function getReturnDateAttribute($value){
    	
    	if($value){
    		return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
    	}
    }

    public function setCheckInDateAttribute($value){
    	
    	if($value){
        	$this->attributes['check_in_date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    	}
    }

    public function getCheckInDateAttribute($value){
    	
    	if($value){
    		return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
    	}
    }

    public function setCheckOutDateAttribute($value){
    	
    	if($value){
        	$this->attributes['check_out_date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    	}
    }

    public function getCheckOutDateAttribute($value){
    	
    	if($value){
    		return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
    	}
    }

    public function setAirportDropRequiredDateAttribute($value){
    	
    	if($value){
        	$this->attributes['airport_drop_required_date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    	}
    }

    public function getAirportDropRequiredDateAttribute($value){
    	
    	if($value){
    		return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
    	}
    }

    public function setDedicatedCabRequiredStartingDateAttribute($value){
    	
    	if($value){
        	$this->attributes['dedicated_cab_required_starting_date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    	}
    }

    public function getDedicatedCabRequiredStartingDateAttribute($value){
    	
    	if($value){
    		return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
    	}
    }

    public function setDedicatedCabRequiredEndDateAttribute($value){
    	
    	if($value){
        	$this->attributes['dedicated_cab_required_end_date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    	}
    }

    public function getDedicatedCabRequiredEndDateAttribute($value){
    	
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

    function getActionsAttribute(){

       	$view = '<a href="show/'.$this->id.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Show travel boarding details">
                   <i class="flaticon-eye"></i>
                </a>';
        $edit = '<a href="edit/'.$this->id.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit travel boarding details">
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
    
}
