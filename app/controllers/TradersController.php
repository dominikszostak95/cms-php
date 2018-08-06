<?php

namespace App\Controllers;

use App\Models\Trader;
use App\Models\User;
use App\Core\App;

class TradersController
{
    public function show()
    {
        $traders = User::show();
        return view('users', compact('traders'));
    }

    public function create()
    {
        return view('user.add');
    }

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

    public function editForm()
    {
        $trader = App::get('database')->select('users', 'id', $_GET['id']);
        return view('traders.edit', compact('trader'));
    }

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

    public function delete()
    {
        ($_POST['usun'] == 1) ?  Trader::delete($_POST['checkbox']) : App::get('database')->deleteAll('users');
        return redirect('panel');
    }
}