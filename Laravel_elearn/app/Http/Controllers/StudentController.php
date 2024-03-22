<?php

// app/Http/Controllers/StudentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function showForm()
    {
        $students = Student::all();
        return view('gestionnaire.students.form', compact('students'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required|email|unique:students',
        ]);

        // Retrieve the last registration number from the database
        $lastRegistration = DB::table('students')->max('numero_inscription');

        // Extract the numeric part of the last registration number and increment it
        $registrationNumber = sprintf('%03d', (int)substr($lastRegistration, 2) + 1);

        // Create the new registration number in the format E-XXX
        $newRegistration = 'E-' . $registrationNumber;

        // Save the new student record with the generated registration number
        Student::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'numero_inscription' => $newRegistration,
        ]);

        return redirect()->route('students.form')->with('success', 'Student added successfully.');
    }

/*
    public function store(Request $request)
    {
        $request->validate([
            'numero_inscription' => 'required',
            'nom' => 'required',
            'email' => 'required|email|unique:students',
        ]);

        Student::create($request->all());
       

        return redirect()->route('students.form')->with('success', 'Student added successfully.');
    }
*/
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('gestionnaire.students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
           // 'numero_inscription' => 'required',
            'nom' => 'required',
            'email' => 'required|email|unique:students,email,' . $id,
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('students.form')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.form')->with('success', 'Student deleted successfully.');
    }

    public function exportPDF()
    {
        $students = Student::all();
        $pdf = FacadePdf::loadView('gestionnaire.students.pdf', compact('students'));
        return $pdf->download('students_list.pdf');
    }

    public function sendEmail($id)
{
    $student = Student::find($id);

    if (!$student) {
        return redirect()->route('students.index')->with('error', 'Student not found.');
    }

    // Send registration email
    $details = [
        'numero_inscription' => $student->numero_inscription,
        'nom' => $student->nom,
        'email' => $student->email,
    ];
   // dd($details); // Check if data is correct
    Mail::to($student->email)->send(new RegistrationMail($details));

    return redirect()->route('students.form')->with('success', 'Email sent successfully.');
}

}