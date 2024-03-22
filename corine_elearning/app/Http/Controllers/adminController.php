<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use Illuminate\Support\Facades\Session;

class adminController extends Controller
{
    //
    public function login(){

        return view('admin.login');
    }

    public function admin_login(Request $request)
    {

        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'password' => 'required|min:7',
        ], [
            'email.required'   => ' Le Champ email est requis',
            'password.required'   => 'Le champ mot de passe est requis',
            'password.min' => 'Le mot de passe doit etre > à 7 caractères',
        ]);

        $admin = admin::where('email', $request->input('email'))->first();

        if($admin){

            if($request->input('password') === $admin->password){

                $admin = admin::where('email', $request->input('email'))
                            ->where('password', $request->input('password'))
                            ->first();

                            Session::put('manager_name', $admin->nom);
                            Session::put('manager_prenom', $admin->prenom);

                return view('admin.dashboard',compact('admin'));
            }
            else{
                return back()->withInput()->withErrors(['status'=>'Mot de passe incorrect !!!!']);
            }
        }
        else{
            return back()->withInput()->withErrors(['status'=>'pas de compte avec cet email !!!!']);

    }
}
}
