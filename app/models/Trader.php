<?php

namespace App\Models;

use App\Core\App;


class Trader
{
    protected $rola;
    protected $name;
    protected $email;
    protected $password;
    protected $phoneNumber;

    public function __construct($rola, $name, $email, $password, $phoneNumber)
    {
        $this->rola = $rola;
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->phoneNumber = $phoneNumber;
    }

    public static function edit($parametrs)
    {
        $sql = "update users set role_id = '{$parametrs['role_id']}', name = '{$parametrs['name']}', 
                phone_number = '{$parametrs['telefon']}', email = '{$parametrs['email']}'
                where id = {$parametrs['id']};";

        App::get('database')->executeUpdate($sql);
    }

    public static function lastWeek()
    {
        $sql = "SELECT count(id) as liczba FROM users 
                WHERE created_at  > date_sub(now(), interval 7 day);";
        return App::get('database')->execute($sql);
    }

    public static function delete($rows)
    {
        foreach ($rows as $row) {
            App::get('database')->delete('users', $row);
        }
    }

    public function store()
    {
        App::get('database')->insert('users', [
            'role_id' => $this->rola,
            'name' => "'{$this->name}'",
            'email' => "'{$this->email}'",
            'password' => "'{$this->password}'",
            'phone_number' => "'{$this->phoneNumber}'",
            'created_at' => 'NOW()'
        ]);
    }

    public function nameById($id)
    {
        return App::get('database')->select('users', 'id', $id);
    }
}