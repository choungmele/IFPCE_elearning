<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apprenant;
use App\Models\Session;
use App\Models\Specialite;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use PDF;

use Illuminate\Support\Facades\Mail;
use App\Models\Cours;
use App\Models\quizz;
use App\Models\question;
use App\Models\reponse;
use App\Models\Formateur;
use App\Models\gestionnaire;
use App\Models\Document;

use App\Models\Examen;
use App\Models\rendre;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;

use Illuminate\Support\Facades\View;


class ApprenantController extends Controller
{
    

    public function liste_apprenant(){
       $apprenants = Apprenant::paginate(4);
       
       // Récupérer vos données (supposons que $data est une collection de données)
      
        return view('gestionnaire.apprenant.liste', compact('apprenants'));
    }
   
    public function ajouter_apprenant()
{
    $sessions = Session::all();
    $specialites = Specialite::all();
   
    return view('gestionnaire.apprenant.ajouter', compact('sessions', 'specialites'));
}
const IFPCE = 'IFPCE';
public function ajouter_apprenant_trait(Request $request)
{
    $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'email' => 'required',
        'session' => 'required',
        'date_naissance' => 'required|date',
        'specialite' => 'nullable|string',
        'numero_cni' => 'nullable|string',
        'date_delivrance' => 'nullable|date',
        'telephone' => 'nullable|string',
        'numero_inscription' => 'nullable|string',
        'nom_personne_contact' => 'nullable|string',
        'numero_personne_contact' => 'nullable|string',
    ]);

    // Fetch speciality information from the database
    $selectedSpeciality = Specialite::find($request->specialite);

    // Check if the speciality exists
    if (!$selectedSpeciality) {
        return redirect('/ajouter')->with('error', 'La spécialité sélectionnée n\'existe pas.');
    }

    // Extract the first four letters of the speciality name (ignoring spaces) and limit it to 4 characters
    $specialiteCode = strtoupper(substr(str_replace(' ', '', $selectedSpeciality->nom), 0, 4));

    // Generate the matricule
    $inscriptionNumber = str_pad(Apprenant::count() + 1, 3, '0', STR_PAD_LEFT);
    $currentYear = date('y');
    $matricule = "E-$specialiteCode$inscriptionNumber$currentYear" . self::IFPCE;

     // Check if the email exists in the students table
     $student = Student::where('email', $request->email)->first();

     if ($student) {
         // Email exists in the students table, use the corresponding numero_inscription
         $numero_inscription = $student->numero_inscription;
     } else {
         // Email not found in the students table, return with an error message
         return redirect('/ajouter')->with('error', 'L\'adresse e-mail ne correspond à aucun apprenant.');
     }

    $apprenant = new Apprenant();
    $apprenant->nom = $request->nom;
    $apprenant->prenom = $request->prenom;
    $apprenant->email = $request->email;
    $apprenant->date_naissance = $request->date_naissance;
    $apprenant->matricule = $matricule;
    $apprenant->numero_cni = $request->numero_cni;
    $apprenant->date_delivrance = $request->date_delivrance;
    $apprenant->telephone = $request->telephone;
    $apprenant->numero_inscription = $request->numero_inscription;
    $apprenant->nom_personne_contact = $request->nom_personne_contact;
    $apprenant->numero_personne_contact = $request->numero_personne_contact;
    $apprenant->session_id = $request->session;
    $apprenant->specialite_id = $request->specialite;
    $apprenant->numero_inscription = $numero_inscription; 
    $apprenant->save();

    return redirect('/ajouter')->with('status', 'l\'étudiant a bien été ajouté avec succès');
}


