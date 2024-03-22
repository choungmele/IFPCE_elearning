<?php

namespace App\Http\Controllers;
use App\Models\specialite;

use Illuminate\Http\Request;

class specialiteController extends Controller
{
    //
    public function create(){

        return view('gestionnaire.specialite.create');
    }


    public function store(Request $request)
    {


       


        $request->validate([
            //pour dire que les champs sont requis
            'nom' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],


        ], [
            'nom.required' => 'Le champ nom est requis.',
            'code.required' => 'Le champ code est requis.',

        ]);


        $exist = specialite::where('nom', $request->nom)->where('code', $request->code)->first();
        
        // Vérifier si le nom de la spécialité existe déjà
        $specialiteNomExistante = specialite::where('nom', $request->nom)->first();

        // Vérifier si le code de la spécialité existe déjà
        $specialiteCodeExistante = specialite::where('code', $request->code)->first();

        if($exist){
            return redirect()->back()->withErrors(['message' => 'La spécialité existe déjà ! !']);

        }

        else if ($specialiteNomExistante) {
            //return redirect()->back()->with('error', 'Le nom de la spécialité existe déjà !');
            return redirect()->back()->withErrors(['message' => 'Le nom de la spécialité existe déjà ! !']);

        }

        else if ($specialiteCodeExistante) {
            //return redirect()->back()->with('error', 'Le code de la spécialité existe déjà !');
            return redirect()->back()->withErrors(['message' => 'Le code de la spécialité existe déjà !']);

        }

        else{
            $special = new specialite();
            $special->code = $request->code;
            $special->nom = $request->nom;
           
        
            if ($special->save()) 
            {
                return redirect()->back()->withsuccess('specialite crée avec succès !');
            } 
            else 
            {
                return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
            }
        }
    }


    //fonction pour lister les specialites
   public function liste()
   {
       $specialites = specialite::all();

       return view('gestionnaire.specialite.liste', compact('specialites'));
   }

   public function delete($id)
   {
     $special = specialite::find($id);
     $special->delete();

     return redirect()->back()->withErrors(['message' => 'Suppréssion réussie !']);

   }


   public function modifier($id)
   {
       
       $spec = specialite::find($id);
       return view('gestionnaire.specialite.modifier', compact('spec'));
   }

   public function store_modif(Request $request,$id)
    {
        $request->validate([
            //pour dire que les champs sont requis
            'code' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
    
        ], [
            'nom.required' => 'Le champ nom est requis.',
            'code.required' => 'Le champ nom est requis.',
        ]);


        

        // Vérifier si le nom de la spécialité existe déjà
        $specialiteNomExistante = specialite::where('nom', $request->nom)->first();

        // Vérifier si le code de la spécialité existe déjà
        $specialiteCodeExistante = specialite::where('code', $request->code)->first();

        if ($specialiteNomExistante) {
            //return redirect()->back()->with('error', 'Le nom de la spécialité existe déjà !');
            return redirect()->back()->withErrors(['message' => 'Le nom de la spécialité existe déjà ! !']);

        }

        else if ($specialiteCodeExistante) {
            //return redirect()->back()->with('error', 'Le code de la spécialité existe déjà !');
            return redirect()->back()->withErrors(['message' => 'Le code de la spécialité existe déjà !']);

        }

        else{

            $special = specialite::find($id);
            $special->code = $request->code;
            $special->nom = $request->nom;

            if ($special->update()) 
            {
                //return redirect()->back()->withsuccess('modification réussie !');
                return redirect('/specialite/Liste')->with('message','modification réussi');
            } 
            else 
            {
                return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
            }
        }


        
        
        
    }
}
