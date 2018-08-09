<?php

namespace App\Controllers;

use App\Models\User;

class UsersController
{
    public function store()
    {
        $user = new User(
            $_POST['name'],
            $_POST['email'],
            $_POST['password'],
            $_POST['phone']
        );
        $user->store();

        User::login($_POST['email'], $_POST['password']);
    }

    public function reset()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            return view('newpass', compact('id'));
        } else {
            return view('reset');
        }
    }

    public function sendPassword()
    {
        User::sendPassword($_POST['email']);
    }

    public function newPassword()
    {
        User::changePassword($_POST['id'], $_POST['password']);
        return view('panel');
    }

    public function login()
    {
        User::login($_POST['email'], $_POST['password']);
    }

    public function logout()
    {
        User::logout();
        return redirect('');
    }

}