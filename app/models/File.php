<?php

namespace App\Models;


class File
{
    public $file;
    public $target_dir;
    public $target_file;

    public function __construct($file, $target_dir, $target_file)
    {
        $this->file = $file;
        $this->target_dir = $target_dir;
        $this->target_file = $target_file;
    }

    public function check()
    {
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $this->target_file)) {
            echo "Cos poszlo zle.";
        }

        return $this->target_dir . '' . $this->file["name"];
    }
}