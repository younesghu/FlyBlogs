<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    /**
     Login Page
    */
    public function login(){
        return view('/login');
    }

    /**
     Register User
    */
    public function register(Request $request){
        $data = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required','min:8']
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
