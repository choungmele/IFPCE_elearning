<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\formateur;
use App\Models\specialite;
use App\Models\cours;

class coursController extends Controller
{
    //

    public function create(){

        $formateurs = formateur::select('nom', 'prenom')->get();
        $specialites = specialite::pluck('nom');
        

        return view('gestionnaire.cours.create',compact('formateurs'),compact('specialites'));
    }


    public function store(Request $request)
    {

        $request->validate([
            //pour dire que les champs sont requis
            'code' => ['required', 'string', 'max:255'],
            'titre' => ['required', 'string', 'max:255'],
            'objectif' => ['required', 'string', 'max:255'],
            'specialite' => ['required', 'string', 'max:255'],
            'formateur' => ['required',  'string', 'max:255'],
            'coef' => ['required', 'integer'],
            'photo' => ['required'],

        ],);

        $cour = new cours();
        $cour->code = $request->code;
        $cour->titre = $request->titre;
        $cour->specialite = $request->specialite;
        $cour->coef = $request->coef;
        $cour->objectif = $request->objectif;
        $cour->formateur = $request->formateur;
        //$cour->fichier = $request->photo;
        $cour->suivi = 0;
        $cour->publier = 0;


        $nomFichierOriginal = $request->file('photo')->getClientOriginalName();

        $imagePath = $request->file('photo')->storeAs('cours/fichiers', $nomFichierOriginal,'public');
        $cour->fichier = $imagePath ;

        if ($cour->save()) 
        {
            return redirect()->back()->withsuccess('cours crée avec succès !');
        } 
        else 
        {
            return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
        }
    }

    public function liste()
    {
        //$cour = cours::all();
        $cour = cours::where('publier', 0)->get();

        return view('gestionnaire.cours.liste', compact('cour'));
    }

    public function add_file($id){

        $cour = cours::find($id);

        return view('gestionnaire.cours.add_file',compact('cour'));
    }

    public function do_add_file($id,Request $request){

        $cour = cours::find($id);

        //je prends le nom original du fichier
        $nomFichierOriginal = $request->file('photo')->getClientOriginalName();

        // Ajout de fichiers supplémentaires au cours existant
        $cheminFichierSupplementaire = $request->file('photo')->storeAs('cours/fichiers', $nomFichierOriginal,'public');

        // Ajout du nouveau chemin au champ existant
        $cour->fichier = $cour->fichier.','.$cheminFichierSupplementaire; 

        //$cheminFichierEnregistre = $request->file('fichier')->storeAs('cours/fichiers', $nomFichierOriginal, 'public');


        $cour->nombre = $cour->nombre + 1;
        $cour->save();

        return redirect()->back()->withsuccess('Fichier ajouter avec succès !');
    }

    public function details($id){

        $cour = cours::find($id);
        $fichiers = explode(',', $cour->fichier); // Supposons que les chemins sont stockés sous forme de chaîne séparée par des virgules

        return view('gestionnaire.cours.details', compact('cour', 'fichiers'));
    }

    public function delete($id){

        $cour = cours::find($id);
        $cour->delete();

        //return redirect('/cour')->with('status','supression réussi');
        return redirect()->back()->withsuccess('cour supprimé avec succès !');
    }

    public function publier($id){

        $cour = cours::find($id);
        $cour->publier = 1;
        if ($cour->update()) 
        {
            //return redirect()->back()->withsuccess('Modification réussie !');
            return redirect('/cours/Liste')->with('status','publication réussie');
        } 
        else 
        {
            return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
        }
    }

    public function liste_publier()
    {
        //$cour = cours::all();
        $cour = cours::where('publier', 1)->get();

        return view('gestionnaire.cours.liste_publier', compact('cour'));
    }

}
