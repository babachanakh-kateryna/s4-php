<?php

namespace rugby\models;

class Equipe extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'equipe';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function joueurs() {
        return $this->hasMany(Joueur::class, 'numEquipe', 'id');
    }
}