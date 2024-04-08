<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\DataRelease;
use App\Models\DistributorType;
use App\Models\ProductType;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Genre;
use Carbon\Carbon;


class APIController extends Controller
{	
	/**
	 * @OA\Post(
	 * path="/get-item-list",
	 * summary="Releases",
	 * description="Get List of released.<br><br>
	 `previous_release_id` release ID from API <br><br>
	 `license_key` system will validate, if its valid only then it will proceed and return the data. <br><br>
	 `type` there are four type of options are available `comics`,`board-games`,`video-games`,`series_code`,`sku_update` <br><br>
	 `internal_request` this parameter is eligible when Wordpress Woocommerce will request data.<br>
	 ",
	 * operationId="released_data",
	 * tags={"Release"},
	 * @OA\RequestBody(
	 *    required=true,
	 *    description="Get API release JSON and ZIP Files",
	 *    @OA\JsonContent(
	 *       required={
	 			"previous_release_id",
	 			"license_key"	 			
 			},
	 *      @OA\Property(
	 			property="previous_release_id", 
	 			type="string",  
	 			example="1"
 			),
	 *      @OA\Property(
	 			property="previous_request_date", 
	 			type="date",  	 			
 			),
	 *      @OA\Property(
	 			property="license_key", 
	 			type="string", 
	 			example="AD65a4d65aS6d54"
 			),
	 *      @OA\Property(
	 			property="type",
	 			type="string", 
	 			example="comics"
 			),
	 *      @OA\Property(
	 			property="internal_request",
	 			type="boolen", 
	 			example="true"
 			),
	 *    ),
	 * ),
	 * @OA\Response(
	 *    response=422,
	 *    description="Wrong credentials response",
	 *    	@OA\JsonContent(
	 *       	@OA\Property(
		 			property="message", 
		 			type="string", 
		 			example="Sorry, wrong email address or password. Please try again"
				)
	 *  	)
	 * 	)
	 * )
	 */

	function 	getItemList(Request $request,  DataRelease 	$DataRelease, 	Product  $Product){

		$return 		=	[];

		$data 			=	$request->all();
		$ddrelease  	=	$DataRelease->where('release_id','>', (float) $data['previous_release_id'] );
		
		if(!empty($data['type']) && $data['type'] == 'series_code'){
			$ddrelease->where('release_type', 'series_code' );
		}
		else if(!empty($data['type']) && $data['type'] == 'sku_update'){
			$ddrelease->where('release_type', 'sku_update' );
		}
		else if(!empty($data['type']) && $data['type'] != 'all'){

			$productType  = ProductType::where('slug', $data['type'])->first();

			if(!empty($productType)){
				$ddrelease->where('type_id', $productType->getID() );
			}
		}

		$release 	=	$ddrelease->select('_id','file_name','release_id','time_zone','type','type_id','file_extension','release_type','created_at','count')->get();
		
		if(!empty($release->count())){
			$responseArr 	=	array(
				'success' 	=>	true,
				'data'		=>	$release,
				'message'	=>	'Data found',
			);

			
		}
		else{
			$responseArr 	=	array(
				'success' 	=>	false,
				'data'	=>	[],
				'message'	=>	'Data not found',
			);	
		}
		return response()->json($responseArr);

	}

	/**
	 * @OA\Post(
	 * path="/get-file",
	 * summary="Release Single File",
	 * description="Get release file information by sending ID of file. <br><br>
	 `file_id` id of file which user request <br><br>
	 `license_key` system will validate, if its valid only then it will proceed and return the data. <br><br>	 
	 `internal_request` this parameter is eligible when Wordpress Woocommerce will request data.<br>",
	 * operationId="Release Single File",
	 * tags={"Release Single File"},
	 * @OA\RequestBody(
	 *    required=true,
	 *    description="Get API release JSON and ZIP Files",
	 *    @OA\JsonContent(
	 *       required={
	 			"file_id",
	 			"license_key"	 			
 			},
	 *      @OA\Property(
	 			property="file_id", 
	 			type="string",  
	 			example="1"
 			),
	 *      @OA\Property(
	 			property="license_key", 
	 			type="string", 
	 			example="AD65a4d65aS6d54"
 			), 			
	 *      @OA\Property(
	 			property="internal_request",
	 			type="boolen", 
	 			example="true"
 			),
	 *    ),
	 * ),
	 * @OA\Response(
	 *    response=422,
	 *    description="Wrong credentials response",
	 *    	@OA\JsonContent(
	 *       	@OA\Property(
		 			property="message", 
		 			type="string", 
		 			example="Sorry, wrong email address or password. Please try again"
				)
	 *  	)
	 * 	)
	 * )
	 */

