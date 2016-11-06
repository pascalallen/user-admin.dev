<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Input;
use Auth;
use Session;
use Redirect;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

	public function getLogin()
	{
		return view('welcome');
	}

	public function postLogin()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		if (Auth::attempt(array('email' => $email, 'password' => $password))) {
			$user = Auth::user();
		    return Redirect::action('PostsController@index');
		} else {
		    // login failed, go back to the login screen
		    Session::flash('errorMessage', 'Wrong email or password!');
		    return Redirect::back()->withInput();
		}
	}
}
