<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title=" OpenApi Documentation",
     *      description="L5 Swagger description",
     *      @OA\Contact(
     *          email="admin@admin.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     *
     * @OA\Server(
     *      url="https://gci-db.com/api/",
     *      description="Demo API Server"
     * )

     *
     * @OA\Tag(
     *     name="Data Release",
     *     description="API Endpoints of Projects"
     * )
     */
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $product_status 		=	[];

    function 	__construct(){
    	$static_values 			=	config('constants');

    	foreach ($static_values as $key => $value) {
		    $this->{$key} 	=	$value;
            if(!is_array($value)){
                $this->{$key}   =   strtolower($value);
            }
    	}

    	// dd(\Route::currentRouteName());
    }

    function    pre($data, $shouldDie = false){
        echo '<pre>';
        print_r($data);
        echo '</pre>';

        if($shouldDie){
        	die;
        }
    }

    function 	returnAjaxData($data, $count){
    	return array(
            'page'          =>      $data['pagination']['page'] ?? 1, 
            'pages'         =>      $data['pagination']['pages'] ?? 1, 
            'perpage'       =>      $data['pagination']['perpage'] ?? 10, 
            'total'         =>      $count, 
            'sort'          =>      $data['sort']['sort'] ?? 'asc', 
            'field'         =>      $data['sort']['field'] ?? '_id', 
        );
    }

    function 	categoryAdminFormResolver($category_id){
    	
    	$category		= \App\Models\Category::findOrFail($category_id);

    	if(empty($category)){
    		return 'default';
    	}

    	if(isset($this->category_form_mapper[$category->name]) && !empty($this->category_form_mapper[$category->name])){

    		return $this->category_form_mapper[$category->name];
    	}

    	return 'default';
    }

    function 	categoryFormResolver(){
    	
    	$user			= \Auth::user();
    	$category		= \App\Models\Category::find($user->category_id);

    	if(empty($category)){
    		return 'frontend.category_details.empty.edit';
    	}

    	if(isset($this->category_form_mapper[$category->name]) && !empty($this->category_form_mapper[$category->name])){

    		return 'frontend.category_details.'.$this->category_form_mapper[$category->name].'.edit';
    	}

    	return 'frontend.category_details.default.edit';
    }

    function 	categoryFunctionResolver($category_id = NULL){
    	
    	if(empty($category_id)){
    		$user			= \Auth::user();
    		$category_id 	= $user->category_id;
    	}

    	$category		= \App\Models\Category::findOrFail($category_id);

    	if(empty($category)){
    		return '__updateCategoryDetails_others';
    	}

    	if(isset($this->category_form_mapper[$category->name]) && !empty($this->category_form_mapper[$category->name])){

    		return '__updateCategoryDetails_'.$this->category_form_mapper[$category->name];
    	}

    	return '__updateCategoryDetails_others';
    }
    
}
