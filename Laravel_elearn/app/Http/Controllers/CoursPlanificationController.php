<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoursPlanification;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB; 

class CoursPlanificationController extends Controller
{
    public function showForm()
    {
        $coursPlanifications = CoursPlanification::all();
        return view('gestionnaire.cours.planification.form', compact('coursPlanifications'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'seance' => 'required',
            'cours' => 'required',
            'formateur' => 'required',
            'formateur_assistant' => 'required',
            'site' => 'required',
            'jour' => 'required',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
        ]);

        CoursPlanification::create($request->all());

        return redirect('/planification/view')->with('success', 'Planification de cours créée avec succès.');
    }

    public function showView()
    {
        $coursPlanifications = CoursPlanification::all();
        return view('gestionnaire.cours.planification.view', compact('coursPlanifications'));
    }

    public function edit($id)
    {
        $coursPlanification = CoursPlanification::findOrFail($id);
        return view('gestionnaire.cours.planification.edit', compact('coursPlanification'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'seance' => 'required',
            'cours' => 'required',
            'formateur' => 'required',
            'formateur_assistant',
            'site' => 'required',
            'jour' => 'required',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
        ]);

        $coursPlanification = CoursPlanification::findOrFail($id);

        $coursPlanification->update($request->all());

        return redirect('/planification/view')->with('success', 'Planification de cours mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $coursPlanifications = CoursPlanification::findOrFail($id);
        $coursPlanifications->delete();
        return redirect('/planification/view')->with('success', 'Planification de cours supprimée avec succès.');
    }

   
    public function exportPDF($id)
    {
        $coursPlanification = CoursPlanification::findOrFail($id);
        $pdf = FacadePdf::loadView('gestionnaire.cours.planification.pdf', compact('coursPlanification'));
        return $pdf->download('planification_cours_' . $id . '.pdf');
    }
    
    public function synthese()
    {
        // Sélectionnez le formateur, le nombre de séances et le temps total planifié
        $syntheseCours = DB::table('cours_planifications')
                            ->select('formateur', 
                                     DB::raw('COUNT(*) as nombre_seances'),
                                     DB::raw('SUM(TIMESTAMPDIFF(MINUTE, heure_debut, heure_fin)) / 60 as temps_total_heures'))
                            ->groupBy('formateur')
                            ->get();
        
        return view('gestionnaire.cours.planification.synthese', compact('syntheseCours'));
    }
}
