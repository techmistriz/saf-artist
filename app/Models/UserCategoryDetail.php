<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Common\MasterModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCategoryDetail extends MasterModel
{
    use HasFactory;
    use SoftDeletes;

    protected $appends = ['actions'];
    protected $guarded = [];

    public function otherProjectCategory()
    {
        return $this->belongsTo('App\Models\Category', 'other_project_category_id', 'id');
    }

    public function otherProject()
    {
        return $this->belongsTo('App\Models\Project', 'other_project_id', 'id');
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
                $query->where('name', 'LIKE', '%'.$searchKey.'%');
            });
        }

        return $records->get();
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
