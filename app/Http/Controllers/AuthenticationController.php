<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\HttpHelper; 
use App;
use Session;
use App\User;

class AuthenticationController extends Controller
{
    //
       /*
    * Constructor
    */
    public function __construct() {
        //initialize HttpHelper
        $this->httpHelper = new HttpHelper();
    }
        


    /*
    * Realizar el login a traves del API
    */
    public function login(Request $request){


        try{
            $result = $this->httpHelper->login('oauth/token', [

                'username' => $request->email, 
                'password' => $request->password,
                'grant_type' => "password", 
                'client_id' => "2",
                'client_secret' => 'FWGeEuSpCol4gbhbMZ2Jl0ZEStoj729cieclnlyj'

                
            ]);
            
            //dd($result);
            if($result->success==false){
                return redirect()->back()->withInput($request->only('email'))->with(['error' => $result->message]);
            }
           
            $type =$result->data->TypeUser[0];

            //$request->session()->put('authenticated',true);
            
            //Session::put('user', $user);
            $userData = $result->data;
            $user = new User();
            $user->id = $userData->userid;
            $user->userFirstName = $userData->FirstName;
            $user->userLastName = $userData->FirstName;
            $user->status_id = $userData->FirstName;
            $user->email = $userData->FirstName;
            $user->tokenAuth = $userData->FirstName;
            $user->expiresOn = $userData->FirstName; 

            Session::put('userInfo', $result);
            Session::put('AuthCheck', true);
            Session::put('userEmail', $userData->Email);

            Session::save();

            
            
            /*
            * Redireccionar segun tipo de usuario
            */
			
            if($type->TypeUserID == 3){
                //  FULL Administrador
                return redirect('management/home');
                $request->session()->put('isLogged', true);
        
            }
            else{
            	return redirect()->back()->with(['error' => 'Usuario no autorizado'])->withInput();
            }

            
           

            

        } catch(GuzzleHttp\Exception\ClientException $e){
            dd($e);
            return back()->withInput();
        }

        //dd($result);


    }


     /**
     * 
     */
    public function logout(){

        Session::flush();
        return redirect('login');
    }
}
