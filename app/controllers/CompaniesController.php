<?php

namespace App\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\Questionnaire;
use App\Core\App;

class CompaniesController
{
    public function show()
    {
        $companies = Company::show();
        return view('companies', compact('companies'));
    }

    public function showSorted()
    {
        $companies = Company::show();
        return view('companies.show', compact('companies'));
    }

    public function create()
    {
        $dane = [
            'questions' => App::get('database')->selectAll('questions'),
            'answers' => App::get('database')->selectAll('answers'),
            'handlowcy' => User::traders()
        ];

        return view("companies.add", compact('dane'));
    }

    public function store()
    {
        $company = new Company(
            $_POST['nazwa'],
            $_POST['adres'],
            $_POST['miasto'],
            $_POST['nip'],
            $_POST['kraj'],
            $_POST['email'],
            $_POST['handlowiec'],
            $przetwarzanie = (isset($_POST['dane'])) ? 1 : 0,
            $reklamy = (isset($_POST['reklamy'])) ? 1 : 0
        );

        $company->store();

        $questionnaire = new Questionnaire(
            $_POST['nazwa'],
            $_POST['radio'],
            $_POST['check'],
            $_POST['text'],
            $_POST['handlowiec']
        );

        $questionnaire->store();

        return redirect('panel');
    }

    public function editForm()
    {
        $company = App::get('database')->select('companies', 'id', $_GET['id']);
        return view('companies.edit', compact('company'));
    }

    public function edit()
    {
        $parametrs = [
            'nazwa' => $_POST['nazwa'],
            'adres' => $_POST['adres'],
            'miasto' => $_POST['miasto'],
            'nip' => $_POST['nip'],
            'kraj' => $_POST['kraj'],
            'email' => $_POST['email'],
            'przetwarzanie' => (isset($_POST['dane'])) ? 1 : 0,
            'reklamy' => (isset($_POST['reklamy'])) ? 1 : 0
        ];

        Company::edit($parametrs);
        return redirect('panel');
    }

    public function delete()
    {
        ($_POST['usun'] == 1) ?  Company::delete($_POST['checkbox']) : App::get('database')->deleteAll('companies');
        return redirect('panel');
    }
}