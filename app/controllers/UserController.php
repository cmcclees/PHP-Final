<?php
/**
 * Created by PhpStorm.
 * User: cmcclees
 * Date: 4/15/14
 * Time: 6:14 PM
 */

class UserController extends BaseController {

    /*shows all the users to the admin*/
    public function index() {
        $users = User::all()->sortBy('username');
        return View::make('users.index')
            ->with('users', $users);
    }

    /*
     * show form for editing user
     * */
    public function edit($id) {
        $user = User::find($id);

        return View::make("users.edit")
            ->with('user', $user);
    }

    /*
     * update user
     * */
    public function update($id) {
        $rules = array(
            'username'=>'required|alpha_num|min:3',
            'email'=>'required|email|unique:users',
        );
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()) {
            return Redirect::to('users/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = User::find($id);
            $user->username = Input::get('username');
            $user->email = Input::get('email');
            $user->save();

            Session::flash('flash_notice', 'Successfully updated user!');
            return Redirect::to('users');
        }
    }

    /*
     * delete user
     * */
    public function destroy($id) {
        $user = User::find($id);
        //delete all entries for this user in the pivot table
        $user->movies()->detach();
        //delete the user
        $user->delete();
        Session::flash('flash_notice', 'Successfully deleted the user!');
        return Redirect::to('users');
    }
} 