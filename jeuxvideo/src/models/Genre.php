<?php

namespace jeuxvideo\models;

/**
 * Modèle Genre : Représente un genre de jeu (RPG, FPS, etc.)
 */
class Genre extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'genre';  // Nom de la table dans la base de données
    protected $primaryKey = 'id'; // Clé primaire de la table
    public $timestamps = false; //  désactive la gestion des colonnes created_at et updated_at

    /**
     * Relation Many-to-Many : Un genre peut être associé à plusieurs jeux
     */
    public function games()
    {
        return $this->belongsToMany(Game::class, 'game2genre', 'genre_id', 'game_id');
    }
}