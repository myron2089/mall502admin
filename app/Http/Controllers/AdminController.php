<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends BaseController
{
    //

    public function getHomePage(){
    	return view('managementHome');
    }

    public function getCompaniesRequest(){
    	return view('companies.companies-request');
    }
}
