<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Apprenant;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class SessionController extends Controller
{

    public function apprenantsParSession(Request $request)
    {
        $sessions = Session::all();
        $selectedSession = $request->input('session_id');
        $apprenants = [];

        if ($selectedSession) {
            $apprenants = Apprenant::where('session_id', $selectedSession)->get();
        }

        return view('gestionnaire.sessions.apprenants-par-session', compact('sessions', 'apprenants', 'selectedSession'));
    }

 
    public function showCreateSessionForm()
    {
        return view('gestionnaire.sessions.create-session-form');
    }

    public function createSession(Request $request)
    {
        $request->validate([
            'nom' => 'required',
        ]);

        Session::create([
            'nom' => $request->nom,
        ]);

        return redirect('/create-session-form')->with('success', 'Session créée avec succès.');
    }

    public function exportPDF(Request $request)
    {
        $selectedSession = $request->input('session_id');
        $apprenants = [];

        if ($selectedSession) {
            $apprenants = Apprenant::where('session_id', $selectedSession)->get();
        }

        $pdf = FacadePdf::loadView('gestionnaire.sessions.pdf', compact('apprenants'));
        // Optionally, you can save the PDF to a file
        $pdf->save(storage_path('pdf_Apprenant/apprenants.pdf'));
        return $pdf->download('apprenants.pdf');
    }
   

}

