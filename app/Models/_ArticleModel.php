<?php

namespace App\Models;

class _ArticleModel
{
    private static $data = [ 
        [
            "title" => "lorem ipsomun hjuri naim1",
            "author" => "Kenny",
            "body" => "
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae unde iusto reprehenderit tempora dolorum nam praesentium tempore dicta officia quae aperiam molestias, ipsa mollitia saepe velit magni fugit dolores soluta!",
        ],
        [
            "title" => "lorem ipsomun hjuri naim2",
            "author" => "FLDI",
            "body" => "
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae unde iusto reprehenderit tempora dolorum nam praesentium tempore!",
        ]
    ];

    public static function all(){
        return self::$data;
    }
}
