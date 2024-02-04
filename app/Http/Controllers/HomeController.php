<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
	{
		$data = array(
		'tittle' => 'Home Page'
		);
		
		return view('index',$data);
		//return view('home',$data);
	}
}
