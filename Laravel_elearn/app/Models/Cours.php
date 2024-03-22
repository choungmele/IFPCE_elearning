<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cours extends Model
{
    use HasFactory;

    protected $fillable = [
        'specialite',
        'moduleRattachement',
        'intituleCours',
        'code',
        'volumeHoraire',
        'coefficient',
        'observations',
        'formateur',
        'publier',
        'fichier',
        
    ];
  

    public function specialite()
    {
        return $this->belongsToMany(Specialite::class, 'cours_specialite', 'cours_id', 'specialite_id');
    }
    public function programmations()
    {
        return $this->belongsTo(programmationCours::class);
    }
    public function modules()
    {
        return $this->belongsTo(ModuleSpecialite::class);
    }
}