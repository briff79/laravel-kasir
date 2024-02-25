<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Routing\Redirector;

class AuthController extends Controller
{
    //
	public function index()
	{
		return view('index');
	}
	
	public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ],[
			'email.required'=>'Email wajib diisi',
			'email.required'=>'Email wajib diisi',
		]);

        $data = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];

        if (Auth::attempt($data)) {
            return redirect('/home');
        } else {
            return redirect('')->withErrors('Email atau Password masih belum sesuai')->withInput();
        }
    }

	function logout()
	{
		Auth::logout();
		return redirect('');
	}
	
}
