<?php

namespace jeuxvideo\models;

class Character extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'character';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function games()
    {
        return $this->belongsToMany(Game::class, 'game2character', 'character_id', 'game_id');
    }

    public function firstGame() {
        return $this->belongsTo(Game::class, 'first_appeared_in_game_id');
    }

    public function friends() {
        return $this->belongsToMany(Character::class, 'friends', 'char1_id', 'char2_id');
    }

    public function enemies() {
        return $this->belongsToMany(Character::class, 'enemies', 'char1_id', 'char2_id');
    }
}