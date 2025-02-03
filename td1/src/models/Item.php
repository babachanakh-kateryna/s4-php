<?php

namespace mywishlist\models;
use Illuminate\Database\Eloquent\Model;

class Item extends Model {
    protected $table = 'item';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['nom', 'descr', 'img', 'url', 'tarif', 'liste_id'];
}