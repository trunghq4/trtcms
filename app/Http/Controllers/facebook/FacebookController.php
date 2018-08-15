<?php namespace App\Http\Controllers\facebook;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Http\Request;

class FacebookController extends Controller {

	public function getLogin(){
		return Socialite::driver('facebook')->redirect();
	}
	public function callback(){
		$user = Socialite::driver('facebook')->user();
		dd($user);
	}

}
