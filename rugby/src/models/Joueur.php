<?php

namespace rugby\models;

class Joueur extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'joueur';
    protected $primaryKey = 'numJoueur';
    public $timestamps = false;

    public function equipe() {
        return $this->belongsTo(Equipe::class, 'numEquipe', 'id');
    }

    public function poste() {
        return $this->belongsTo(Poste::class, 'numPoste', 'numero');
    }

    public function jouer() {
        return $this->hasMany(Jouer::class, 'numJoueur');
    }
}