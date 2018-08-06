<?php

namespace App\Models;

use App\Core\App;

class Photo
{
    public $nazwa;
    public $plik;
    public $handlowiec;
    public $typ;
    public $sciezka;
    public $status;


    public function __construct($nazwa, $plik, $handlowiec, $typ, $sciezka, $status)
    {
        $this->nazwa = $nazwa;
        $this->plik = $plik;
        $this->handlowiec = $handlowiec;
        $this->typ = $typ;
        $this->sciezka = $sciezka;
        $this->status = $status;
    }

    public static function show()
    {
        return App::get('database')->innerJoin('users', 'photos', 'users.id', 'photos.id_handlowca');
    }

    public static function delete($rows)
    {
        foreach ($rows as $row) {
            App::get('database')->delete('photos', $row);
        }
    }

    public function store()
    {
        App::get('database')->insert('photos', [
            'nazwa' => "'{$this->nazwa}'",
            'plik' => "'{$this->plik}'",
            'id_handlowca' => $this->handlowiec,
            'typ' => "'{$this->typ}'",
            'sciezka' => "'{$this->sciezka}'",
            'status' => $this->status,
            'created_at' => 'NOW()'
        ]);
    }

}