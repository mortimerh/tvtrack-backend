<?php
class AuthController extends BaseController{
	
	/**
	 * Get the login page
	 *
	 */
	public function getLogin(){
		if( Auth::check() )
		{
			return Redirect::route('home');
		}
		return View::make('login');
	}

	/**
	 * Handles postdata for Login and redirects appropriately
	 */
	public function postLogin(){
			$credentials = array(
				'email' => Input::get('email'),
				'password' => Input::get('password')
			);

			if ( Auth::attempt($credentials) )
			{
				return Redirect::intended('/')
					->with('flash_notice', 'You are successfully logged in.');
			}

			return Redirect::route('login')
		            ->with('flash_error', 'Your email/password combination was incorrect.')
		            ->withInput();
	}

	/**
	 * Logs a user out and redirects to home
	 */
	public function getLogout(){
		if ( Auth::guest() )
		{
			return Redirect::route('login');
		}
		Auth::logout();
    return Redirect::route('home')
        ->with('flash_notice', 'You were successfully logged out.');
	}
}
?>