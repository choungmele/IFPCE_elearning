<?php

namespace App\Http\Controllers;

use App\Models\Specialite;
use App\Models\ModuleSpecialite;
use Illuminate\Http\Request;

class ModuleSpecialiteController extends Controller
{
    public function create()
    {
        $specialites = Specialite::all();
        
        return view('gestionnaire.modules.create', compact('specialites'));
    }
/*
    public function store(Request $request)
    {
        $request->validate([
            'specialite_id' => 'required|exists:specialites,id',
            'nom' => 'required|string',
            'code' => 'required|string',
            // Ajoutez la validation pour d'autres champs
        ]);

        ModuleSpecialite::create($request->all());

        return redirect()->route('list');
    }
*/




public function store(Request $request)
{
    $request->validate([
        'specialite_id' => 'required|exists:specialites,id',
        'nom' => 'required|string',
        // 'code' => 'required|string', // Ne pas demander le code lors de la création
        // Ajoutez la validation pour d'autres champs
    ]);

    // Génération du code du module
    $specialite = Specialite::findOrFail($request->specialite_id);
    $prefixe = strtolower(substr($request->nom, 0, 4));
    $dernierNumero = (int) ModuleSpecialite::where('code', 'LIKE', $prefixe . '%')->max('code') ?? 0;
    $nouveauNumero = $dernierNumero + 1; // Convertir en entier avant l'addition
    $codeModule = $prefixe . str_pad($nouveauNumero, 2, '0', STR_PAD_LEFT);

    ModuleSpecialite::create([
        'specialite_id' => $request->specialite_id,
        'nom' => $request->nom,
        'code' => $codeModule,
        // Ajoutez d'autres champs
    ]);

    return redirect('/list');
}

    public function list()
    {
        $modules = ModuleSpecialite::with('specialite')->get();
        return view('gestionnaire.modules.list', compact('modules'));
    }
    
    // Implémentez d'autres méthodes (modifier, supprimer, etc.) au besoin
    
    
    public function editer($id)
{
    $module = ModuleSpecialite::findOrFail($id);
    $specialites = Specialite::all();
    return view('gestionnaire.modules.editer', compact('module', 'specialites'));
}

public function mettreAJour(Request $request, $id)
{
    $request->validate([
        'specialite_id' => 'required|exists:specialites,id',
        'nom' => 'required|string',
        'code' => 'required|string',
        // Ajoutez la validation pour d'autres champs
    ]);

    $module = ModuleSpecialite::findOrFail($id);
    $module->update($request->all());

    return redirect()->route('list');
}

public function supprimer($id)
{
    $module = ModuleSpecialite::findOrFail($id);
    $module->delete();

    return redirect('/list');
}
}

