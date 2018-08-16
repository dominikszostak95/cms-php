<?php

namespace App\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\Contact;
use App\Models\File;
use App\Core\App;

class ContactsController
{
    /**
     * Fetch all contacts from database or only specified if it is GET request.
     *
     * @return mixed
     */
    public function show()
    {
        (isset($_GET['id'])) ? $contacts = Contact::showByCompany($_GET['id']) : $contacts = Contact::show();
        return view('contacts', compact('contacts'));
    }

    /**
     * Fetch required data from database and display contact adding form.
     *
     * @return mixed
     */
    public function create()
    {
        $data = [
          'companies' => Company::show(),
          'traders' => User::traders()
        ];

        return view('contacts.add', compact('data'));
    }

    /**
     * Create new contact with data from POST request.
     *
     * @return redirect
     */
    public function store()
    {
        $file = new File($_FILES["image"], "uploads/", "uploads/" . basename($_FILES["image"]["name"]));

        $contact = new Contact(
            $_POST['company'],
            $_POST['name'],
            $_POST['role'],
            $_POST['phone'],
            $_POST['email'],
            $path = $file->check(),
            $_POST['trader'],
            $processing = (isset($_POST['processing'])) ? 1 : 0,
            $ads = (isset($_POST['ads'])) ? 1 : 0
        );

        $contact->store();

        return redirect('panel');
    }

    /**
     * Fetch specified by id in GET request contact from database and display edit form.
     *
     * @return mixed
     */
    public function editForm()
    {
        $data = [
            'companies' => $companies = Company::show(),
            'contact' => $contact = App::get('database')->select('contacts', 'id', $_GET['id'])
        ];

        return view('contacts.edit', compact('data'));
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
            'firma' => $_POST['company'],
            'name' => $_POST['name'],
            'telefon' => $_POST['phone'],
            'email' => $_POST['email'],
            'przetwarzanie' => (isset($_POST['processing'])) ? 1 : 0,
            'reklamy' => (isset($_POST['ads'])) ? 1 : 0
        ];

        Contact::edit($parametrs);

        return redirect('panel');
    }

    /**
     * Delete specified company or all contacts.
     *
     * @return redirect
     */
    public function delete()
    {
        ($_POST['delete'] == 1) ?  Contact::delete($_POST['checkbox']) : App::get('database')->deleteAll('contacts');
        return redirect('panel');
    }


}