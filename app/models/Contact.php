<?php

namespace App\Models;

use App\Core\App;

class Contact
{
    protected $firma;
    protected $name;
    protected $stanowisko;
    protected $telefon;
    protected $email;
    protected $zdjecie;
    protected $handlowiec;
    protected $przetwarzanie;
    protected $reklamy;

    public function __construct($firma, $name, $stanowisko, $telefon, $email, $zdjecie, $handlowiec, $przetw, $reklamy)
    {
        $this->firma = $firma;
        $this->name = $name;
        $this->stanowisko = $stanowisko;
        $this->telefon = $telefon;
        $this->email = $email;
        $this->zdjecie = $zdjecie;
        $this->handlowiec = $handlowiec;
        $this->przetwarzanie = $przetw;
        $this->reklamy = $reklamy;
    }


    public static function edit($parametrs)
    {
        $sql = "update contacts set company_id = '{$parametrs['firma']}', name = '{$parametrs['name']}', 
                telefon = '{$parametrs['telefon']}', email = '{$parametrs['email']}'
                where id = {$parametrs['id']};";

        App::get('database')->executeUpdate($sql);
    }

    public static function delete($rows)
    {
        foreach ($rows as $row) {
            App::get('database')->delete('contacts', $row);
        }
    }

    public static function show()
    {
        $sql = "select contacts.id, companies.nazwa, contacts.name as cName, 
                contacts.telefon, contacts.created_at, users.name as uName 
                from contacts inner join companies on contacts.company_id = companies.id
                inner join users on companies.id_handlowca = users.id;";

        return App::get('database')->execute($sql);
    }

    public static function showByCompany($id)
    {
        $sql = "select contacts.id, companies.nazwa, companies.id, contacts.name as cName, 
                contacts.telefon, contacts.created_at, users.name as uName 
                from contacts inner join companies on contacts.company_id = companies.id
                inner join users on companies.id_handlowca = users.id where companies.id = {$id};";

        return App::get('database')->execute($sql);
    }

    public function store()
    {
        App::get('database')->insert('contacts', [
            'company_id' => $this->firma,
            'name' => "'{$this->name}'",
            'stanowisko' => "'{$this->stanowisko}'",
            'telefon' => "'{$this->telefon}'",
            'email' => "'{$this->email}'",
            'zdjecie' => "'{$this->zdjecie}'",
            'id_handlowca' => $this->handlowiec,
            'przetwarzanie' => $this->przetwarzanie,
            'reklamy' => $this->reklamy,
            'created_at' => 'NOW()'
        ]);
    }
}