<?php

namespace App\Models;

use App\Core\App;

class Photo
{
    private $name;
    private $file;
    private $trader;
    private $type;
    private $path;
    private $status;


    public function __construct($name, $file, $trader, $type, $path, $status)
    {
        $this->name = $name;
        $this->file = $file;
        $this->trader = $trader;
        $this->type = $type;
        $this->path = $path;
        $this->status = $status;
    }

    public static function show()
    {
        $sql = 'select photos.id, photos.name, photos.file, users.name as uName, photos.type, photos.created_at 
                from users inner join photos on users.id = photos.trader_id;';

        return App::get('database')->execute($sql);
    }

    public static function delete($rows)
    {
        foreach ($rows as $row) {
            App::get('database')->delete('photos', $row);
        }
    }

    public function store()
    {
        App::get('database')->insert('photos', [
            'name' => "'{$this->name}'",
            'file' => "'{$this->file}'",
            'trader_id' => $this->trader,
            'type' => "'{$this->type}'",
            'path' => "'{$this->path}'",
            'status' => $this->status,
            'created_at' => 'NOW()'
        ]);
    }

}