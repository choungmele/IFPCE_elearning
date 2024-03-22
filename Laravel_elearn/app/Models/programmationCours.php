<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class programmationCours extends Model
{
    use HasFactory;

    protected $fillable = [
        'session',
        'specialite',
        'intituleCours',
        'code',
        'formateur',
        'formateurs',
        'volumeHoraire',
        'debut',
        'fin',
        'observations',
    ];
    protected $dates = ['debut', 'fin'];
    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }
    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }
    
   
}
