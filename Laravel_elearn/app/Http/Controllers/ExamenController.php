<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Examen;
use App\Models\Specialite;
use App\Models\Apprenant;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ExamenController extends Controller
{
    public function index()
    {
        $examens = Examen::all();
        $specialites = Specialite::pluck('nom');

        return view('gestionnaire.evaluations.examens.index', compact('examens', 'specialites'));
    }

    

    public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|max:2048', // Supprimer la règle mimes
        'heure_debut' => 'required|date',
        'heure_fin' => 'required|date|after_or_equal:heure_debut',
        'specialite' => 'required',
    ]);

    $file = $request->file('file');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->storeAs('examens', $filename, 'public');

    //je recupere tous les eleves dont la specialité est egale a la specialité que j'ai selectionné lors de la creation du quizz
    $apprenants = Apprenant::where('specialite', $request->specialite)->pluck('id')->toArray();
    $ids_apprenants = implode(',', $apprenants);
    //$examen->id_aprenants = $ids_apprenants;

    Examen::create([
        'filename' => $filename,
        'heure_debut' => $request->input('heure_debut'),
        'heure_fin' => $request->input('heure_fin'),
        'specialite' =>$request->input('specialite'),
        'id_apprenants' => $ids_apprenants,
    ]);

    return redirect()->route('examens.index')->with('success', 'Examen ajouté avec succès.');
}


    public function show($id)
    {
        $examen = Examen::findOrFail($id);
        
        // Vérifier si l'examen est dans la période autorisée
        if (now() >= $examen->heure_debut && now() <= $examen->heure_fin) {
            return view('gestionnaire.evaluations.examens.show', compact('examen'));
        } else {
            return redirect()->route('examens.index')->with('error', 'La période de téléchargement de l\'examen est expirée.');
        }
    }
    
    public function download($id)
    {
        $examen = Examen::findOrFail($id);
    
        $filePath = storage_path('app/public/examens/' . $examen->filename);
        return response()->download($filePath);
    }
    

    public function destroy($id)
{
    $examen = Examen::findOrFail($id);
    $filePath = storage_path('app/public/examens/' . $examen->filename);

    // Supprimer l'examen sans vérification de l'heure
    Storage::delete($filePath);
    $examen->delete();
    return redirect()->route('examens.index')->with('success', 'Examen supprimé avec succès.');
}

    public function update(Request $request, $id)
{
    $request->validate([
        'heure_debut' => 'required|date',
        'heure_fin' => 'required|date|after:heure_debut|date_equals_or_greater_than:2', // Ajout de la règle personnalisée
    ]);

    $examen = Examen::findOrFail($id);

    // ... Vous pouvez également ajouter des validations supplémentaires si nécessaire ...

    $examen->update([
        'heure_debut' => $request->input('heure_debut'),
        'heure_fin' => $request->input('heure_fin'),
    ]);

    return redirect()->route('examens.index')->with('success', 'Examen mis à jour avec succès.');
}
public function edit($id)
{
    $examen = Examen::findOrFail($id);
    return view('gestionnaire.evaluations.examens.edit', compact('examen'));
}

}
