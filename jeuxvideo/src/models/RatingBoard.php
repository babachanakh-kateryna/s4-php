<?php

namespace jeuxvideo\models;

/**
 * Modèle RatingBoard : Représente un organisme qui attribue les classifications d'âge aux jeux
 */
class RatingBoard extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'rating_board';  // Nom de la table dans la base de données
    protected $primaryKey = 'id'; // Clé primaire de la table
    public $timestamps = false; //  désactive la gestion des colonnes created_at et updated_at

    /**
     * Relation One-to-Many : Un organisme peut attribuer plusieurs classifications d'âge
     */
    public function ratings()
    {
        return $this->hasMany(GameRating::class, 'rating_board_id');
    }
}