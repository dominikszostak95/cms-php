<?php

namespace App\Models;

use App\Core\App;

class Questionnaire
{
    private $company;
    private $radio;
    private $check;
    private $text;
    private $trader;

    public function __construct($company, $radio, $check, $text, $trader)
    {
        $this->company = $company;
        $this->radio = $radio;
        $this->check = $check;
        $this->text = $text;
        $this->trader = $trader;
    }

    public static function usersAnswers($id)
    {
        $sql = "select users_answers.company_id, users_answers.trader_id, users_answers.answer_id, users_answers.question_id uAid_pytania, 
                questions.id, questions.category, questions.content as qTresc, questions.orderr, questions.status, answers.id, answers.answer_id aId_pytania, 
                answers.content as aTresc, answers.type from users_answers 
                inner join questions on users_answers.question_id = questions.id 
                inner join answers on users_answers.answer_id = answers.id
                where users_answers.company_id = {$id};";

        return App::get('database')->execute($sql);
    }

    public static function textAnswers($id)
    {
        $sql = "select * from text_answers inner join questions on text_answers.answer_id = questions.id
                where text_answers.company_id = {$id};";

        return App::get('database')->execute($sql);
    }

    public function store()
    {
        $company_id = App::get('database')->select('companies', 'cname', $this->company);

        foreach ($this->radio as $key => $item) {
            App::get('database')->insert('users_answers', [
                'company_id' => $company_id[0]->id,
                'trader_id' => $this->trader,
                'answer_id' => $item,
                'question_id' => $key
            ]);
        }

        foreach ($this->check as $key => $item) {
            foreach ($item as $itemm) {
                App::get('database')->insert('users_answers', [
                    'company_id' => $company_id[0]->id,
                    'trader_id' => $this->trader,
                    'answer_id' => $itemm,
                    'question_id' => $key
                ]);
            }
        }

        foreach ($this->text as $key => $item) {
            foreach ($item as $itemm) {
                App::get('database')->insert('text_answers', [
                   'company_id' => $company_id[0]->id,
                   'trader_id' => $this->trader,
                   'answer' => "'{$itemm}'",
                   'answer_id' => $key
                ]);
            }
        }
    }
}