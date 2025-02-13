<?php

namespace jeuxvideo\models;

class RatingBoard extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'rating_board';
    protected $primaryKey = 'id';
    public $timestamps = false;
}