<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Photo;
use App\Models\File;
use App\Core\App;

class PhotosController
{
    public function show()
    {
        $photos = Photo::show();
        return view('photos', compact('photos'));
    }

    public function create()
    {
        $traders = User::traders();
        return view('photos.add', compact('traders'));
    }

    public function store()
    {
        $file = new File($_FILES["image"], "uploads/", "uploads/" . basename($_FILES["image"]["name"]));

        $photo = new Photo(
            $_POST['nazwa'],
            $_FILES['image']['name'],
            $_POST['handlowiec'],
            $_FILES['image']['type'],
            $sciezka = $file->check(),
            1
        );

        $photo->store();

        return view('panel');
    }

    public function editForm()
    {
        $photo = App::get('database')->select('photos', 'id', $_GET['id']);
        return view('photos.edit', compact('photo'));
    }

    public function delete()
    {
        ($_POST['usun'] == 1) ?  Photo::delete($_POST['checkbox']) : App::get('database')->deleteAll('photos');
        return redirect('panel');
    }
}