<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuizController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('gestionnaire.evaluations.quizz.indexQ', compact('questions'));
    }

    public function create()
    {
        return view('gestionnaire.evaluations.quizz.create');
    }
/*
    public function store(Request $request)
{
    $data = $request->validate([
        'question' => 'required',
        'options.*' => 'required',
        'correct_answer' => 'required|numeric|min:1', // Validation pour s'assurer que la réponse correcte est un nombre positif
    ]);

    $question = Question::create([
        'question' => $data['question'],
        'options' => json_encode($data['options']),
        'correct_answer' => $data['correct_answer'],
    ]);

    return redirect()->route('quizz.index')->with('success', 'Question ajoutée avec succès!');
}
*/

public function store(Request $request)
{
    $data = $request->validate([
        'questions.*.question' => 'required',
        'questions.*.options.*' => 'required',
        'questions.*.correct_answer' => 'required|numeric|min:1',
    ]);

    foreach ($data['questions'] as $questionData) {
        Question::create([
            'question' => $questionData['question'],
            'options' => json_encode($questionData['options']),
            'correct_answer' => $questionData['correct_answer'],
        ]);
    }

    return redirect()->route('quizz.index')->with('success', 'Questions ajoutées avec succès!');
}

public function passQuiz()
{
    $questions = Question::all();
    return view('gestionnaire.evaluations.quizz.pass', compact('questions'));
}

public function submitQuiz(Request $request)
{
    $data = $request->validate([
        'answers.*' => 'required|numeric',
    ]);

    $questions = Question::all();
    $totalPoints = 0;

    foreach ($questions as $question) {
        $correctAnswer = $question->correct_answer;

        if (isset($data['answers'][$question->id]) && $data['answers'][$question->id] == $correctAnswer) {
            $totalPoints++;
        }
    }

    return view('gestionnaire.evaluations.quizz.result', compact('totalPoints', 'questions'));
}


}
