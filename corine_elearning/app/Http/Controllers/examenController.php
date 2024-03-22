<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\formateur;
use App\Models\specialite;
use App\Models\session;
use App\Models\examen;
use App\Models\apprenant;


class examenController extends Controller
{
    //

    public function create(){

        $formateurs = formateur::select('nom', 'prenom', 'id')->get();
        $specialites = specialite::pluck('nom');
        $sessions = session::pluck('nom');

        return view('examen.create', compact('formateurs', 'specialites', 'sessions'));
    }

    public function store(Request $request)
    {

        $request->validate([
            //pour dire que les champs sont requis
            'titre' => ['required', 'string', 'max:255'],
            'formateur' => ['required', 'string', 'max:255'],
            'specialite' => ['required', 'string', 'max:255'],
            'session' => ['required',  'string', 'max:255'],
            'photo' => ['required'],
            'delais' => ['required'],

        ],);

        $examen = new examen();
        $examen->titre = $request->titre;
        $examen->specialite = $request->specialite;
        $examen->id_formateur = $request->formateur;
        $examen->session = $request->session;
        $examen->publier = 0;
        $examen->delais = $request->delais;

        $nomFichierOriginal = $request->file('photo')->getClientOriginalName();
        $imagePath = $request->file('photo')->storeAs('examens/fichiers', $nomFichierOriginal,'public');
        $examen->fichier = $imagePath ;


        $id = $request->input('formateur');
        //je recupere le formateur en fonction de son id
        $format = formateur::find($id);

        //je recupere le nom et le prenom du formateur
        $nom = $format->nom;
        $prenom = $format->prenom;
    
        //je concate sa pour avoir nom et prenom dans une seule chaine
        $form = $nom . ' ' . $prenom;

        $examen->formateur = $form;

        //je recupere tous les eleves dont la specialité est egale a la specialité que j'ai selectionné lors de la creation du quizz
        $apprenants = apprenant::where('specialite', $request->specialite)->pluck('id')->toArray();

        $ids_apprenants = implode(',', $apprenants);
        
        $examen->id_aprenants = $ids_apprenants;

        if ($examen->save()) 
        {
            return redirect()->back()->withsuccess('examens crée avec succès !');
        } 
        else 
        {
            return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
        }
    }

    public function liste(){

        $examen = examen::where('publier', 0)->get();

        return view('examen.liste', compact('examen'));
    }

    public function liste1(){

        $examen = examen::where('publier', 1)->get();

        return view('examen.liste_publier', compact('examen'));
    }

    public function modifier($id){

        $exam = examen::find($id);
        $formateurs = formateur::select('nom', 'prenom', 'id')->get();
        $specialites = specialite::pluck('nom');
        $sessions = session::pluck('nom');

        return view('examen.modifier', compact('exam', 'formateurs', 'specialites', 'sessions'));
    }

    public function store_modif(Request $request, $id){

        $request->validate([
            //pour dire que les champs sont requis
            'titre' => ['required', 'string', 'max:255'],
            'formateur' => ['required', 'string', 'max:255'],
            'specialite' => ['required', 'string', 'max:255'],
            'session' => ['required',  'string', 'max:255'],
            'photo' => ['required'],
            'delais' =>['required'],

        ],);

        $exam = examen::find($id);

        $exam->titre = $request->titre;
        $exam->specialite = $request->specialite;
        $exam->id_formateur = $request->formateur;
        $exam->session = $request->session;
        $exam->delais = $request->delais;

        $nomFichierOriginal = $request->file('photo')->getClientOriginalName();
        $imagePath = $request->file('photo')->storeAs('examens/fichiers', $nomFichierOriginal,'public');
        $exam->fichier = $imagePath ;


        $id = $request->input('formateur');
        //je recupere le formateur en fonction de son id
        $format = formateur::find($id);

        //je recupere le nom et le prenom du formateur
        $nom = $format->nom;
        $prenom = $format->prenom;
    
        //je concate sa pour avoir nom et prenom dans une seule chaine
        $form = $nom . ' ' . $prenom;

        $exam->formateur = $form;

        //je recupere tous les eleves dont la specialité est egale a la specialité que j'ai selectionné lors de la creation du quizz
        $apprenants = apprenant::where('specialite', $request->specialite)->pluck('id')->toArray();

        $ids_apprenants = implode(',', $apprenants);
        
        $exam->id_aprenants = $ids_apprenants;

        if ($exam->update()) 
        {
            return redirect()->back()->withsuccess('examen modifié avec succès !');
        } 
        else 
        {
            return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
        }

    }

    public function delete($id){

        $examen = examen::find($id);

        $examen->delete();
        return redirect()->back()->withsuccess('examen supprimé avec succès !');
    }

    public function publier($id){

        $examen = examen::find($id);

        $examen->publier = 1;

        $examen->update();

        return redirect()->back()->withsuccess('examen publié avec succès !');

    }

}
