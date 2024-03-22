<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apprenant;
use App\Models\Session;
use App\Models\Specialite;
use App\Models\Student;
use Symfony\Component\Routing\Annotation\Route;
class Apprenant_adminController extends Controller
{
    public function ajouter_apprenant($id)
    {
        $sessions = Session::all();
        $specialites = Specialite::all();
        $apprenant = Apprenant::find($id);
       
        return view('apprenants.apprenant.ajouterA', compact('sessions', 'specialites', 'apprenant'));
    }
    const IFPCE = 'IFPCE';
    public function ajouter_apprenant_traitement(Request $request)
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
            return redirect('/ajouterA')->with('error', 'La spécialité sélectionnée n\'existe pas.');
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
             return redirect('/ajouterA')->with('error', 'L\'adresse e-mail ne correspond à aucun apprenant.');
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
        //je recpere la specialite dont l'id a ete selectionner dans le champ
        $spec = Specialite::find($request->specialite);
        $apprenant->specialite = $spec->nom;
        $apprenant->save();
    
        return redirect('/ajouterA')->with('status', 'vous avez  bien été ajouté avec succès');
    }

   
     

    public function update_apprenant($id){
        $apprenants = Apprenant::find($id);
        $sessions = Session::all(); // Add this line to fetch sessions
        return view('apprenants.apprenant.updateA', compact('apprenants', 'sessions'));
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
  
         return redirect('/apprenants/dashboard')->with('status', 'l\'etudiant a bien ete modifie avec succes');
       }
}
