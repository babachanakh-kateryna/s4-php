<?php

namespace jeuxvideo\models;

class GameRating extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'game_rating';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function ratingBoard()
    {
        return $this->belongsTo(RatingBoard::class, 'rating_board_id');
    }
}