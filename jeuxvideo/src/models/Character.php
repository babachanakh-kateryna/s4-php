<?php

namespace jeuxvideo\models;

/**
 * Modèle Character : Représente un personnage dans un jeu vidéo
 */
class Character extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'character';  // Nom de la table dans la base de données
    protected $primaryKey = 'id'; // Clé primaire de la table
    public $timestamps = true; // Active les timestamps (created_at, updated_at)

    /**
     * Relation Many-to-Many : Un personnage peut apparaître dans plusieurs jeux
     */
    public function games()
    {
        return $this->belongsToMany(Game::class, 'game2character', 'character_id', 'game_id');
    }

    /**
     * Relation One-to-One : Le jeu où le personnage est apparu pour la première fois
     */
    public function firstGame() {
        return $this->belongsTo(Game::class, 'first_appeared_in_game_id');
    }

    /**
     * Relation Many-to-Many : Liste des amis d'un personnage
     */
    public function friends() {
        return $this->belongsToMany(Character::class, 'friends', 'char1_id', 'char2_id');
    }

    /**
     * Relation Many-to-Many : Liste des ennemis d'un personnage
     */
    public function enemies() {
        return $this->belongsToMany(Character::class, 'enemies', 'char1_id', 'char2_id');
    }
}