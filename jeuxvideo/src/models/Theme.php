<?php

namespace jeuxvideo\models;

/**
 * Modèle Theme : Représente un thème de jeu (science-fiction, horreur, etc.)
 */
class Theme extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'theme';  // Nom de la table dans la base de données
    protected $primaryKey = 'id'; // Clé primaire de la table
    public $timestamps = false; //  désactive la gestion des colonnes created_at et updated_at

    /**
     * Relation Many-to-Many : Un thème peut être attribué à plusieurs jeux
     */
    public function games()
    {
        return $this->belongsToMany(Game::class, 'game2theme', 'theme_id', 'game_id');
    }
}