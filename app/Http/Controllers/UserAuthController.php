<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{

    public function index()
    {
        if(isset($_COOKIE['user_id'])){
            $user_id = $_COOKIE['user_id'];
            $user = User::where('id', $user_id)->first();
            if($user){
                session()->put('user', $user);
                return redirect()->route('admin.home')->with('success', 'Welcom to Admin Page');
            }
        }
        return view('User.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'email|required',
            'password' => 'required'
        ]);


        $user = User::where('email', $request->username)
                        ->orWhere('username', $request->username)
                            ->first();

        if($user){
            if(Hash::check($request->password , $user->password)){
                if($request->remmber){
                    setcookie('user_id', $user->id , time() + (86400 * 30) , '/');
                }
                session()->put('user', $user);
                return redirect()->route('admin.home')->with('success', 'Welcom to Admin Page');
            }else{
                return redirect()->back()->with('error', 'Incorrect Username or Password');
            }
        }else{
            return redirect()->back()->with('error', 'Incorrect Username or Password');
        }
    }

    public function logout()
    {
        session()->flush();
        setcookie('user_id', "", time() - 3600 , '/');
        return redirect()->route('home');
    }
}