	function 	getFile(Request $request,  DataRelease 	$DataRelease, 	Product  $Product){

		$return 		=	[];

		$data 			=	$request->all();
		
		$responseArr 	=	$DataRelease->getDownloadFile($data);

		return response()->json($responseArr);
	}


	/**
	 * @OA\Post(
	 * path="/get-other-list",
	 * summary="Releases",
	 * description="Get List of Category, Brand, genre, manufacturers, publishers.<br><br>
	 `type` there are two type of options are available `category`,`brand`,`genre`,`manufacturers`,`publishers` <br><br>
	 ",
	 * operationId="other_list_id",
	 * tags={"Release"},
	 * @OA\RequestBody(
	 *    required=true,
	 *    description="Get original category, brand data.",
	 *    @OA\JsonContent(
	 *       required={
	 			"type",
	 			"license_key"	 			
 			},
	 *      @OA\Property(
	 			property="type", 
	 			type="string",  
	 			example="category"
 			), 			
	 *      @OA\Property(
	 			property="license_key", 
	 			type="string", 
	 			example="AD65a4d65aS6d54"
 			),
	 *      @OA\Property(
	 			property="internal_request",
	 			type="boolen", 
	 			example="true"
 			),
	 *    ),
	 * ),
	 * @OA\Response(
	 *    response=422,
	 *    description="Wrong credentials response",
	 *    	@OA\JsonContent(
	 *       	@OA\Property(
		 			property="message", 
		 			type="string", 
		 			example="Sorry, wrong email address or password. Please try again"
				)
	 *  	)
	 * 	)
	 * )
	 */

	function 	getOtherList(Request $request,  Category 	$Category, 	Brand  $Brand, 	Genre 	$Genre){

		$return 		=	[];

		$data 			=	$request->all();
		
		if(!empty($data['type'] )){

			switch ($data['type']) {
				case 'category':
					# code...

                   	Category::$withoutAppends = true;
        			$release = Category::with('childrenRecursive')->whereNull('parent')->get();
					break;
				
				case 'brand':
                   	
                   	Brand::$withoutAppends = true;
					$release 	=	$Brand->select('name','_id','slug','code')->get();
					# code...
					break;
				
				case 'genre':
                   	
                   	Genre::$withoutAppends = true;
					$release 	=	$Genre->select('name','_id','slug','code')->get();
					# code...
					break;
				case 'publishers':
					\App\Models\Publishers::$withoutAppends = true;
					$release 		=	\App\Models\Publishers::select('name','slug','status')->get();					
					break;
				case 'manufacturers':
					\App\Models\Manufacturer::$withoutAppends = true;
					$release 		=	\App\Models\Manufacturer::select('name','slug','status')->get();				
					break;
				default:
					$release 	=	[];
					# code...
					break;
			}
		}
		else{
			$responseArr 	=	array(
				'success' 	=>	false,
				'message' =>	'Data Found',
				'data'	=>	[],
			);	
			return response()->json($responseArr);	
		}

		
		if(!empty($release) && !empty($release->count())){
			$responseArr 	=	array(
				'success' 	=>	true,
				'message' =>	'Data Found',
				'data'	=>	$release,
			);			
		}
		else{
			$responseArr 	=	array(
				'success' 	=>	false,
				'message' =>	'Data Not Found',
				'data'	=>	[],
			);	
		}
		return response()->json($responseArr);

	}


