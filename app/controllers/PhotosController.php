<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Photo;
use App\Models\File;
use App\Core\App;

class PhotosController
{
    /**
     * Fetch all photos from database and display them in view.
     *
     * @return mixed
     */
    public function show()
    {
        $photos = Photo::show();
        return view('photos', compact('photos'));
    }

    /**
     * Fetch required data from database and display photos adding form.
     *
     * @return mixed
     */
    public function create()
    {
        $traders = User::traders();
        return view('photos.add', compact('traders'));
    }

    /**
     * Create new photo with data from POST request.
     *
     * @return redirect
     */
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

    /**
     * Fetch specified by id in GET request photo from database and display edit form.
     *
     * @return mixed
     */
    public function editForm()
    {
        $photo = App::get('database')->select('photos', 'id', $_GET['id']);
        return view('photos.edit', compact('photo'));
    }

    /**
     * Delete specified photo or all photos.
     *
     * @return redirect
     */
    public function delete()
    {
        ($_POST['usun'] == 1) ?  Photo::delete($_POST['checkbox']) : App::get('database')->deleteAll('photos');
        return redirect('panel');
    }
}