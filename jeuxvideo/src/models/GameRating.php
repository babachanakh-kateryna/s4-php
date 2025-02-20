<?php

namespace jeuxvideo\models;

/**
 * Modèle GameRating : Représente une classification d'âge attribuée à un jeu
 */
class GameRating extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'game_rating';  // Nom de la table dans la base de données
    protected $primaryKey = 'id'; // Clé primaire de la table
    public $timestamps = false; //  désactive la gestion des colonnes created_at et updated_at

    /**
     * Relation One-to-Many : Un classement appartient à un organisme de classification
     */
    public function ratingBoard()
    {
        return $this->belongsTo(RatingBoard::class, 'rating_board_id');
    }

    /**
     * Relation Many-to-Many : Un classement peut être attribué à plusieurs jeux
     */
    public function games()
    {
        return $this->belongsToMany(Game::class, 'game2rating', 'rating_id', 'game_id');
    }
}