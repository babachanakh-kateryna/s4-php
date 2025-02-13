<?php

namespace jeuxvideo\models;

class Theme extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'theme';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function games()
    {
        return $this->belongsToMany(Game::class, 'game2theme', 'theme_id', 'game_id');
    }
}