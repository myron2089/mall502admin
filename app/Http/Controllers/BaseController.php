<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use App;

class BaseController extends Controller
{
    private $authCheck;

    /*
    * Constructor
    */
    public function __construct(){

        //$this->request = $request;
        $this->authCheck = Session::get('AuthCheck');

        //$this->credentialsValidate();
    }

    protected function credentialsValidate(){
       // if(!Session::get('AuthCheck'))
      
       //$data = Session::all();
       //var_dump($data);
       // dd(Session::get('AuthCheck'));
       
        if(!Session::get('AuthCheck') || Session::get('AuthCheck') == null ){
           
            Redirect::to('login')->send();
        }

    }


}