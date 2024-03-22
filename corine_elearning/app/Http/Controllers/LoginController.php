<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Corrected use statement
use Session; 


class LoginController extends Controller
{
    //
    public function login(){
         return view("auth.login");
    }
    public function registration(){
        return view("auth.registration");
    }
    public function registerUser(Request $request){
        $request->validate([
           'name'=>'required',
           'surname'=>'required',
           'birth'=>'required',
           'contact'=>'required|min:6|max:12',
           'contacts'=>'required|min:6|max:12',
           'pays'=>'required',
           'email'=>'required|email|unique:users',
           'password'=>'required|min:5|max:12',
           'occupation'=>'required',
           'cni'=>'required',
           'delivrance'=>'required'
        ]);
        $user = new user();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->birth = $request->birth;
        $user->contact =$request->contact;
        $user->contacts =$request->contacts;
        $user->pays=$request->pays;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->occupation= $request->occupation;
        $user->cni= $request->cni;
        $user->delivrance= $request->delivrance;
        $res = $user->save();
        if($res){
            return back()->with('success', 'you have registered successfully');

        }else{
             return back()->with('failed to connect', 'wrong');
        }
    }public function loginUser(request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12'
         ]);
         $user = User::where('email', "=", $request->email)->first();
         if($user){
             if(Hash::check($request->password, $user->password)){
               $request ->session()->put('loginId', $user->id);
               return redirect('dashboard');
             } else{
                return back()->with('fail','password not matches');
             }
         }
        else{
            return back()->with('fail','this email is not registered.');
         }
    }
   public function dashboard()
   {
    $data = array();
    if (Session::has('loginId')){
        $data = User::where('id', "=", Session::get('loginId'))->first();
    }

   return view ("gestionnaire.dashboard",compact('data'));
   }
   public function logout(){
    if (Session::has('loginId')){
        Session::pull('loginId');
        return redirect('login');
    }
   }
}
