<?php

namespace jeuxvideo\models;

class Genre extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'genre';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function games()
    {
        return $this->belongsToMany(Game::class, 'game2genre', 'genre_id', 'game_id');
    }
}