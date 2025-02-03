<?php

namespace rugby\models;

class Matchs extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'matchs';
    protected $primaryKey = 'numMatch';
    public $timestamps = false;

    public function stade() {
        return $this->belongsTo(Stade::class, 'numStade');
    }

    public function equipeReceveuse() {
        return $this->belongsTo(Equipe::class, 'numEquipeR');
    }

    public function equipeDeplacee() {
        return $this->belongsTo(Equipe::class, 'numEquipeD');
    }

    // table arbitrer (numArbitre / numMatch)
    public function arbitres() {
        return $this->belongsToMany(Arbitre::class, 'arbitrer', 'numMatch', 'numArbitre');
    }
}


