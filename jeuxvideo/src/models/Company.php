<?php

namespace jeuxvideo\models;

/**
 * Modèle Company : Représente une entreprise de développement de jeux vidéo ou un éditeur
 */
class Company extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'company';  // Nom de la table dans la base de données
    protected $primaryKey = 'id'; // Clé primaire de la table
    public $timestamps = true; // Active les timestamps (created_at, updated_at)

    /**
     * Relation Many-to-Many : Liste des jeux développés par cette entreprise
     */
    public function developedGames() {
        return $this->belongsToMany(Game::class, 'game_developers', 'comp_id', 'game_id');
    }

    /**
     * Relation Many-to-Many : Liste des jeux publiés par cette entreprise
     */
    public function publishedGames() {
        return $this->belongsToMany(Game::class, 'game_publishers', 'comp_id', 'game_id');
    }
}