<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\quizz;
use App\Models\question;


class questionController extends Controller
{
    //

    public function addQuestion($quizId)
    {
        $quiz = quizz::findOrFail($quizId);
        return view('gestionnaire.question.add', compact('quiz'));
    }

    public function storeQuestion(Request $request, $quizId)
    {
        $data = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'c1' => ['required', 'string', 'max:255'],
            'c2' => ['required', 'string', 'max:255'],
            'c3' => ['required', 'string', 'max:255'],
            'c4' => ['required', 'string', 'max:255'],
            'correct' => ['required', 'integer', 'max:255'],
        ]);

        $quest = new question();
        $quest->titre=$request->titre;
        $quest->choix_1=$request->c1;
        $quest->choix_2=$request->c2;
        $quest->choix_3=$request->c3;
        $quest->choix_4=$request->c4;
        $quest->correct=$request->correct;
        $quest->id_quizz=$quizId;


        $quizz = quizz::find($quizId);//je cherche le quizz en fonction de son id
        $quizz->nombre = $quizz->nombre + 1; //je modifie le nombre de question du quizz
        $quizz->update();
        

        /*$quiz = quizz::findOrFail($quizId);
        $question = new question($data);
        $quiz->questions()->save($question);*/

        if ($quest->save()) 
        {
            return redirect()->back()->withsuccess('question créée avec succès !');
        } 
        else 
        {
            return back()->withInput()->withErrors(['message' => 'Une erreur est survenue, veuillez réessayer!']);
        }    }

    public function showQuestions($quizId)
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);
        return view('show_questions', compact('quiz'));
    }

    public function details($id)
    {
        $questions = question::where('id_quizz', $id)->get();
        $quiz = quizz::find($id);

        return view('gestionnaire.question.detail',compact('questions'),compact('quiz'));
    }
}
