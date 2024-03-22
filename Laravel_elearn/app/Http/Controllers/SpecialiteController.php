<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialite;
use App\Models\Apprenant;
use App\Models\ModuleSpecialite;
use Barryvdh\DomPDF\Facade as FacadePdf;
use Barryvdh\DomPDF\Facade\Pdf;

class SpecialiteController extends Controller
{
    public function apprenantsParSpecialite(Request $request)
    {
        $specialites = Specialite::all();
        $selectedSpecialite = $request->input('specialite_id');
        $apprenants = [];

        if ($selectedSpecialite) {
            $apprenants = Apprenant::where('specialite_id', $selectedSpecialite)->get();
        }

        return view('gestionnaire.specialites.apprenants-par-specialite', compact('specialites', 'apprenants', 'selectedSpecialite'));
    }

    public function showCreateSpecialiteForm()
    {
        return view('gestionnaire.specialites.create-specialite-form');
    }
/*
    public function createSpecialite(Request $request)
    {
        $request->validate([
            'nom' => 'required',
        ]);

        Specialite::create([
            'nom' => $request->nom,
        ]);

        return redirect('/create-specialite-form')->with('success', 'Spécialité créée avec succès.');
    }
*/
public function createSpecialite(Request $request)
{
    $request->validate([
        'nom' => 'required',
    ]);

    // Génération du code spécialité
    $prefixe = strtoupper(substr($request->nom, 0, 3));
    $dernierNumero = Specialite::max('code_specialite') ?? '00'; // Assurez-vous que le dernier numéro est une chaîne
    $nouveauNumero = str_pad((int)$dernierNumero + 1, 2, '0', STR_PAD_LEFT);
    $codeSpecialite = $prefixe . $nouveauNumero;

    Specialite::create([
        'nom' => $request->nom,
        'code_specialite' => $codeSpecialite,
    ]);

    return redirect('/create-specialite-form')->with('success', 'Spécialité créée avec succès.');
}

public function destroy($id)
{
    $specialite = Specialite::findOrFail($id);
    $specialite->delete();

    return redirect('/apprenants-par-session')->with('success', 'Spécialité supprimée avec succès.');
}

    public function exportPDF(Request $request)
    {
        $selectedSpecialite = $request->input('specialite_id');
        $apprenants = [];

        if ($selectedSpecialite) {
            $apprenants = Apprenant::where('specialite_id', $selectedSpecialite)->get();
        }

        $pdf = Pdf::loadView('gestionnaire.specialites.pdf', compact('apprenants'));
        $pdf->save(storage_path('pdf_Apprenant_Specialite/apprenants.pdf'));
        return $pdf->download('apprenants.pdf');
    }
}
