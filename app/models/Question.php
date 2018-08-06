<?php

namespace App\Models;

use App\Core\App;

class Question
{
    public $tresc;
    public $kolejnosc;
    public $status;
    public $kategoria;
    public $odpowiedzi;
    public $typOdpowiedzi;

    public function __construct($tresc, $kategoria, $kolejnosc, $status, $odpowiedzi, $typOdpowiedzi)
    {
        $this->tresc = $tresc;
        $this->kategoria = $kategoria;
        $this->kolejnosc = $kolejnosc;
        $this->status = $status;
        $this->odpowiedzi = $odpowiedzi;
        $this->typOdpowiedzi = $typOdpowiedzi;
    }

    public static function showQuestions()
    {
        return App::get('database')->selectAll('questions');
    }

    public static function showCategories()
    {
        return App::get('database')->selectAll('questions_categories');
    }

    public static function delete($rows)
    {
        foreach ($rows as $row) {
            App::get('database')->delete('questions', $row);
        }
    }

    public static function edit($parametrs)
    {
        $sql = "update questions set tresc = '{$parametrs['tresc']}', status = {$parametrs['status']} 
                where id = {$parametrs['id']}";

        App::get('database')->executeUpdate($sql);
    }

    public static function editAnswers($id, $answer)
    {
        $x = 0;
        foreach ($id as $id) {
            $sql = "update answers set tresc = '{$answer[$x]}' where id = {$id} ";
            App::get('database')->executeUpdate($sql);
            $x++;
        }
    }

    public function store()
    {
        App::get('database')->insert('questions', [
            'tresc' => "'{$this->tresc}'",
            'kategoria' => $this->kategoria,
            'kolejnosc' => $this->kolejnosc,
            'status' => $this->status
        ]);

        $id = App::get('database')->lastRecord('questions');

        foreach ($this->odpowiedzi as $odpowiedz) {
            App::get('database')->insert('answers', [
                'id_pytania' => $id[0]->id,
                'tresc' => "'{$odpowiedz}'",
                'typ' => $this->typOdpowiedzi,
            ]);
        }
    }

}