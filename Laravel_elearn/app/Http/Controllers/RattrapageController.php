<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rattrapage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class RattrapageController extends Controller
{
    public function accueil()
    {
        $rattrapages = Rattrapage::all();
        return view('gestionnaire.evaluations.rattrapages.accueil', compact('rattrapages'));
    }
    
    public function create()
    {
        return view('gestionnaire.evaluations.rattrapages.create');
    }
    /*
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:xlsx,docx,pptx,pdf',
            'publish_at' => 'required|date',
        ]);
    
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        
        // Générer un nom de fichier unique avec la date actuelle et l'extension
        $customFileName = 'nom_personnalise_' . Carbon::now()->format('YmdHis') . '.' . $extension;
    
        // Stockez le fichier avec le nom personnalisé
        $filePath = $file->storeAs('public/rattrapages', $customFileName);
    
        // Créez une entrée de rattrapage dans la base de données
        $rattrapage = new Rattrapage([
            'title' => $request->input('title'),
            'file_path' => $filePath,
            'publish_at' => $request->input('publish_at'),
        ]);
        $rattrapage->save();
    
        return redirect()->route('rattrapages.accueil')->with('success', 'Épreuve de rattrapage ajoutée avec succès.');
    }
*/
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'file' => 'required|file|mimes:xlsx,docx,pptx,pdf',
        'publish_at' => 'required|date',
    ]);

    $file = $request->file('file');
    
    // Obtenez le nom d'origine du fichier
    $originalFileName = $file->getClientOriginalName();
    
    // Stockez le fichier avec le nom d'origine
    $filePath = $file->storeAs('public/rattrapages', $originalFileName);

    // Créez une entrée de rattrapage dans la base de données avec le chemin du fichier
    $rattrapage = new Rattrapage([
        'title' => $request->input('title'),
        'file_path' => $filePath,
        'publish_at' => $request->input('publish_at'),
    ]);
    $rattrapage->save();

    return redirect()->route('rattrapages.accueil')->with('success', 'Épreuve de rattrapage ajoutée avec succès.');
}


    public function edit($id)
    {
        $rattrapage = Rattrapage::findOrFail($id);
        return view('gestionnaire.evaluations.rattrapages.edit', compact('rattrapage'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'file',
            'publish_at' => 'required|date',
        ]);

        $rattrapage = Rattrapage::findOrFail($id);

        // Si un nouveau fichier est téléchargé, remplacez l'ancien fichier
        if ($request->hasFile('file')) {
            Storage::delete($rattrapage->file_path); // Supprimez l'ancien fichier
            $file = $request->file('file');
            $filePath = $file->store('rattrapages');
            $rattrapage->file_path = $filePath;
        }

        $rattrapage->title = $request->input('title');
        $rattrapage->publish_at = $request->input('publish_at');
        $rattrapage->save();

        return redirect()->route('rattrapages.accueil')->with('success', 'Épreuve de rattrapage mise à jour avec succès.');
    }
    public function destroy($id)
{
    $rattrapage = Rattrapage::findOrFail($id);
    
    // Supprimer le fichier associé s'il existe
    if ($rattrapage->file_path) {
        Storage::delete($rattrapage->file_path);
    }

    $rattrapage->delete();

    return redirect()->route('rattrapages.accueil')->with('success', 'Épreuve de rattrapage supprimée avec succès.');
}


}
