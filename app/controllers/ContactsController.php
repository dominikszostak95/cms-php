<?php

namespace App\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\Contact;
use App\Models\File;
use App\Core\App;

class ContactsController
{
    public function show()
    {
        (isset($_GET['id'])) ? $contacts = Contact::showByCompany($_GET['id']) : $contacts = Contact::show();
        return view('contacts', compact('contacts'));
    }

    public function create()
    {
        $data = [
          'companies' => Company::show(),
          'traders' => User::traders()
        ];

        return view('contacts.add', compact('data'));
    }

    public function editForm()
    {
        $data = [
            'companies' => $companies = Company::show(),
            'contact' => $contact = App::get('database')->select('contacts', 'id', $_GET['id'])
        ];

        return view('contacts.edit', compact('data'));
    }

    public function store()
    {
        $file = new File($_FILES["image"], "uploads/", "uploads/" . basename($_FILES["image"]["name"]));

        $contact = new Contact(
            $_POST['firma'],
            $_POST['name'],
            $_POST['stanowisko'],
            $_POST['telefon'],
            $_POST['email'],
            $sciezka = $file->check(),
            $_POST['handlowiec'],
            $przetwarzanie = (isset($_POST['dane'])) ? 1 : 0,
            $reklamy = (isset($_POST['reklamy'])) ? 1 : 0
        );

        $contact->store();

        return redirect('panel');
    }

    public function delete()
    {
        ($_POST['usun'] == 1) ?  Contact::delete($_POST['checkbox']) : App::get('database')->deleteAll('contacts');
        return redirect('panel');
    }

    public function edit()
    {
        $parametrs = [
            'id' => $_POST['data'],
            'firma' => $_POST['firma'],
            'name' => $_POST['name'],
            'telefon' => $_POST['telefon'],
            'email' => $_POST['email'],
            'przetwarzanie' => (isset($_POST['dane'])) ? 1 : 0,
            'reklamy' => (isset($_POST['reklamy'])) ? 1 : 0
        ];

        Contact::edit($parametrs);

        return redirect('panel');
    }
}