	/**
	 * @OA\Post(
	 * path="/licenses/activate",
	 * summary="Releases",
	 * description="Activate license key",
	 * tags={"Activate License Key"},
     * @OA\RequestBody(
	 *    required=true,
	 *    description="Activate license key",
	 *    @OA\JsonContent(
	 *       required={
	 			"license_key"	 			
 			},
	 *      @OA\Property(
	 			property="license_key", 
	 			type="string", 
	 			example="API-DSS-PIV-KVB-G5F"
 			),
	 *      @OA\Property(
	 			property="internal_request",
	 			type="boolen", 
	 			example="true"
 			),
	 *      @OA\Property(
	 			property="machineName",
	 			type="string", 
	 			example="true"
 			),
	 *    ),
	 * ),
	 * @OA\Response(
	 *    response=422,
	 *    description="Wrong license key response",
	 *    	@OA\JsonContent(
	 *       	@OA\Property(
		 			property="message", 
		 			type="string", 
		 			example="Sorry, wrong license key. Please try again with correct license key"
				)
	 *  	)
	 * 	)
	 * )
	 */

	function 	licenseActivate(Request $request){

		if(!$request->has('machineName')){
			$error  =   array(
	            'success'   	=>  false,
	            'message'   =>  'Please enter machine name',
	            'data'  	=>  []
	        );

	        return response()->json($error);
		}

	 	if(!empty(env('LICENSE_VALIDATOR_URL', "https://services.gci-db.com"))){

	 		if($request->has('license_key') && $request->filled('license_key')){

 				$machineValue 	=	\App\Models\MetaData::where('meta_key', 'machineName')->where('meta_value', $request['machineName'])->first();
	 			
	 			$url        	=   env('LICENSE_VALIDATOR_URL', "https://services.gci-db.com").'/wp-json/lmfwc/v2/licenses/activate/'.$request['license_key'];

	 			if(!empty( $machineValue->meta_key )){

	 				$url        =   env('LICENSE_VALIDATOR_URL', "https://services.gci-db.com").'/wp-json/lmfwc/v2/licenses/validate/'.$request['license_key'];
	 			}


	            $helper     =   new \App\Helpers\Helper;
	            $response   =   $helper->licenseVerificationWithKey($url);

	            $response   =   json_decode($response);

	            $response   =   json_decode(json_encode($response), true);

	            if(!empty($response['success']) && $response['success'] == true){

	            	$response['message'] 		= 'License key validated successfully';

	            	\App\Models\MetaData::insert([ 'meta_key' => 'machineName',  'meta_value' => $request['machineName'] ]);
	            	
	                return response()->json($response);
	            }

	            $error  =   array(
	                'success'   	=>  false,
	                'message'   =>  $response['message'] ?? '',
	                'data'  	=>  $response
	            );

	            return response()->json($error);

	 		} else {
	 			$error  =   array(
		            'success'   	=>  false,
		            'message'   =>  'License key required.',
	                'data'  	=>  [],
		        );
		        return response()->json($error);
	 		}
        }
        
        $error  =   array(
            'success'   	=>  false,
            'message'   =>  'URL not available',
            'data'  	=>  [],
        );
        return response()->json($error);
	}



	/**
	 * @OA\Post(
	 * path="/get-vendors",
	 * summary="Get vendors listing",
	 * description="Get vendor listing for handling of sku. <br><br>
	 `license_key` system will validate, if its valid only then it will proceed and return the data. <br><br>",
	 * operationId="Get vendors listing",
	 * tags={"Get vendors listing"},
	 * @OA\RequestBody(
	 *    required=true,
	 *    description="Send License key for validation",
	 *    @OA\JsonContent(
	 *       required={
	 			"license_key"	 			
 			},
	 *      @OA\Property(
	 			property="license_key", 
	 			type="string", 
	 			example="AD65a4d65aS6d54"
 			), 	
	 *    ),
	 * ),
	 * @OA\Response(
	 *    response=422,
	 *    description="Wrong credentials response",
	 *    	@OA\JsonContent(
	 *       	@OA\Property(
		 			property="message", 
		 			type="string", 
				)
	 *  	)
	 * 	)
	 * )
	 */


	function 	getVendors(Request $request,  DistributorType 	$DistributorType){

		$return 		=	[];

		$data 			=	$request->all();
		
		$responseArr 	=	$DistributorType->where('slug','!=','coolstuffinccom')->select('_id','name','slug','status','created_at')->get();

		return response()->json($responseArr);
	}

}