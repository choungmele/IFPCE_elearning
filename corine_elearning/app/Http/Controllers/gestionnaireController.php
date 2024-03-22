<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gestionnaire;
use Illuminate\Support\Facades\Session;
use App\Models\domaine;
use App\Models\rendre;


class gestionnaireController extends Controller
{
    //

    public function login(){

        return view('gestionnaire.login');
    }

    public function gestionnaire_login(Request $request)
    {

        $this->validate($request, [
            // 'gestion$gestionnairename' => ['required', 'string', 'max:2'
            'email' => ['required', 'string', 'email', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'password' => 'required|min:7',
        ], [
            'email.required'   => ' Le Champ email est requis',
            'password.required'   => 'Le champ mot de passe est requis',
            'password.min' => 'Le mot de passe doit etre > à 7 caractères',
        ]);

        $gestionnaire = gestionnaire::where('email', $request->input('email'))->first();

        if($gestionnaire){

            if($request->input('password') === $gestionnaire->password){

                $gestionnaire = gestionnaire::where('email', $request->input('email'))
                            ->where('password', $request->input('password'))
                            ->first();

                            Session::put('manager_name', $gestionnaire->nom);
                            Session::put('manager_prenom', $gestionnaire->prenom);

                            $examens = rendre::where('id_formateur', $gestionnaire->id)->get();

                //return view('gestionnaire.dashboard',compact('examens'));

                return view('gestionnaire.dashboard',compact('gestionnaire', 'examens'));
            }
            else{
                return ('mot de passe incorrect');
            }
        }
        else{
            return ('pas de compte avec cet email');

    }
}

public function create()
{
    return view('gestionnaire.create');
}

public function store(Request $request)
{

    $request->validate([
        //pour dire que les champs sont requis
        'nom' => ['required', 'string', 'max:255'],
        'prenom' => ['required', 'string', 'max:255'],
        'naissance' => ['required','date'],
        'ville' => ['required', 'string', 'max:255'],
        'password' => ['required', 'string', 'max:255'],
        'tel' => ['required', 'integer'],
        'email' => ['required', 'string', 'max:255'],
        'cni' => ['required', 'integer'],
        'quartier' => ['required', 'string', 'max:255'],

        

    ],);

    $gest = new gestionnaire();
    $gest->nom = $request->nom;
    $gest->prenom = $request->prenom;
    $gest->naissance = $request->naissance;
    $gest->ville = $request->ville;
    $gest->password = $request->password;
    $gest->tel = $request->tel;
    $gest->email = $request->email;
    $gest->cni = $request->cni;
    $gest->quartier = $request->quartier;

    if ($gest->save()) 
    {
        return redirect()->back()->withsuccess('informations enregistrés avec succès !');
    } 
    else 
    {
        return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
    }
}

public function list()
{
    $data = gestionnaire::all();
    return view('gestionnaire.liste',compact('data'));
}

public function supprimer($id)
{
    $gest = gestionnaire::find($id);

    $gest->delete();
    return redirect()->back()->withsuccess('Gestionnaire supprimé avec succès !');

}

public function liste_examen($id){

    $examens = rendre::where('id_formateur', $id)->get();

    return view('gestionnaire.dashboard',compact('examens'));
    
}

public function corriger($id){

    $rendre = rendre::find($id);

    $rendre->delete();
    return redirect()->route('examen.liste_examen_envoyé',$id_app)->with(['message' => 'Devoir corrigé avec succes']);


}

}