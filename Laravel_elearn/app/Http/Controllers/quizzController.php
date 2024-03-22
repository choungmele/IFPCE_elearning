<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Formateur;
use App\Models\Specialite;
use App\Models\quizz;
use App\Models\Apprenant;


class quizzController extends Controller
{
    //

    public function create(){

        $formateurs = formateur::select('id', 'nom', 'prenom')->get();
        $specialites = specialite::pluck('nom');
        

        return view('gestionnaire.quizz.create',compact('formateurs'),compact('specialites'));
    }


    public function store(Request $request)
    {

        $request->validate([
            //pour dire que les champs sont requis
            'titre' => ['required', 'string', 'max:255'],
            'delais' => ['required', 'string', 'max:255'],
            'specialite' => ['required', 'string', 'max:255'],
            'formateur' => ['required',  'string', 'max:255'],

        ],);

        $quizz = new quizz();
        $quizz->titre = $request->titre;
        $quizz->specialite = $request->specialite;
        $quizz->delais = $request->delais;

        $id = $request->input('formateur');
        //je recupere le formateur en fonction de son id
        $format = formateur::find($id);

        //je recupere le nom et le prenom du formateur
        $nom = $format->nom;
        $prenom = $format->prenom;
    
        //je concate sa pour avoir nom et prenom dans une seule chaine
        $form = $nom . ' ' . $prenom;

        $quizz->formateur = $form;
        $quizz->id_formateur = $request->formateur;
        $quizz->nombre = 0;
        $quizz->publier = 0;

        //je recupere tous les eleves dont la specialité est egale a la specialité que j'ai selectionné lors de la creation du quizz
        $apprenants = Apprenant::where('specialite', $request->specialite)->pluck('id')->toArray();

        $ids_apprenants = implode(',', $apprenants);

        $quizz->id_apprenant = $ids_apprenants;

        if ($quizz->save()) 
        {
            return redirect()->back()->withsuccess('quizz crée avec succès !');
        } 
        else 
        {
            return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
        }
    }

    public function list()
    {
        
        $quizz = quizz::where('publier', 0)->get();

        return view('gestionnaire.quizz.liste', compact('quizz'));
    }

    public function list2()
    {
        
        $quizz = quizz::where('publier', 1)->get();

        return view('gestionnaire.quizz.liste2', compact('quizz'));
    }

    public function publier($id){

        $quizz = quizz::find($id);
        $quizz->publier = 1;
        if ($quizz->update()) 
        {
            //return redirect()->back()->withsuccess('Modification réussie !');
            return redirect('/quizz/Liste')->with('status','publication réussie');
        } 
        else 
        {
            return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
        }
    }

    //pour les questions ici

       
}
