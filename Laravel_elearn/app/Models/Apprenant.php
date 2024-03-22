<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apprenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'session',
        'date_naissance',
        'specialite',
        'matricule',
        'numero_cni',
        'date_delivrance',
        'telephone',
        'numero_inscription',
        'nom_personne_contact',
        'numero_personne_contact',
    ];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }


}
