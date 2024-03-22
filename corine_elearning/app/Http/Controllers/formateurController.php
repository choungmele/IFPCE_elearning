<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\formateur;
use Illuminate\Support\Facades\Log;
use App\Models\domaine;
use App\Models\apprenant;
use App\Models\gestionnaire;

use finfo;



class formateurController extends Controller
{
    //

    public function create_formateur(){

        $domaines = domaine::all();
        return view('formateur.create',compact('domaines'));
    }

     //fonction qui permet de sauvegarder les données d'un formateur
     public function store_formateur(Request $request)
     {
 

        


         $request->validate([
             //pour dire que les champs sont requis
             'nom' => ['required', 'string', 'max:255'],
             'prenom' => ['required', 'string', 'max:255'],
             'naissance' => ['required'],
             'ville' => ['required', 'string', 'max:255'],
             'quartier' => ['required',  'string', 'max:255'],
             'tel' => ['required', 'integer'],
             'cni' => ['required', 'integer'],
             'mail' => ['required' ,'string', 'max:255'],
             'password' => ['required', 'string', 'max:255'],
             'photo' => ['required'],
             'domaine' => ['required', 'string', 'max:255'],

 
         ], [
             'nom.required' => 'Le champ nom est requis.',
             'prenom.required' => 'Le champ prenom est requis.',
             'naissance.required' => 'Le champ date de naissance est requis.',
             'ville.required' => 'Le champ ville est requis.',
             'quartier.required' => 'Le champ quartier est requis.',
             'tel.integer' => 'Le champ taille doit être un chiffre.',
             'tel.required' => 'Le champ tel est requis.',
             'cni.integer' => 'Le champ numéro de la cni doit être un chiffre.',
             'cni.required' => 'Le champ cni est requis.',
             'mail.required' => 'Le champ email est requis.',
             'password.required' => 'Le champ mot de passe est requis.',
             'photo.required' => 'Le champ photo est requis.',
         ]);



 
         $format = new formateur();
         $format->nom = $request->nom;
         $format->prenom = $request->prenom;
         $format->naissance = $request->naissance;
         $format->ville = $request->ville;
         $format->quartier = $request->quartier;
         $format->tel = $request->tel;
         $format->cni = $request->cni;
         $format->email = $request->mail;
         $format->domaine = $request->domaine;
         $format->password = $request->password;

         $imagePath = $request->file('photo')->store('images/formateur', 'public');


         $format->photo = $imagePath ;
 
         if ($format->save()) 
         {
             return redirect()->back()->withsuccess('formateur crée avec succès !');
         } 
         else 
         {
             return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
         }
     }


     //fonction pour lister les formateurs
    public function formateur_List()
    {
        $formateurs = formateur::all();

        return view('formateur.liste', compact('formateurs'));
    }

    public function delete($id){

        $formateur = formateur::find($id);
        $formateur->delete();

        return redirect('/formateur/Liste')->with('message','suppression réussi');

    }

    public function modifier($id){

        $format = formateur::find($id);
        $domaines = domaine::all();

        return view('formateur.modifier',compact('format', 'domaines'));
    }

    public function store_modif(Request $request,$id){

        $request->validate([
            //pour dire que les champs sont requis
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'naissance' => ['required','date'],
            'ville' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'integer'],
            
            'mail' => ['required', 'string', 'max:255'],
            'domaine' => ['required', 'string', 'max:255'],
            'quartier' => ['required',  'string', 'max:255'],
            'cni' => ['required', 'integer'],
            
            

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
            $form = formateur::find($id);
            $form->nom = $request->nom;
            $form->prenom = $request->prenom;
            $form->naissance = $request->naissance;
            $form->cni = $request->cni;
            $form->quartier = $request->quartier;
            $form->ville = $request->ville;
            $form->password = $request->password;
            $form->tel = $request->tel;
            $form->email = $request->mail;
            $form->domaine = $request->domaine;
            

        if ($form->update()) 
        {
            //return redirect()->back()->withsuccess('informations enregistrés avec succès !');
            return redirect('/formateur/Liste')->with('status','Modifiacation reussie');

        } 
        else 
        {
            return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
        }
        }
    }
}
