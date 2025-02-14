<?php

namespace jeuxvideo\models;

class Game extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'game';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function genres() {
        return $this->belongsToMany(Genre::class, 'game2genre', 'game_id', 'genre_id');
    }

    public function platforms() {
        return $this->belongsToMany(Platform::class, 'game2platform', 'game_id', 'platform_id');
    }

    public function characters() {
        return $this->belongsToMany(Character::class, 'game2character', 'game_id', 'character_id');
    }

    public function developers() {
        return $this->belongsToMany(Company::class, 'game_developers', 'game_id', 'comp_id');
    }

    public function publishers() {
        return $this->belongsToMany(Company::class, 'game_publishers', 'game_id', 'comp_id');
    }

    public function themes()
    {
        return $this->belongsToMany(Theme::class, 'game2theme', 'game_id', 'theme_id');
    }
    public function ratings() {
        return $this->belongsToMany(GameRating::class, 'game2rating', 'game_id', 'rating_id');
    }
}