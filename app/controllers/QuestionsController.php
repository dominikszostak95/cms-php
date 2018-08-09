<?php

namespace App\Controllers;

use App\Models\Question;
use App\Core\App;


class QuestionsController
{
    /**
     * Fetch all questions from database.
     *
     * @return mixed
     */
    public function show()
    {
        $questions = Question::showQuestions();
        return view('questions', compact('questions'));
    }

    /**
     * Fetch required data from database and display question adding form.
     *
     * @return mixed
     */
    public function create()
    {
        $categories = Question::showCategories();
        return view('questions.add', compact('categories'));
    }

    /**
     * Create new question with data from POST request.
     *
     * @return redirect
     */
    public function store()
    {
        $last = App::get('database')->lastRecord('questions');

        $question = new Question(
            $_POST['tresc'],
            $_POST['kategoria'],
            (empty($last)) ? 1 : ++$last[0]->id,
            $_POST['status'],
            $_POST['input_field'],
            $_POST['typ']
        );

        $question->store();

        return redirect('panel');
    }

    /**
     * Update specified question in database with data from POST request.
     *
     * @return redirect
     */
    public function edit()
    {
        $parametrs = [
            'id' => $_POST['data'],
            'tresc' => $_POST['tresc'],
            'status' => $_POST['status']
        ];

        Question::edit($parametrs);

        Question::editAnswers($_POST['id'], $_POST['text']);
        return redirect('panel');
    }

    /**
     * Fetch specified by id in GET request question from database and display edit form.
     *
     * @return mixed
     */
    public function editForm()
    {
        $data = [
            'question' => App::get('database')->select('questions', 'id', $_GET['id']),
            'answers' => App::get('database')->select('answers', 'id_pytania', $_GET['id'])
        ];

        return view('questions.edit', compact('data'));
    }

    /**
     * Delete specified question or all questions.
     *
     * @return redirect
     */
    public function delete()
    {
        ($_POST['usun'] == 1) ?  Question::delete($_POST['checkbox']) : App::get('database')->deleteAll('questions');
        return redirect('panel');
    }
}