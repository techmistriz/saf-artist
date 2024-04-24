<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Common\MasterModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtistMember extends MasterModel
{
   use HasFactory;
   use SoftDeletes;

    protected $appends = ['actions'];
    protected $table = 'users';

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

    public function frontendRole()
    {
        return $this->belongsTo('App\Models\Role', 'frontend_role_id', 'id');
    }

    public function poc()
    {
      return $this->belongsTo('App\Models\User', 'poc_id', 'id');
    }    

    public function getActionsAttribute()
    {
        
        return '<span class="overflow-visible position-relative width-125" data-id="' . $this->id . '">
            <a href="' . route('admin.user.show', $this->id) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Show details">
                <i class="flaticon-eye"></i>
            </a>
            <a href="' . route('admin.ticket_booking.edit', $this->id) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit ticket details">
                <i class="flaticon2-pen"></i>
            </a>
            <a href="' . route('admin.hotel_booking.edit', $this->id) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit hotel details">
                <i class="flaticon2-pen"></i>
            </a>
        </span>';
    }	    
}
