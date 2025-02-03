<?php

namespace mywishlist\models;
use mywishlist\Illuminate;

use Illuminate\Database\Eloquent\Model;

class Liste extends Model {
    protected $table = 'liste';
    protected $primaryKey = 'no';
    public $timestamps = false;
    protected $fillable = ['titre', 'description', 'expiration', 'user_id', 'token'];
}