/*
    public function ajouter_apprenant_traitement(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'session' => 'required',
            'date_naissance' => 'required|date',
            'specialite' => 'nullable|string',
            'matricule' => 'nullable|string',
            'numero_cni' => 'nullable|string',
            'date_delivrance' => 'nullable|date',
            'telephone' => 'nullable|string',
            'numero_inscription' => 'nullable|string',
            'nom_personne_contact' => 'nullable|string',
            'numero_personne_contact' => 'nullable|string',
        ]);

        $apprenant = new Apprenant();
        $apprenant->nom = $request->nom;
        $apprenant->prenom = $request->prenom;
        $apprenant->email = $request->email;
        $apprenant->date_naissance = $request->date_naissance;
        //$apprenant->specialite = $request->specialite;
        $apprenant->matricule = $request->matricule;
        $apprenant->numero_cni = $request->numero_cni;
        $apprenant->date_delivrance = $request->date_delivrance;
        $apprenant->telephone = $request->telephone;
        $apprenant->numero_inscription = $request->numero_inscription;
        $apprenant->nom_personne_contact = $request->nom_personne_contact;
        $apprenant->numero_personne_contact = $request->numero_personne_contact;
        $apprenant->session_id = $request->session;
        $apprenant->specialite_id = $request->specialite;
        $apprenant->save();

        return redirect('/ajouter')->with('status', 'l\'étudiant a bien été ajouté avec succès');
    }
*/
     public function update_apprenant($id){
      $apprenants = Apprenant::find($id);
      $sessions = Session::all(); // Add this line to fetch sessions
      return view('gestionnaire.apprenant.update', compact('apprenants', 'sessions'));
     }
     public function update_apprenant_traitement(Request $request){
      $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'email' => 'required',
        'session' => 'required',
        'date_naissance' => 'required|date',
        'specialite' => 'nullable|string',
        'matricule' => 'nullable|string',
        'numero_cni' => 'nullable|string',
        'date_delivrance' => 'nullable|date',
        'telephone' => 'nullable|string',
        'numero_inscription' => 'nullable|string',
        'nom_personne_contact' => 'nullable|string',
        'numero_personne_contact' => 'nullable|string',
    ]);

    $apprenant = Apprenant::find($request->id);
    $apprenant->nom = $request->nom;
    $apprenant->prenom = $request->prenom;
    $apprenant->email = $request->email;
    $apprenant->date_naissance = $request->date_naissance;
    //$apprenant->specialite = $request->specialite;
    $apprenant->matricule = $request->matricule;
    $apprenant->numero_cni = $request->numero_cni;
    $apprenant->date_delivrance = $request->date_delivrance;
    $apprenant->telephone = $request->telephone;
    $apprenant->numero_inscription = $request->numero_inscription;
    $apprenant->nom_personne_contact = $request->nom_personne_contact;
    $apprenant->numero_personne_contact = $request->numero_personne_contact;
    $apprenant->session_id = $request->session;
    $apprenant->specialite_id = $request->specialite; 
    $apprenant->update();

       return redirect('/liste')->with('status', 'l\'etudiant a bien ete modifie avec succes');
     }
     public function delete_apprenant ($id){
       $apprenant = Apprenant::find($id); 
       $apprenant->delete();
       return redirect('/liste')->with('status', 'l\'etudiant a bien ete supprime avec succes');
     }
     public function generatePDF()
     {
         $apprenants = Apprenant::paginate(4);
     
         // Génération du PDF
         $pdf = FacadePdf::loadView('gestionnaire.apprenant.pdf', compact('apprenants'))->setPaper('a4', 'landscape');

        // Optionally, you can save the PDF to a file
        $pdf->save(storage_path('pdf_Apprenant/pdfA_file.pdf'));
     
         // Téléchargement du PDF
         return $pdf->download('pdfA_file.pdf');
     }
     
  











     public function liste_quizz($id)
     {
         //je prend tous les quizz qui ont dans leur champ id_apprenant l'id de l'apprenant qui vient de se connecter et que le champ publier est egale à 1
         $quizz = quizz::whereRaw("FIND_IN_SET($id, id_apprenant)")->where('publier', 1)->get();
 
         //je recupere l'apprenant qi vient de se connecter
         $apprenant = apprenant::find($id);
 
         return view('gestionnaire.apprenant.liste_quizz',compact('quizz'),compact('apprenant'));
 
     }
 
     public function composer($id,$id_app)
     {
         //je prends toutes les questions dont le champ id_quizz est egal à l'id du quizz qui est representé par 'id' dans les parametres de la fonction
         $questions = question::where('id_quizz',$id)->get();
         $app = apprenant::find($id_app);
         $quiz = quizz::find($id);
 
         return view('gestionnaire.apprenant.qcm',compact('quiz','questions','app'));
     }
 
     public function corriger($id_quizz,$id_app,Request $request){
 
         //je recupere toutes les questions dont le champ id_quizz est egale a l'id du quizz passé en parametre
         $questions = question::whereRaw("FIND_IN_SET($id_quizz, id_quizz)")->get();
 
 
         /**ICI C'EST POUR VERIFIER S'IL A TRAITÉ TOUTES LES QUESTIONS */
 
         // Règles de validation personnalisées pour chaque question
         $rules = [];
         $messages = [];
         
         foreach ($questions as $question) {
             $rules['choix.' . $question->id] = 'required'; // Chaque choix par question est requis
             $messages['choix.' . $question->id . '.required'] = 'Vous devez répondre à la question : ' . $question->titre;
         }
 
         // Valider les réponses avec les règles personnalisées
         $request->validate($rules, $messages);
 
         if($request->errors){
             return redirect()->back()->withErrors($request->errors());
 
         }
 
 
         /*ICI C'EST POUR CALCULER LE SCORE DE L'APPRENANT POUR CE QUIZZ*/
 
          // Récupérer les réponses de l'utilisateur
         $reponsesUtilisateur = $request->input('choix');
 
         $score = 0;
 
         foreach ($questions as $question) {
             $idQuestion = $question->id;
             $reponseCorrecte = $question->correct;
 
             if(isset($reponsesUtilisateur[$idQuestion])){
                 if ($reponsesUtilisateur[$idQuestion] == $reponseCorrecte) {
                     $score++; // Incrémenter le score pour chaque réponse correcte
                 }
             }
         }
 
         /* ICI C'EST POUR SUPPRIMER L'ID DE L'APPRENANT DE LA LISTE DES ID DE CE QUIZZ */
 
         //je recherche le quizz en fonction de son id
         $quiz = quizz::find($id_quizz);
 
         $nom_quizz = $quiz->titre;
 
         //je recupere la liste des id des apprenants
         $idsApprenant = $quiz->id_apprenant;
 
         //je converti en tableau
         $idsArray = explode(',', $idsApprenant);
 
         //je supprime l'id de l'apprenant qui a soumis son qcm
         $idsArray = array_diff($idsArray, [$id_app]);
 
         //je reconstitue la chaine
         $idsApprenant = implode(',', $idsArray);
 
         //je mets a jour le champ id_apprenant
         $quiz->update(['id_apprenant' => $idsApprenant]);
 
         //je sauvegarde ma modification
         $quiz->save();
 
 
         /** ICI C'EST POUR STOCKER LES REPONSES DE L'UTILISATEUR DANS LA TABLE REPONSE */
 
         //je recupere l'objet apprenant en fonction de son id
         $apprenant = apprenant::find($id_app);
 
                 //je recupere son nom
                 $nom = $apprenant->nom;
 
                 //je recupere son prenom
                 $prenom = $apprenant->prenom;
 
         //je recupere le formateur en fonction de son id
         //$formateur = formateur::find($quiz->id_formateur);
 
                 //je recupere le numero de cni du formateur
                 $id_formateur = $quiz->id_formateur;
                 //je recupere la date actuelle
                 $date = Carbon::now()->toDateString(); 
             
         //je stocke le score de cet apprenant dans la table reponse ainsi que les autres informations
         $reponses = new reponse();
         $reponses->nom = $nom;
         $reponses->prenom = $prenom;
         $reponses->note = $score;
         $reponses->date = $date;
         $reponses->id_quizz = $id_quizz;
         $reponses->id_formateur = $id_formateur;
 
         $reponses->save();
         
 
         /** ICI C'EST POUR VERIFIER SI LA LISTE DES ID DES APPRENANTS EST VIDE ET ENVOYER LE FICHIER DES NOTES AU FORMATEUR*/
 
         if (empty($quiz->id_apprenant)) {
             //echo 'La liste des idsApprenant est vide.';
 
             //je recupere toutes le notes de la table reponse de ce quizz en fonction de l'id du quizz
             $reponses = reponse::whereRaw("FIND_IN_SET($id_quizz, id_quizz)")->get();
 
             // Créer une instance de Dompdf
             $options = new Options();
             $options->set('isHtml5ParserEnabled', true);
             $options->set('isRemoteEnabled', true);
             $pdf = new Dompdf($options);
 
             
             // Générer le contenu HTML du PDF
             $html = '<h1 style="text-align: center;">Note des étudiants du quizz ' . $nom_quizz . '</h1>';
             $html .= '<style>
                     table {
                         width: 100%;
                     }
                     th, td {
                         text-align: center;
                     }
                     th { color:blue;
                     }
                 </style>';
             $html .= '<table border="1">';
             //$html .= '<tr><td colspan="4" style="text-align: center; font-weight: bold;">' . $nom_quizz . '</td></tr>';
             $html .= '<tr><th>Nom</th><th>Prenom</th><th>Note</th><th>Date d\'envoie</th></tr>';
 
             foreach ($reponses as $reponse) {
                 $html .= '<tr><td>' . $reponse->nom . '</td><td>' . $reponse->prenom . '</td><td>' . $reponse->note . '</td><td>' . $reponse->date . '</td></tr>';
             }
 
             $html .= '</table>';
 
             // Charger le contenu HTML dans Dompdf
             $pdf->loadHtml($html);
 
             // Rendre le PDF
             $pdf->render();
 
             // Générer le nom du fichier PDF
             $nomFichier = 'reponses_quizz_' . time() . '.pdf';
 
 
                 // Créer le répertoire de destination s'il n'existe pas
                 $repertoireDestination = public_path('pdf');
                 if (!file_exists($repertoireDestination)) {
                     mkdir($repertoireDestination, 0755, true);
                 }
             
                 // Enregistrer le fichier PDF sur le serveur
                 $cheminFichier = $repertoireDestination . '/' . $nomFichier;
                 file_put_contents($cheminFichier, $pdf->output());
 
             // Enregistrer le fichier PDF sur le serveur
             //$cheminFichier = public_path('pdf/' . $nomFichier);
             //file_put_contents($cheminFichier, $pdf->output());
 
             /** ICI C'EST POUR ENVOYÉ LE FICHIER DES NOTES AU FORMATEUR AU CAS OU CET ELEVE EST LE DERNIER À COMPOSER */
 
             //Je recupere le formateur en fonction de son id
             $formateurs = Formateur::find($id_formateur);
 
             //je recupere l'email du formateur
             $destinataire = $formateurs->email;
 
             //je mets le fichier
             $contenu = $html;
 
             // Chemin vers le fichier PDF
             $cheminFichierPDF = $cheminFichier;
             
             // Envoi de l'email
             Mail::raw('Contenu du message', function ($message) use ($destinataire, $cheminFichierPDF) {
                 $message->to($destinataire);
                 $message->subject('Note des eleves ' );
                 $message->attach($cheminFichierPDF);
             });
 
 
             // Télécharger automatiquement le fichier PDF
             //return response()->download($cheminFichier, $nomFichier);
             return redirect()->route('apprenant.liste_quizz',$id_app)->with(['score' => $score, 'titre' => $quiz->titre, 'nombre' => $quiz->nombre]);
 
 
         } 
         else{
             return redirect()->route('apprenant.liste_quizz',$id_app)->with(['score' => $score, 'titre' => $quiz->titre, 'nombre' => $quiz->nombre]);
         }
 
     }
 
     public function modifier($id)
     {
         $specialites = specialite::pluck('nom');
         $apps = apprenant::find($id);
         return view('gestionnaire.apprenant.modifier', compact('apps', 'specialites'));
     }
 
     public function store_modif(Request $request,$id)
     {
         $request->validate([
             //pour dire que les champs sont requis
             'nom' => ['required', 'string', 'max:255'],
             'prenom' => ['required', 'string', 'max:255'],
             'naissance' => ['required','date'],
             'lieu' => ['required', 'string', 'max:255'],
             'pays' => ['required',  'string', 'max:255'],
             'ville' => ['required', 'string', 'max:255'],
             'password' => ['required', 'string', 'max:255'],
             'tel' => ['required', 'integer'],
             
             'email' => ['required', 'string', 'max:255'],
             'specialite' => ['required', 'string', 'max:255'],
             'personne' => ['required',  'string', 'max:255'],
             'cni' => ['required', 'integer'],
             'lien' => ['required',  'string', 'max:255'],
             'tel_pers' => ['required', 'integer'],
             'inscription' => ['required', 'integer'],
             
             
 
         ],);
 
 
 
 
         $existMail = apprenant::where('email', $request->email)->where('id', '!=', $id)->first();
         $existTel = apprenant::where('tel', $request->tel)->where('id', '!=', $id)->first();
         $existCni = apprenant::where('cni', $request->cni)->where('id', '!=', $id)->first();
 
         $existMail1 = formateur::where('email', $request->email)->where('id', '!=', $id)->first();
         $existTel1 = formateur::where('tel', $request->tel)->where('id', '!=', $id)->first();
         $existCni1 = formateur::where('cni', $request->cni)->where('id', '!=', $id)->first();
 
         $existMail2 = gestionnaire::where('email', $request->email)->where('id', '!=', $id)->first();
         $existTel2= gestionnaire::where('tel', $request->tel)->where('id', '!=', $id)->first();
         $existCni2 = gestionnaire::where('cni', $request->cni)->where('id', '!=', $id)->first();
 
 
 
         if($existMail || $existMail1 || $existMail2){
             return redirect()->back()->withErrors(['message' => 'Cet email existe déjà !']);
 
         }
         else if($existTel || $existTel1 || $existTel2){
             return redirect()->back()->withErrors(['message' => 'Ce numero de telephone  existe déjà !']);
 
         }
         else if($existCni || $existCni2 || $existCni1){
             return redirect()->back()->withErrors(['message' => 'Ce numéro de cni existe déjà !']);
 
         }
         else{
             $app = apprenant::find($id);
             $app->nom = $request->nom;
             $app->prenom = $request->prenom;
             $app->naissance = $request->naissance;
             $app->lieu = $request->lieu;
             $app->pays = $request->pays;
             $app->ville = $request->ville;
             $app->password = $request->password;
             $app->tel = $request->tel;
             $app->email = $request->email;
             $app->specialite = $request->specialite;
             $app->personne = $request->personne;
             $app->cni = $request->cni;
             $app->lien = $request->lien;
             $app->tel_pers = $request->tel_pers;
             $app->inscription = $request->inscription;
             $app->activer = 0;
             $app->code = "un code";
 
         if ($app->update()) 
         {
             //return redirect()->back()->withsuccess('informations enregistrés avec succès !');
             return redirect('/apprenant_liste')->with('status','Modifiacation reussie');
 
         } 
         else 
         {
             return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
         }
         }
         
     }
 
     public function rendre($id_app,$id_examen){
 
         $id_app = $id_app;
         $id_examen = $id_examen;
         $apprenant = apprenant::find($id_app);
 
         return view('examen.rendre',compact('id_app', 'id_examen', 'apprenant'));
     }
 
     public function do_rendre(Request $request, $id_app, $id_examen){
 
         $request->validate([
 
             'photo' => ['required'],
 
         ],);
 
 
 
         $examen = Examen::find($id_examen);

 
 
         $apprenant = apprenant::find($id_app);
         $nom = $apprenant->nom;
         $prenom = $apprenant->prenom;
         $nom_app = $nom . ' ' . $prenom;//je concate sa pour avoir nom et prenom dans une seule chaine
 
 
         $nomFichierOriginal = $request->file('photo')->getClientOriginalName();
         $imagePath = $request->file('photo')->storeAs('cours/fichiers', $nomFichierOriginal,'public');
         
         $date = Carbon::now()->toDateString(); 
 
         $rendre = new rendre();
         $rendre->id_apprenant = $id_app;
         $rendre->nom_apprenant = $nom_app;
         $rendre->id_examen = $id_examen;
         $rendre->fichier = $imagePath ;
         $rendre->date_envoie = $date;
 
 
         
         if ($rendre->save()) 
         {
              /* ICI C'EST POUR SUPPRIMER L'ID DE L'APPRENANT DE LA LISTE DES ID DE CET EXAMEN */
 
 
 
                 //je recupere la liste des id des apprenants
                 $idsApp = $examen->id_apprenants;
 
                 //je converti en tableau
                 $idsArray = explode(',', $idsApp);
 
                 //je supprime l'id de l'apprenant qui a soumis son qcm
                 $idsArray = array_diff($idsArray, [$id_app]);
 
                 //je reconstitue la chaine
                 $idsApp = implode(',', $idsArray);
 
                 //je mets a jour le champ id_apprenant
                 $examen->update(['id_apprenants' => $idsApp]);
 
                 
 
             //return redirect()->back()->withsuccess('devoir envoyé avec succès !');
             //return redirect('/apprenant_liste_examen/{id_app}')->with('status','email envoyé avec succes');
             return redirect()->route('apprenant.liste_examen',$id_app)->with(['message' => 'Devoir envoyé avec succes']);
 
         } 
         else 
         {
             return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
         }
 
     }


     public function liste_cours($id){


        $apprenant = apprenant::find($id);

        $cour = Cours::where('specialite',$apprenant->specialite)->where('publier',0)->get();
    
        return view('gestionnaire.apprenant.liste_cour',compact('apprenant', 'cour'));
        
    }

    public function liste_examen($id){

        $apprenant = Apprenant::find($id);
        $examens = Examen::where('specialite', $apprenant->specialite)->whereRaw("FIND_IN_SET($apprenant->id, id_apprenants)")->get();

        return view('gestionnaire.apprenant.liste_examen', compact('apprenant', 'examens'));
    }

public function ressources($id){

    $apprenant = Apprenant::find($id);
    $documents = Document::where('specialite', $apprenant->specialite)->get();
    return view('gestionnaire.apprenant.ressource', compact('apprenant', 'documents'));

}

public function showDocuments()
{
   $documents = Document::all();
   return view('gestionnaire.cours.publier.documents', compact('documents'));
}

}
