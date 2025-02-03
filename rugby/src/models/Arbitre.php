<?php

namespace rugby\models;

class Arbitre extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'arbitre';
    protected $primaryKey = 'numArbitre';
    public $timestamps = false;

    // table arbitrer (numArbitre / numMatch)
    public function matchs() {
        return $this->belongsToMany(Matchs::class, 'arbitrer', 'numArbitre', 'numMatch');
    }
}
