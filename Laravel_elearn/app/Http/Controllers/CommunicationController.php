<?php

namespace App\Http\Controllers;
use App\Models\Communication;

use Illuminate\Http\Request;

class CommunicationController extends Controller
{
    public function communiquer(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,docx,xlsx',
        ]);

        if ($request->hasFile('file')) {
            $communication = Communication::create(['title' => $request->file('file')->getClientOriginalName()]);
            $communication->addMediaFromRequest('file')->toMediaCollection('communications');
            return redirect()->back()->with('success', 'Communication uploaded successfully.');
        } else {
            return redirect()->back()->with('error', 'No file uploaded.');
        }
    }

    public function visualiser($id)
    {
        $communication = Communication::findOrFail($id);
        return view('gestionnaire.communications.visualiser', compact('communication'));
    }
}
