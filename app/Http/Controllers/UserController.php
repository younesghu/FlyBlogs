<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    /**
    Register Page
    */
    public function create(Request $request){
        return view('users/register');
    }

    /**
     Login Page
    */
    public function login(Request $request){
        return view('users/login');
    }

    /**
     Register User
    */
    public function store(Request $request){
        $data = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required','min:8'],
        ]);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        auth()->login($user);

        return redirect('/');
    }

    /**
    Authentificate User
     */
    public function authentificate(Request $request){

        $data = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        if(auth()->attempt(['name' =>$data['loginname'], 'password' => $data['loginpassword']])) {
            $request->session()->regenerate();
        }
        return redirect('/');
    }

    /**
    Log out User
     */

     public function logout(){

        auth()->logout();
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = auth()->user();
        return view('/users/settings', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        if($request->hasFile('user_img')){
            $data['user_img'] = $request->file('user_img')->store('user_imgs', 'public');
        }
        $user->update($data);

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
