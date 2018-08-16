<?php

namespace App\Models;

use App\Core\App;

class Company
{
    private $name;
    private $address;
    private $city;
    private $nip;
    private $country;
    private $email;
    private $trader;
    private $processing;
    private $ads;

    public function __construct($name, $address, $city, $nip, $country, $email, $trader, $processing, $ads)
    {
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->country = $country;
        $this->nip = $nip;
        $this->email = $email;
        $this->trader = $trader;
        $this->processing = $processing;
        $this->ads = $ads;
    }

    public static function show()
    {
        return App::get('database')->innerJoin('users', 'companies', 'companies.trader_id', 'users.id');
    }

    public function store()
    {
        App::get('database')->insert('companies', [
            'cname' => "'{$this->name}'",
            'address' => "'{$this->address}'",
            'city' => "'{$this->city}'",
            'nip' => "{$this->nip}",
            'country' => "'{$this->country}'",
            'email' => "'{$this->email}'",
            'trader_id' => $this->trader,
            'processing' => $this->processing,
            'ads' => $this->ads,
            'created_at' => 'NOW()'
        ]);
    }

    public static function edit($parametrs)
    {
        $sql = "update companies set cname = '{$parametrs['cname']}', address = '{$parametrs['address']}', 
                city = '{$parametrs['city']}',nip = {$parametrs['nip']}, country = '{$parametrs['country']}', 
                email = '{$parametrs['email']}', processing = {$parametrs['processing']}, 
                ads = {$parametrs['ads']} where id = '{$parametrs['id']}';";

        App::get('database')->executeUpdate($sql);
    }

    public static function delete($rows)
    {
        foreach ($rows as $row) {
            App::get('database')->delete('companies', $row);
        }
    }

    public static function lastWeek()
    {
        $sql = "SELECT count(id) as liczba FROM companies 
                WHERE created_at  > date_sub(now(), interval 7 day);";
        return App::get('database')->execute($sql);
    }

}