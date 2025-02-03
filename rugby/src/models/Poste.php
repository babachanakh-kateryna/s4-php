<?php

namespace rugby\models;

class Poste extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'poste';
    protected $primaryKey = 'numero';
    public $timestamps = false;
}