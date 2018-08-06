<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.07.18
 * Time: 12:11
 */

namespace App\Models;

use App\Core\App;

class Questionnaire
{
    public $radio;
    public $check;
    public $text;
    public $handlowiec;

    public function __construct($firma, $radio, $check, $text, $handlowiec)
    {
        $this->firma = $firma;
        $this->radio = $radio;
        $this->check = $check;
        $this->text = $text;
        $this->handlowiec = $handlowiec;
    }

    public static function usersAnswers($id)
    {
        $sql = "select users_answers.company_id, users_answers.id_handlowca, users_answers.id_odpowiedzi, users_answers.id_pytania uAid_pytania, 
                questions.id, questions.kategoria, questions.tresc as qTresc, questions.kolejnosc, questions.status, answers.id, answers.id_pytania aId_pytania, 
                answers.tresc as aTresc, answers.typ from users_answers 
                inner join questions on users_answers.id_pytania = questions.id 
                inner join answers on users_answers.id_odpowiedzi = answers.id
                where users_answers.company_id = {$id};";
        return App::get('database')->execute($sql);
    }

    public static function textAnswers($id)
    {
        $sql = "select * from text_answers inner join questions on text_answers.id_pytania = questions.id
                where text_answers.company_id = {$id};";
        return App::get('database')->execute($sql);
    }

    public function store()
    {
        $id_firmy = App::get('database')->select('companies', 'nazwa', $this->firma);

        foreach ($this->radio as $key => $item) {
            App::get('database')->insert('users_answers', [
                'company_id' => $id_firmy[0]->id,
                'id_handlowca' => $this->handlowiec,
                'id_odpowiedzi' => $item,
                'id_pytania' => $key
            ]);
        }

        foreach ($this->check as $key => $item) {
            foreach ($item as $itemm) {
                App::get('database')->insert('users_answers', [
                    'company_id' => $id_firmy[0]->id,
                    'id_handlowca' => $this->handlowiec,
                    'id_odpowiedzi' => $itemm,
                    'id_pytania' => $key
                ]);
            }
        }

        foreach ($this->text as $key => $item) {
            foreach ($item as $itemm) {
                App::get('database')->insert('text_answers', [
                   'company_id' => $id_firmy[0]->id,
                   'id_handlowca' => $this->handlowiec,
                   'odpowiedz' => "'{$itemm}'",
                   'id_pytania' => $key
                ]);
            }
        }
    }
}