<?php

namespace App\Models;

use App\Core\App;


class Trader
{
    private $role;
    private $name;
    private $email;
    private $password;
    private $phoneNumber;

    public function __construct($role, $name, $email, $password, $phoneNumber)
    {
        $this->role = $role;
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->phoneNumber = $phoneNumber;
    }

    public function store()
    {
        App::get('database')->insert('users', [
            'role_id' => $this->role,
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

    public static function edit($parametrs)
    {
        $sql = "update users set role_id = '{$parametrs['role_id']}', name = '{$parametrs['name']}', 
                phone_number = '{$parametrs['phone']}', email = '{$parametrs['email']}'
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
}