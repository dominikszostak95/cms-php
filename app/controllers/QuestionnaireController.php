<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\Questionnaire;

class QuestionnaireController
{
    /**
     * Fetch all companies with answer display it in select box where we cane choose one company.
     *
     * @return mixed
     */
    public function show()
    {
        $data = [
            'companies' => App::get('database')->selectAll('companies'),
            'answers' => App::get('database')->selectAll('answers')
        ];

        return view('results', compact('data'));
    }

    /**
     * Fetch all answers for specified company and display it as form.
     *
     * @return mixed
     */
    public function showka()
    {
        $companyId = $_GET['id'];

        $data = [
            'questions' => App::get('database')->selectAll('questions'),
            'answers' => App::get('database')->selectAll('answers'),
            'users_answers' => Questionnaire::usersAnswers($companyId),
            'text_answers' => Questionnaire::textAnswers($companyId)
        ];
        return view('results.show', compact('data'));
    }



}