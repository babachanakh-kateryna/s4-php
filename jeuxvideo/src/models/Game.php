<?php

namespace jeuxvideo\models;

/**
 * Modèle Game : Représente un jeu vidéo
 */
class Game extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'game';  // Nom de la table dans la base de données
    protected $primaryKey = 'id'; // Clé primaire de la table
    public $timestamps = true; // Active les timestamps (created_at, updated_at)

    /**
     * Relation Many-to-Many : Un jeu peut avoir plusieurs personnages
     */
    public function characters() {
        return $this->belongsToMany(Character::class, 'game2character', 'game_id', 'character_id');
    }

    /**
     * Relation One-to-Many : Un jeu peut avoir plusieurs personnages qui sont apparus pour la première fois dans ce jeu
     */
    public function firstAppearedCharacters()
    {
        return $this->hasMany(Character::class, 'first_appeared_in_game_id');
    }

    /**
     * Relation Many-to-Many : Un jeu peut être développé par plusieurs entreprises
     */
    public function developers() {
        return $this->belongsToMany(Company::class, 'game_developers', 'game_id', 'comp_id');
    }

    /**
     * Relation Many-to-Many : Un jeu peut être publié par plusieurs entreprises
     */
    public function publishers() {
        return $this->belongsToMany(Company::class, 'game_publishers', 'game_id', 'comp_id');
    }

    /**
     * Relation Many-to-Many : Un jeu peut avoir plusieurs classements (6+, 12+, etc.)
     */
    public function ratings() {
        return $this->belongsToMany(GameRating::class, 'game2rating', 'game_id', 'rating_id');
    }

    /**
     * Relation Many-to-Many : Un jeu peut avoir plusieurs genres
     */
    public function genres() {
        return $this->belongsToMany(Genre::class, 'game2genre', 'game_id', 'genre_id');
    }

    /**
     * Relation Many-to-Many : Un jeu peut être disponible sur plusieurs plateformes
     */
    public function platforms() {
        return $this->belongsToMany(Platform::class, 'game2platform', 'game_id', 'platform_id');
    }

    /**
     * Relation Many-to-Many : Un jeu peut avoir plusieurs thèmes (horreur, sci-fi, etc.)
     */
    public function themes()
    {
        return $this->belongsToMany(Theme::class, 'game2theme', 'game_id', 'theme_id');
    }
}