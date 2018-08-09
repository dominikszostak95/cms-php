<?php

namespace App\Controllers;

use App\Models\Trader;
use App\Models\User;
use App\Core\App;

class TradersController
{
    /**
     * Fetch all traders from database and display them in view.
     *
     * @return mixed
     */
    public function show()
    {
        $traders = User::show();
        return view('users', compact('traders'));
    }

    /**
     * Fetch required data from database and display trader adding form.
     *
     * @return mixed
     */
    public function create()
    {
        return view('user.add');
    }

    /**
     * Create new trader with data from POST request.
     *
     * @return redirect
     */
    public function store()
    {
        $trader = new Trader(
            $_POST['grupa'],
            $_POST['name'],
            $_POST['email'],
            $_POST['password'],
            $_POST['phone']
        );

        $trader->store();

        return redirect('panel');
    }

    /**
     * Fetch specified by id in GET request trader from database and display edit form.
     *
     * @return mixed
     */
    public function editForm()
    {
        $trader = App::get('database')->select('users', 'id', $_GET['id']);
        return view('traders.edit', compact('trader'));
    }

    /**
     * Update specified trader in database with data from POST request.
     *
     * @return redirect
     */
    public function edit()
    {
        $parametrs = [
            'id' => $_POST['data'],
            'role_id' => $_POST['grupa'],
            'name' => $_POST['name'],
            'telefon' => $_POST['telefon'],
            'email' => $_POST['email']
        ];

        Trader::edit($parametrs);

        return redirect('panel');
    }

    /**
     * Delete specified company or all companies.
     *
     * @return redirect
     */
    public function delete()
    {
        ($_POST['usun'] == 1) ?  Trader::delete($_POST['checkbox']) : App::get('database')->deleteAll('users');
        return redirect('panel');
    }
}