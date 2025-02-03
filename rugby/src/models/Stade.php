<?php

namespace rugby\models;

class Stade extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'stade';
    protected $primaryKey = 'numStade';
    public $timestamps = false;
}