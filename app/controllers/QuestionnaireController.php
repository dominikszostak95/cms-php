<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\Questionnaire;

class QuestionnaireController
{
    public function show()
    {

        $dane = [
            'companies' => App::get('database')->selectAll('companies'),
            'answers' => App::get('database')->selectAll('answers')
        ];


        return view('results', compact('dane'));
    }

    public function showka()
    {
        $idFirmy = $_GET['id'];

        $dane = [
            'questions' => App::get('database')->selectAll('questions'),
            'answers' => App::get('database')->selectAll('answers'),
            'users_answers' => Questionnaire::usersAnswers($idFirmy),
            'text_answers' => Questionnaire::textAnswers($idFirmy)
        ];
        return view('results.show', compact('dane'));
    }

    public function showQuestions()
    {
        $idFirmy = $_POST['firma'];

        $dane = [
            'questions' => App::get('database')->selectAll('questions'),
            'answers' => App::get('database')->selectAll('answers'),
            'users_answers' => Questionnaire::usersAnswers($idFirmy),
            'text_answers' => Questionnaire::textAnswers($idFirmy)
        ];

        return view('results.show', compact('dane'));
    }
}