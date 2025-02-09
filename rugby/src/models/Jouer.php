<?php

namespace rugby\models;

class Jouer extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'jouer';
    protected $primaryKey = ['numMatch', 'numJoueur'];
    public $incrementing = false;
    public $timestamps = false;

    public function joueur() {
        return $this->belongsTo(Joueur::class, 'numJoueur');
    }

    public function match() {
        return $this->belongsTo(Matchs::class, 'numMatch');
    }
}