<?php

namespace App\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\Questionnaire;
use App\Core\App;

class CompaniesController
{
    /**
     * Fetch all companies from database and display them in view.
     *
     * @return mixed
     */
    public function show()
    {
        $companies = Company::show();
        return view('companies', compact('companies'));
    }

    /**
     * Fetch required data from database and display company adding form.
     *
     * @return mixed
     */
    public function create()
    {
        $data = [
            'questions' => App::get('database')->selectAll('questions'),
            'answers' => App::get('database')->selectAll('answers'),
            'traders' => User::traders()
        ];

        return view("companies.add", compact('data'));
    }


    /**
     * Create new company with data from POST request.
     *
     * @return redirect
     */
    public function store()
    {
        $company = new Company(
            $_POST['cname'],
            $_POST['address'],
            $_POST['city'],
            $_POST['nip'],
            $_POST['country'],
            $_POST['email'],
            $_POST['trader'],
            $processing = (isset($_POST['processing'])) ? 1 : 0,
            $ads = (isset($_POST['ads'])) ? 1 : 0
        );

        $company->store();

        $questionnaire = new Questionnaire(
            $_POST['cname'],
            $_POST['radio'],
            $_POST['check'],
            $_POST['text'],
            $_POST['trader']
        );

        $questionnaire->store();

        return redirect('panel');
    }

    /**
     * Fetch specified by id in GET request company from database and display edit form.
     *
     * @return mixed
     */
    public function editForm()
    {
        $company = App::get('database')->select('companies', 'id', $_GET['id']);
        return view('companies.edit', compact('company'));
    }

    /**
     * Update specified company in database with data from POST request.
     *
     * @return redirect
     */
    public function edit()
    {
        $parametrs = [
            'id' => $_POST['id'],
            'cname' => $_POST['cname'],
            'address' => $_POST['address'],
            'city' => $_POST['city'],
            'nip' => $_POST['nip'],
            'country' => $_POST['country'],
            'email' => $_POST['email'],
            'processing' => (isset($_POST['processing'])) ? 1 : 0,
            'ads' => (isset($_POST['ads'])) ? 1 : 0
        ];

        Company::edit($parametrs);
        return redirect('panel');
    }

    /**
     * Delete specified company or all companies.
     *
     * @return redirect
     */
    public function delete()
    {
        ($_POST['delete'] == 1) ?  Company::delete($_POST['checkbox']) : App::get('database')->deleteAll('companies');
        return redirect('panel');
    }
}