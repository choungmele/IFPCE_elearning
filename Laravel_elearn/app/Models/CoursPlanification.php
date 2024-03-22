<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursPlanification extends Model
{
    use HasFactory;

    protected $fillable = [
        'seance', 'cours', 'formateur', 'formateur_assistant', 'site', 'jour', 'heure_debut', 'heure_fin'
    ];

    protected $dates = ['date_debut', 'date_fin'];
}
