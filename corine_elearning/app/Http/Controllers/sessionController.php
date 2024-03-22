<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\session;

class sessionController extends Controller
{
    //

    public function create_session()
    {
        return view('session.create');
    }
    
    public function store_session(Request $request)
    {
    
    
       
    
    
        $request->validate([
            //pour dire que les champs sont requis
            'nom' => ['required', 'string', 'max:255'],
        
    
        ], [
            'nom.required' => 'Le champ nom est requis.',
           
        ]);

        $existant = session::where('nom', $request->nom)->first();

        if($existant){
            return redirect()->back()->withErrors(['message' => 'Cette session existe déjà !']);

        }
        else{

            $session = new session();
            $session->nom = $request->nom;
        
            if ($session->save()) 
            {
                return redirect()->back()->withsuccess('session crée avec succès !');
            } 
            else 
            {
                return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
            }
        }
    
        
    }
    
    
    //fonction pour lister les specialites
    public function list_session()
    {
       $sessions = session::all();
    
       return view('session.liste', compact('sessions'));
    }
    
    public function delete_session($id)
    {
        $dom = session::find($id);
    
        $dom->delete();
        //return redirect()->back()->withsuccess('session supprimé avec succès !');
        return redirect('/session/Liste')->with('message','suppression réussi');

    }

    public function modifier($id)
    {
        
        $sessions = session::find($id);
        return view('session.modifier', compact('sessions'));
    }

    public function store_modif(Request $request,$id)
    {
        $request->validate([
            //pour dire que les champs sont requis
            
            'nom' => ['required', 'string', 'max:255'],
            
        ]);


        $existant = session::where('nom', $request->nom)->first();

        if($existant){
            return redirect()->back()->withErrors(['message' => 'Cette session existe déjà !']);

        }
        else{

            $session = session::find($id);
            $session->nom =  $request->nom;
            
            
            if ($session->update()) 
            {
                //return redirect()->back()->withsuccess('modification réussie !');
                return redirect('/session/Liste')->with('message','modification réussi');
            } 
            else 
            {
                return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
            }
        }

        
    }
}
