<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_cours',
        'specialite',
        'session',
        'titre',
        'chemin',
        'type',
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
