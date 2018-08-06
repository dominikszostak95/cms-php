<?php

namespace App\Models;

use App\Core\App;

class Company
{
    public $nazwa;
    public $adres;
    public $miasto;
    public $nip;
    public $kraj;
    public $email;
    public $handlowiec;
    public $przetwarzanie;
    public $reklamy;

    public function __construct($nazwa, $adres, $miasto, $nip, $kraj, $email, $handlowiec, $przetwarzanie, $reklamy)
    {
        $this->nazwa = $nazwa;
        $this->adres = $adres;
        $this->miasto = $miasto;
        $this->kraj = $kraj;
        $this->nip = $nip;
        $this->email = $email;
        $this->handlowiec = $handlowiec;
        $this->przetwarzanie = $przetwarzanie;
        $this->reklamy = $reklamy;
    }

    public static function show()
    {
        return App::get('database')->innerJoin('users', 'companies', 'companies.id_handlowca', 'users.id');
    }

    public static function edit($parametrs)
    {
        $sql = "update companies set nazwa = '{$parametrs['nazwa']}', adres = '{$parametrs['adres']}', 
                miasto = '{$parametrs['miasto']}',nip = {$parametrs['nip']}, kraj = '{$parametrs['kraj']}', 
                email = '{$parametrs['email']}', przetwarzanie = {$parametrs['przetwarzanie']}, 
                reklamy = {$parametrs['reklamy']};";

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

    public function store()
    {
        App::get('database')->insert('companies', [
            'nazwa' => "'{$this->nazwa}'",
            'adres' => "'{$this->adres}'",
            'miasto' => "'{$this->miasto}'",
            'nip' => "{$this->nip}",
            'kraj' => "'{$this->kraj}'",
            'email' => "'{$this->email}'",
            'id_handlowca' => $this->handlowiec,
            'przetwarzanie' => $this->przetwarzanie,
            'reklamy' => $this->reklamy,
            'created_at' => 'NOW()'
        ]);
    }
}