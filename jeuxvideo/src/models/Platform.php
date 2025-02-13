<?php

namespace jeuxvideo\models;

class Platform extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'platform';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function games()
    {
        return $this->belongsToMany(Game::class, 'game2platform', 'platform_id', 'game_id');
    }
}