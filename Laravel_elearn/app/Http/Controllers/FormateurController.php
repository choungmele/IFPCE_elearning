<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formateur;
use App\Models\rendre;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB;
class FormateurController extends Controller
{
    public function listeF_formateur(){
        $formateurs = Formateur::paginate(4);
        // Récupérer vos données (supposons que $data est une collection de données)
       
         return view('gestionnaire.formateur.listeF', compact('formateurs'));
     }
     public function ajouterF_formateur(){
         return view('gestionnaire.formateur.ajouterF');
     }
 
     public function ajouterF_formateur_traitement(Request $request)
     {
         $request->validate([
             'nom' => 'required',
             'prenom' => 'required',
             'email' => 'required|email',
             'date_naissance' => 'nullable|date',
             'telephone' => 'nullable|string',
             'cours_dispense' => 'nullable|string',
             'numero_cni' => 'nullable|string',
             'date_delivrance' => 'nullable|date',
         ]);
 
         $currentYear = date('y'); // Get the last two digits of the current year
         $firstTwoLettersOfNom = substr($request->nom, 0, 2); // Get the first two letters of the last name
 
         // Generate the matricule in the format F-AANNIFPCE
         $matricule = 'F-' . $firstTwoLettersOfNom . $currentYear . 'IFPCE';
 
         $formateur = new Formateur();
         $formateur->nom = $request->nom;
         $formateur->prenom = $request->prenom;
         $formateur->email = $request->email;
         $formateur->date_naissance = $request->date_naissance;
         $formateur->telephone = $request->telephone;
         $formateur->cours_dispense = $request->cours_dispense;
         $formateur->numero_cni = $request->numero_cni;
         $formateur->date_delivrance = $request->date_delivrance;
         $formateur->matricule = $matricule; // Add the generated matricule
         $formateur->save();
 
         return redirect('/ajouterF')->with('status', 'le formateur a bien été ajouté avec succès');
     }
 
      public function updateF_formateur($id){
        $formateurs = Formateur::find($id);
         return view('gestionnaire.formateur.updateF', compact('formateurs'));
      }
      public function updateF_formateur_traitement(Request $request){
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'date_naissance' => 'nullable|date',
            'telephone' => 'nullable|string',
            'cours_dispense' => 'nullable|string',
            'numero_cni' => 'nullable|string',
            'date_delivrance' => 'nullable|date',
        ]);
    
        $formateur = Formateur::find($request->id);
        $formateur->nom = $request->nom;
        $formateur->prenom = $request->prenom;
        $formateur->email = $request->email;
        $formateur->date_naissance = $request->date_naissance;
        $formateur->telephone = $request->telephone;
        $formateur->cours_dispense = $request->cours_dispense;
        $formateur->numero_cni = $request->numero_cni;
        $formateur->date_delivrance = $request->date_delivrance;
        $formateur->update();
    
        return redirect('/listeF')->with('status', 'le formateur a bien été modifié avec succès');
    }
    
      public function deleteF_formateur ($id){
        $formateur = Formateur::find($id); 
        $formateur->delete();
        return redirect('/listeF')->with('status', 'le formateur a bien ete supprime avec succes');
      }
      public function generatePDFV()
      {
          $formateurs = Formateur::paginate(4);
      
          // Génération du PDF
          $pdf = FacadePdf::loadView('gestionnaire.formateur.pdf', compact('formateurs'))->setPaper('a4', 'landscape');
 
         // Optionally, you can save the PDF to a file
         $pdf->save(storage_path('pdf_Formateur/pdfF_file.pdf'));
      
          // Téléchargement du PDF
          return $pdf->download('pdfF_file.pdf');
      }

      public function liste_rendu()
      {
        $rendus = rendre::all();

        return view('gestionnaire.evaluations.rendu', compact('rendus'));

      }
}
