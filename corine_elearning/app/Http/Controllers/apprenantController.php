<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\specialite;
use App\Models\apprenant;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\cours;
use App\Models\quizz;
use App\Models\question;
use App\Models\reponse;
use App\Models\formateur;
use App\Models\gestionnaire;
use App\Models\examen;
use App\Models\rendre;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;


class apprenantController extends Controller
{
    //

    public function login(){

        return view('apprenants.login');
    }


    public function login_apprenant(Request $request)
    {

        $this->validate($request, [
            // 'gestion$apprenantname' => ['required', 'string', 'max:2'
            'email' => ['required', 'string', 'email', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'password' => 'required|min:7',
        ], [
            'email.required'   => ' Le Champ email est requis',
            'password.required'   => 'Le champ mot de passe est requis',
            'password.min' => 'Le mot de passe doit etre > à 7 caractères',
        ]);

        $apprenant = apprenant::where('email', $request->input('email'))->first();

        if($apprenant){

            if($request->input('password') === $apprenant->password){

                if($apprenant->valider == 1 )
                {


                    if($apprenant->activer == 0)
                    {
                        $apprenant = apprenant::where('email', $request->input('email'))
                        ->where('password', $request->input('password'))
                        ->first();
    
                        Session::put('manager_name', $apprenant->nom);
                        Session::put('manager_prenom', $apprenant->prenom);

                        $cour = cours::where('specialite',$apprenant->specialite)->where('publier',1)->get();
    
                        return view('apprenants.dashboard',compact('apprenant'),compact('cour'));
                    }
                    else
                    {
                        //return('votre compte a été desactiveé,veuillez contacter la direction !!!!');
                        return back()->withInput()->withErrors(['status'=>'votre compte a été desactiveé,veuillez contacter la direction !!!!']);

                    }
                   
                }

                else
                {
                    //return('votre compte est encore en attente de validation !!!!');
                    return back()->withInput()->withErrors(['status'=>'votre compte est encore en attente de validation !!!!']);

                }

                
            }
            else{
                //return ('mot de passe incorrect');
                return back()->withInput()->withErrors(['status'=>'Mot de passe incorrect!!!!']);

            }
        }
        else{
            //return ('pas de compte avec cet email');
            return back()->withInput()->withErrors(['status'=>'pas de compte avec cet email !!!!']);

            }
    }



    public function liste_cours($id){


        $apprenant = apprenant::find($id);

        $cour = cours::where('specialite',$apprenant->specialite)->where('publier',1)->get();
    
        return view('apprenants.liste_cour',compact('apprenant', 'cour'));
        
    }

    public function liste_examen($id){

        $apprenant = apprenant::find($id);
        $examen = examen::where('specialite', $apprenant->specialite)->where('publier', 1)->whereRaw("FIND_IN_SET($apprenant->id, id_apprenants)")->get();

        return view('apprenants.liste_examen', compact('apprenant', 'examen'));
    }

    public function register(){

        $specialites = specialite::pluck('nom');
        return view('apprenants.register',compact('specialites'));
    }

    public function register2(){

        $specialites = specialite::pluck('nom');
        return view('apprenants.register2',compact('specialites'));
    }

    public function store(Request $request)
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




        $existMail = apprenant::where('email', $request->email)->first();
        $existTel = apprenant::where('tel', $request->tel)->first();
        $existCni = apprenant::where('cni', $request->cni)->first();

        $existMail1 = formateur::where('email', $request->email)->first();
        $existTel1 = formateur::where('tel', $request->tel)->first();
        $existCni1 = formateur::where('cni', $request->cni)->first();

        $existMail2 = gestionnaire::where('email', $request->email)->first();
        $existTel2= gestionnaire::where('tel', $request->tel)->first();
        $existCni2 = gestionnaire::where('cni', $request->cni)->first();



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
            $app = new apprenant();
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
        $app->valider = 0;
        $app->code = "un code";

        if ($app->save()) 
        {
            return redirect()->back()->withsuccess('informations enregistrés avec succès !');
        } 
        else 
        {
            return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
        }
        }

        
    }

    public function postulants(){

        $data = apprenant::where('valider', 0)->where('activer',0)->orderBy('nom', 'asc')->get();
        return view('apprenants.postulants',compact('data'));

    }

    public function liste(){

        $data = apprenant::where('valider', 1)->where('activer',0)->orderBy('nom', 'asc')->get();
        return view('apprenants.liste',compact('data'));

    }

    public function liste_desactiver()
    {
        $data = apprenant::where('valider', 1)->where('activer',1)->orderBy('nom', 'asc')->get();
        return view('apprenants.desactiver',compact('data'));
    }

    public function desactiver(Request $request,$id)
    {
        /*$app = apprenant::find($id);

        $app->activer = 1;
        $app->update();*/

        $request->validate([
            //pour dire que les champs sont requis
            //'objet' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:255'],

        ],);

        //je récupère l'apprenant dans la BD
        $app = apprenant::find($id);

        //je récupère l'email
        $recepteur = $app->email;

        // Adresse email du destinataire
        $destinataire = $recepteur;

        // Contenu de l'email
        $contenu = $request->message;

        $app->activer = 1;

        // Envoi de l'email
        Mail::raw($contenu, function ($message) use ($destinataire) {
            $message->to($destinataire);
            $message->subject('Desactivation de votre compte IFPCE');
        });

        $app->update();

        return redirect('/apprenant_liste')->with('status','email envoyé avec succes');

    }

    public function supprimer(Request $request,$id)
    {
        /*$app = apprenant::find($id);
        $app->delete();*/


        $request->validate([
            //pour dire que les champs sont requis
            //'objet' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:255'],

        ],);

        //je récupère l'apprenant dans la BD
        $app = apprenant::find($id);

        //je récupère l'email
        $recepteur = $app->email;

        // Adresse email du destinataire
        $destinataire = $recepteur;

        // Contenu de l'email
        $contenu = $request->message;

        // Envoi de l'email
        Mail::raw($contenu, function ($message) use ($destinataire) {
            $message->to($destinataire);
            $message->subject('Suppression de votre compte IFPCE');
        });

        $app->delete();


        return redirect('/apprenant_liste')->with('status','email envoyé avec succes');

    }

    public function activer(Request $request,$id)
    {
        /*$app = apprenant::find($id);
        $app->activer = 0;
        $app->update();*/


        $request->validate([
            //pour dire que les champs sont requis
            //'objet' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:255'],

        ],);

        //je récupère l'apprenant dans la BD
        $app = apprenant::find($id);

        //je récupère l'email
        $recepteur = $app->email;

        // Adresse email du destinataire
        $destinataire = $recepteur;

        // Contenu de l'email
        $contenu = $request->message;

        $app->activer = 0;

        // Envoi de l'email
        Mail::raw($contenu, function ($message) use ($destinataire) {
            $message->to($destinataire);
            $message->subject('Activation de votre compte IFPCE');
        });

        $app->update();

        return redirect('/apprenant_liste')->with('status','email envoyé avec succes');

    }


    public function show_supprimer($id)
    {
        $app = apprenant::find($id);
        return view('apprenants.mail_supprimer',compact('app'));
    }

    public function show_desactiver($id)
    {
        $app = apprenant::find($id);
        return view('apprenants.mail_desactiver',compact('app'));
    }

    public function show_activer($id)
    {
        $app = apprenant::find($id);
        return view('apprenants.mail_activer',compact('app'));
    }

    public function liste_quizz($id)
    {
        //je prend tous les quizz qui ont dans leur champ id_apprenant l'id de l'apprenant qui vient de se connecter et que le champ publier est egale à 1
        $quizz = quizz::whereRaw("FIND_IN_SET($id, id_apprenant)")->where('publier', 1)->get();

        //je recupere l'apprenant qi vient de se connecter
        $app = apprenant::find($id);

        return view('apprenants.liste_quizz',compact('quizz'),compact('app'));

    }

    public function composer($id,$id_app)
    {
        //je prends toutes les questions dont le champ id_quizz est egal à l'id du quizz qui est representé par 'id' dans les parametres de la fonction
        $questions = question::where('id_quizz',$id)->get();
        $app = apprenant::find($id_app);
        $quiz = quizz::find($id);

        return view('apprenants.qcm',compact('quiz','questions','app'));
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
            $formateurs = formateur::find($id_formateur);

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
        return view('apprenants.modifier', compact('apps', 'specialites'));
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



        $examen = examen::find($id_examen);
        $session = $examen->session;

        $nom_formateur = $examen->formateur;
        $nom_exam = $examen->titre;


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
        $rendre->id_formateur = $examen->id_formateur;
        $rendre->nom_formateur = $nom_formateur;
        $rendre->id_examen = $id_examen;
        $rendre->titre_examen = $nom_exam;
        $rendre->fichier = $imagePath ;
        $rendre->date_envoie = $date;
        $rendre->session = $session;


        
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
}


