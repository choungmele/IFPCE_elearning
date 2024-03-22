<?php

namespace App\Http\Controllers;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\Specialite;

class DocumentController extends Controller
{
    public function showUploadForm()
    {
        //$document = Document::all();
        $specialites = Specialite::pluck('nom');

        return view('gestionnaire.cours.publier.upload',compact('specialites'));
    }

    public function uploadDocument(Request $request)
    {
        $request->validate([
            'nom_cours' => 'required',
            'specialite' => 'required',
            'session' => 'required',
            'document' => 'required|mimes:pdf,docx,xlsx,mp3,mp4,png,jpg|max:2048',
        ]);

        $documentPath = $request->file('document')->store('documents');

        Document::create([
            'nom_cours' => $request->nom_cours,
            'specialite' => $request->specialite,
            'session' => $request->session,
            'titre' => $request->file('document')->getClientOriginalName(),
            'chemin' => $documentPath,
            'type' => $request->file('document')->getClientOriginalExtension(),
        ]);

        return redirect('/publier/upload')->with('success', 'Document chargé avec succès.');
    }
    public function showDocuments()
    {
       $documents = Document::all();
       return view('gestionnaire.cours.publier.documents', compact('documents'));
    }

  
    public function downloadDocument($id)
    {
      $document = Document::findOrFail($id);
      $pathToFile = storage_path("app/{$document->chemin}");
    return response()->download($pathToFile, $document->titre);
    }
    
public function deleteDocument($id)
{
    $document = Document::findOrFail($id);
    $pathToFile = storage_path("app/{$document->chemin}");
    unlink($pathToFile); // Supprimer le fichier du stockage
    $document->delete(); // Supprimer l'entrée de la base de données
    return redirect('/publier/documents')->with('success', 'Document supprimé avec succès.');
}
}
