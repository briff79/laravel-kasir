<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
	{
		$data = array(
		'tittle' => 'Home Page'
		);
		
		//return view('index',$data);
		return view('home',$data);
		//echo "HAlo tes sudah masuk";
		//echo "<br><a href='logout'>logout</a>";
		//echo "<h1>". auth()->user()->role ."</h1>";
	}
}