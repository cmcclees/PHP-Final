<?php
/**
 * Created by PhpStorm.
 * User: cmcclees
 * Date: 4/1/14
 * Time: 12:39 PM
 */

class LoginController extends BaseController {

    public function showLogin() {
        return View::make('users/login');
    }

    public function processLogin() {
        // validate the info, create rules for the inputs
        $rules = array(
            'username'    => 'required',
            'password' => 'required|alphaNum|min:3'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('users/login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password'));
        } else {

            // create our user data for the authentication
            $userdata = array(
                'username' 	=> Input::get('username'),
                'password' 	=> Input::get('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {

                // validation successful!
                return Redirect::to('dashboard')
                    ->with('success', 'You have sucessfully logged in!');

            } else {

                // validation not successful, send back to form
                return Redirect::to('users/login');

            }

        }
    }

    public function logout() {
        Auth::logout();
        return Redirect::to('login');
    }

    public function register() {
        return View::make('users/register');
    }

    public function processRegister() {
        /*
        * validation rules for creating a user
        */
        $rules = array(
            'username'=>'required|alpha_num|min:3',
            'email'=>'email|unique:users',
            'password'=>'required|alpha_num|between:6,12|confirmed',
            'password_confirmation'=>'required|alpha_num|between:6,12'
        );
        $validator = Validator::make(Input::all(), $rules);

        if($validator->passes()) {
            //save user in DB
            $email = Input::get('email');
            $user = new User;
            $user->username = Input::get('username');
            if(!empty($email)) {
                $user->email = $email;
            }
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            return Redirect::to('login')->with('flash_notice', 'Thanks for registering!');
        } else {
            //validation failed, display errors
            return Redirect::to('register')->withErrors($validator)->withInput();
        }
    }

} 