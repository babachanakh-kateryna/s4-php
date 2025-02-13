<?php

namespace jeuxvideo\models;

class Company extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'company';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function developedGames() {
        return $this->belongsToMany(Game::class, 'game_developers', 'comp_id', 'game_id');
    }

    public function publishedGames() {
        return $this->belongsToMany(Game::class, 'game_publishers', 'comp_id', 'game_id');
    }
}