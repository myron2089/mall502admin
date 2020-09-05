<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\HttpHelper;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use DateTime;
use File;
use Image;

use App\Http\Controllers\BaseController as BaseController;

class CompanyController extends BaseController
{
    //

     /*
    * Constructor
    */
    public function __construct() {
        //initialize HttpHelper
		$this->httpHelper = new HttpHelper();
		//$this->Category = new CategoryController();
		 $this->middleware(function ($request, $next) {
            
            $this->credentialsValidate();
            return $next($request);
        });
        
    }


    public function index(){

    	
    	return view('companies.companies-request');
    }

    /*
    *
    * Obtener empreas según su estado para datatables
    *
    */

    public function getCompanyByStatus(Request $request, $statusId){
    	$requests = null;
    	

    	

    	//dd($requests);

    	 if(request()->ajax()) {


    	 	$endpoint = 'request'; //Por defecto

    	 	if($statusId == 'approved') {
    	 		
    	 		$endpoint = 'requestapproved';
    	 	} else if($statusId == 'rejected'){
    	 		$endpoint = 'requestrejected';
    	 	}

            try{
                $result = $this->httpHelper->request('get', 'auth', 'register/' . $endpoint, null);
               
                /*if($result && $result->success && $result->success == true){
		    		$requests = $result->data;
		    	} */
                $collection = $result->data;

                //dd($result);
                
                //dd($request->get('query')['generalSearch']);

                
                if (request()->has('query')){
                    $keyword = $request->get('query');
            
                    }

                    //dd($request->gquery);
            
                
                    
                    $content = datatables()->of($collection);
                    //->addColumn('action', 'action_button')
                    //->rawColumns(['action'])
                    //->addIndexColumn()

                    if(!empty($request->get('query')['generalSearch'] != null)){

                        
                        $content = $content
                        ->filter(function ($query) use ($request) {
                            
                            if(!empty($request)){
                                $query->collection = $query->collection->filter(function ($row) use ($request) {
                                   // return Str::contains(strtolower($row['productName']), $keyword) ? true : false;

                                     if (Str::contains(Str::lower($row['couponEmail']), Str::lower($request->get('query')['generalSearch']) )) {
                                            return true;
                                     }

                                    else if (Str::contains(Str::lower($row['couponNote']), Str::lower($request->get('query')['generalSearch'])  )) {
                                            return true;
                                     }

                                     return false;
                                });
                            } else{
                                return true;
                            }
                            
                        });
                    }
                   
                    $content = $content->make(true);
                    //dd(json_encode($content));
                    return $content;
                    

            }catch(GuzzleHttp\Exception\ClientException $e){
            
                return json_encode($e->Message());
            }
        }
    }




}
