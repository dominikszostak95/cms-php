<?php

namespace App\Models;

use App\Core\App;

class Question
{
    private $content;
    private $order;
    private $status;
    private $category;
    private $answers;
    private $answersType;

    public function __construct($content, $category, $order, $status, $answers, $answersType)
    {
        $this->content = $content;
        $this->category = $category;
        $this->order = $order;
        $this->status = $status;
        $this->answers = $answers;
        $this->answersType = $answersType;
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
        $sql = "update questions set content = '{$parametrs['content']}', status = {$parametrs['status']} 
                where id = {$parametrs['id']}";


        App::get('database')->executeUpdate($sql);
    }

    public static function editAnswers($id, $answer)
    {
        $x = 0;
        foreach ($id as $id) {
            $sql = "update answers set content = '{$answer[$x]}' where id = {$id} ";
            App::get('database')->executeUpdate($sql);
            $x++;
        }
    }

    public function store()
    {
        App::get('database')->insert('questions', [
            'content' => "'{$this->content}'",
            'category' => $this->category,
            'orderr' => $this->order,
            'status' => $this->status
        ]);

        $id = App::get('database')->lastRecord('questions');

        foreach ($this->answers as $answer) {
            App::get('database')->insert('answers', [
                'answer_id' => $id[0]->id,
                'content' => "'{$answer}'",
                'type' => $this->answersType,
            ]);
        }
    }

}