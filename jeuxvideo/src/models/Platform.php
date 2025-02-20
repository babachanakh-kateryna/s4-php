<?php

namespace jeuxvideo\models;

/**
 * Modèle Platform : Représente une plateforme (PC, PS4, Xbox, etc.)
 */
class Platform extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'platform';  // Nom de la table dans la base de données
    protected $primaryKey = 'id'; // Clé primaire de la table
    public $timestamps = true; // Active les timestamps (created_at, updated_at)

    /**
     * Relation Many-to-Many : Une plateforme peut supporter plusieurs jeux
     */
    public function games()
    {
        return $this->belongsToMany(Game::class, 'game2platform', 'platform_id', 'game_id');
    }
}