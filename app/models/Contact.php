<?php

namespace App\Models;

use App\Core\App;

class Contact
{
    private $company;
    private $name;
    private $role;
    private $phone;
    private $email;
    private $photo;
    private $trader;
    private $processing;
    private $ads;

    public function __construct($company, $name, $role, $phone, $email, $photo, $trader, $processing, $ads)
    {
        $this->company = $company;
        $this->name = $name;
        $this->role = $role;
        $this->phone = $phone;
        $this->email = $email;
        $this->photo = $photo;
        $this->trader = $trader;
        $this->processing = $processing;
        $this->ads = $ads;
    }

    public static function edit($parametrs)
    {
        $sql = "update contacts set company_id = '{$parametrs['firma']}', name = '{$parametrs['name']}', 
                phone = '{$parametrs['telefon']}', email = '{$parametrs['email']}'
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
        $sql = "select contacts.id, companies.cname, contacts.name as fullname, 
                contacts.phone, contacts.created_at, users.name as username 
                from contacts inner join companies on contacts.company_id = companies.id
                inner join users on companies.trader_id = users.id;";

        return App::get('database')->execute($sql);
    }

    public static function showByCompany($id)
    {
        $sql = "select contacts.id, companies.cname, contacts.name as fullname, 
                contacts.phone, contacts.created_at, users.name as username 
                from contacts inner join companies on contacts.company_id = companies.id
                inner join users on companies.trader_id = users.id where companies.id = {$id};";

        return App::get('database')->execute($sql);
    }

    public function store()
    {
        App::get('database')->insert('contacts', [
            'company_id' => $this->company,
            'name' => "'{$this->name}'",
            'role' => "'{$this->role}'",
            'phone' => "'{$this->phone}'",
            'email' => "'{$this->email}'",
            'photo' => "'{$this->photo}'",
            'trader_id' => $this->trader,
            'processing' => $this->processing,
            'ads' => $this->ads,
            'created_at' => 'NOW()'
        ]);
    }
}