<?php

namespace App\Http\Controllers;
use App\Models\programmationCours;
use App\Models\Session;
use App\Models\Specialite;
use App\Models\Cours;
use App\Models\Formateur;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class programmationCoursController extends Controller
{
    public function listeProgram_programmationCours(){
        $programmations = ProgrammationCours::paginate(4);
        // Récupérer vos données (supposons que $data est une collection de données)
        return view('gestionnaire.cours.programmer.listeProgram', ['programmations' => $programmations]);
        // return view('gestionnaire.cours.programmer.listeProgram', compact('programmations'));
       
       
     }
     public function ajouterProgram_programmationCours(){
      $sessions = Session::all();
      $specialites = Specialite::all();
      $courss = Cours::all('intituleCours');
      
         return view('gestionnaire.cours.programmer.ajouterProgram', compact('sessions', 'specialites', 'courss'));
     }
 
     public function ajouterProgram_programmationCours_traitement(Request $request){
        $request->validate([
         'session'=> 'required',
         'specialite'=> 'required',
         'intituleCours'=> 'required',
         'code'=> 'required',
         'formateur' => 'required',
         'formateurs' => 'required',
         'volumeHoraire'=> 'required',
         'debut' => 'required|date',
         'fin' => 'required|date|after:debut',
         'observations'=> 'required'
        ]);

        $programmationCours = new ProgrammationCours();
        //$programmationCours->session= $request->session;
        //$programmationCours->specialite= $request->specialite; 
        $programmationCours->intituleCours= $request->intituleCours;
        $programmationCours->code= $request->code;
        $programmationCours->formateur = $request->formateur;
        $programmationCours->formateurs = $request->formateurs;
        $programmationCours->volumeHoraire= $request->volumeHoraire;
        $programmationCours->debut = $request->debut;
        $programmationCours->fin = $request->fin;
        $programmationCours->observations= $request->observations;
        $programmationCours->session_id = $request->session;
        $programmationCours->specialite_id = $request->specialite;
       
        
        $programmationCours->save();   
 
        return redirect('/programmer/ajouterProgram')->with('status', 'le cours a bien ete ajouter avec succes');
      }
 
      public function updateProgram_programmationCours($id){
         $programmations = ProgrammationCours::find($id);
         $sessions = Session::all();
         $courss = Cours::all('intituleCours');
         return view('gestionnaire.cours.programmer.updateProgram', compact('programmations', 'sessions', 'courss'));
      }
      public function updateProgram_programmationCours_traitement(Request $request){
        $request->validate([
            'session'=> 'required',
            'specialite'=> 'required',
            'intituleCours'=> 'required',
            'code'=> 'required',
            'formateur' => 'required',
            'formateurs' => 'required',
            'volumeHoraire'=> 'required',
            'debut' => 'required|date',
         'fin' => 'required|date|after:debut',
            'observations'=> 'required'
        ]);
    
        $programmationCours = ProgrammationCours::find($request->id);
       // $programmationCours->session= $request->session;
       // $programmationCours->specialite= $request->specialite; 
        $programmationCours->intituleCours= $request->intituleCours;
        $programmationCours->code= $request->code;
        $programmationCours->formateur = $request->formateur;
        $programmationCours->formateurs = $request->formateurs;
        $programmationCours->volumeHoraire= $request->volumeHoraire;
        $programmationCours->debut = $request->debut;
        $programmationCours->fin = $request->fin; 
        $programmationCours->observations= $request->observations;
        $programmationCours->session_id = $request->session;
        $programmationCours->specialite_id = $request->specialite;
       
       
        $programmationCours->update();  // Corrected save method
    
        return redirect('/programmer/listeProgram')->with('status', 'le cours a bien ete modifie avec succes');
    }

    public function getCode(Request $request)
    {
        $intituleCours = $request->get('intituleCours');
        $courss = Cours::where('intituleCours', $intituleCours)->first();
        if ($courss) {
            return response()->json(['code' => $courss->code]);
        } else {
            return response()->json(['code' => '']);
        }
    }
    
      public function deleteProgram_programmationCours ($id){
        $programmationCours = ProgrammationCours::find($id); 
        $programmationCours->delete();
        return redirect('/programmer/listeProgram')->with('status', 'le cours a bien ete supprime avec succes');
      }
      public function generatePDFView()
{
    $programmations = ProgrammationCours::paginate(4);

    // Génération du PDF avec orientation paysage (landscape)
    $pdf = FacadePdf::loadView('gestionnaire.cours.programmer.pdf', compact('programmations'))->setPaper('a4', 'landscape');

    // Optionnel : vous pouvez sauvegarder le PDF dans un fichier
    $pdf->save(storage_path('pdf_Program/pdf_file.pdf'));

    // Téléchargement du PDF
    return $pdf->download('pdf_file.pdf');
}

}
