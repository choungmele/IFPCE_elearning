<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;
    protected $fillable = ['filename', 'heure_debut', 'heure_fin', 'specialite', 'id_apprenants'];
    
}
