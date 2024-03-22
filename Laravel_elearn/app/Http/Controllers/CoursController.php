<?php

namespace App\Http\Controllers;
use App\Models\Cours;
use App\Models\ModuleSpecialite;
use App\Models\Session;
use App\Models\Specialite;
use App\Models\Formateur;


use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
class CoursController extends Controller
{
    public function listeCours_cours(){
        $courss = Cours::paginate(4);
        // Récupérer vos données (supposons que $data est une collection de données)
       
         return view('gestionnaire.cours.creer.listeCours', compact('courss'));
     }
     public function ajouterCours_cours(){
        $sessions = Session::all();
  
        //$specialites = Specialite::all();
        $formateurs = Formateur::select('nom', 'prenom')->get();
        $specialites = Specialite::pluck('nom');
  
        $modules = ModuleSpecialite::all('nom');
       
           return view('gestionnaire.cours.creer.ajouterCours',  compact('sessions', 'specialites', 'modules', 'formateurs'));
       }
 /*
     public function ajouterCours_cours_traitement(Request $request){
        $request->validate([
          'specialite' => 'required|array',
          'specialite.*' => 'exists:specialites,id',
         'moduleRattachement'=> 'required',
         'intituleCours'=> 'required',
         'code'=> 'required',
         'volumeHoraire'=> 'required',
         'coefficient'=> 'required',
         'observations'=> 'required'
        ]);

        

        $cours = new Cours();
        //$cours->specialite= $request->specialite; 
        $cours->moduleRattachement = $request->moduleRattachement;
        $cours->intituleCours= $request->intituleCours;
        $cours->code= $request->code;
        $cours->volumeHoraire= $request->volumeHoraire;
        $cours->coefficient= $request->coefficient; 
        $cours->observations= $request->observations;
        //$cours->specialite_id = $request->specialite;
       
        $cours->save();   
        // Associate specialités with the cours
        $cours->specialite()->attach($request->specialite);

        return redirect('/creer/ajouterCours')->with('status', 'le cours a bien ete ajouter avec succes');
      }
 */

 public function ajouterCours_cours_traitement(Request $request)
 {
     $request->validate([
         'specialite' => 'required|array',
         //'specialite.*' => 'exists:specialites,id',
         'specialite' => 'required',
         'moduleRattachement' => 'required',
         'intituleCours' => 'required',
         'volumeHoraire' => 'required',
         'coefficient' => 'required',
         'observations' => 'required',
         'formateur' => 'required',
          
     ]);
 
     $cours = new Cours();
     $cours->moduleRattachement = $request->moduleRattachement;
     $cours->intituleCours = $request->intituleCours;
     // Génération du code du cours
     $prefixe = strtolower(substr($request->intituleCours, 0, 4));
     $dernierNumero = (int) Cours::where('code', 'LIKE', $prefixe . '%')->max('code') ?? 0;
     $nouveauNumero = $dernierNumero + 1;
     $codeCours = $prefixe . str_pad($nouveauNumero, 2, '0', STR_PAD_LEFT);
 
     $cours->code = $codeCours;
     $cours->volumeHoraire = $request->volumeHoraire;
     $cours->coefficient = $request->coefficient;
     $cours->observations = $request->observations;
     $cours->specialite = $request->specialite;
     $cours->formateur = $request->formateur;
     $cours->publier = 0;



     $cours->fichier = "null" ;

     $cours->save();
     // Associate specialités with the cours
     //$cours->specialite()->attach($request->specialite);
 



       

     return redirect('/creer/ajouterCours')->with('status', 'Le cours a bien été ajouté avec succès');
 }

      public function updateCours_cours($id){
         $courss = Cours::find($id);
         $sessions = Session::all();
         $specialites = Specialite::all();
         return view('gestionnaire.cours.creer.updateCours', compact('courss', 'sessions', 'specialites'));
      }
      /*
      public function updateCours_cours_traitement(Request $request){
        $request->validate([
          'specialite' => 'required|array',
            'moduleRattachement' => 'required',
            'intituleCours' => 'required',
            'code' => 'required',
            'volumeHoraire' => 'required',
            'coefficient' => 'required',  // Corrected validation rule
            'observations' => 'required'
        ]);
    
        $cours = Cours::find($request->id);
        //$cours->specialite = $request->specialite; 
        $cours->moduleRattachement = $request->moduleRattachement;
        $cours->intituleCours = $request->intituleCours;
        $cours->code = $request->code;
        $cours->volumeHoraire = $request->volumeHoraire;
        $cours->coefficient = $request->coefficient;  // Corrected field name
        $cours->observations= $request->observations;
        //$cours->specialite_id = $request->specialite;
         
        $cours->update();  // Corrected save method
        $cours->specialite()->sync($request->specialite);
        return redirect('/creer/listeCours')->with('status', 'le cours a bien ete modifie avec succes');
    }
    */

    public function updateCours_cours_traitement(Request $request)
    {
        $request->validate([
            'specialite' => 'required|array',
            'moduleRattachement' => 'required',
            'intituleCours' => 'required',
            'code' => 'required',
            'volumeHoraire' => 'required',
            'coefficient' => 'required',
            'observations' => 'required',
            'syllabus' => 'required',
        ]);
    
        $cours = Cours::find($request->id);
    
        // Sync specialites first
        $cours->specialite()->sync($request->specialite);
    
        // Update other fields
        $cours->moduleRattachement = $request->moduleRattachement;
        $cours->intituleCours = $request->intituleCours;
        $cours->code = $request->code;
        $cours->volumeHoraire = $request->volumeHoraire;
        $cours->coefficient = $request->coefficient;
        $cours->observations = $request->observations;
        $cours->syllabus = $request->syllabus;
    
        // Save the changes
        $cours->save();
    
        return redirect('/creer/listeCours')->with('status', 'Le cours a bien été modifié avec succès');
    }
    

      public function deleteCours_cours ($id){
        $cours = Cours::find($id); 
        $cours->delete();
        return redirect('/creer/listeCours')->with('status', 'le cours a bien ete supprime avec succes');
      }
      public function generatePDFVi()
      {
        $courss = Cours::paginate(4);
      
          // Génération du PDF
          $pdf = FacadePdf::loadView('gestionnaire.cours.creer.pdf', compact('courss'))->setPaper('a4', 'landscape');
 
         // Optionally, you can save the PDF to a file
         $pdf->save(storage_path('pdf_Cours/pdfC_file.pdf'));
      
          // Téléchargement du PDF
          return $pdf->download('pdfC_file.pdf');
      }










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
