<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\domaine;


class domaineController extends Controller
{
    //

    public function create_domaine()
{
    return view('domaine.create');
}

public function store_domaine(Request $request)
{


   


    $request->validate([
        //pour dire que les champs sont requis
        'nom' => ['required', 'string', 'max:255'],
    

    ], [
        'nom.required' => 'Le champ nom est requis.',
       
    ]);



        $existant = domaine::where('nom', $request->nom)->first();

        if($existant){
            return redirect()->back()->withErrors(['message' => 'Ce domaine de competance existe déjà !']);

        }
        else{

            $domaine = new domaine();
            $domaine->nom = $request->nom;
        
            if ($domaine->save()) 
                {
                    return redirect()->back()->withsuccess('domaine crée avec succès !');
                } 
            else 
            {
                return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
            }
        }

    
  

}


//fonction pour lister les specialites
public function list_domaine()
{
   $domaines = domaine::all();

   return view('domaine.liste', compact('domaines'));
}

public function delete_domaine($id)
{
    $dom = domaine::find($id);

    $dom->delete();
    return redirect()->back()->withsuccess('domaine supprimé avec succès !');

}

public function modifier($id)
{
    
    $domaine = domaine::find($id);
    return view('domaine.modifier', compact('domaine'));
}

public function store_modif(Request $request,$id)
{
    $request->validate([
        //pour dire que les champs sont requis
        
        'nom' => ['required', 'string', 'max:255'],
        
    ]);


    $existant = domaine::where('nom', $request->nom)->first();

    if($existant){
        return redirect()->back()->withErrors(['message' => 'Ce domaine existe déjà !']);

    }
    else{

        $domaine = domaine::find($id);
        $domaine->nom =  $request->nom;
        
        
        if ($domaine->update()) 
        {
            //return redirect()->back()->withsuccess('modification réussie !');
            return redirect('/domaine/Liste')->with('message','modification réussi');
        } 
        else 
        {
            return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
        }
    }
}

}
