<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cours extends Model
{
    use HasFactory;

    protected $fillable = [
        'session',
        'specialite',
        'moduleRattachement',
        'intituleCours',
        'code',
        'volumeHoraire',
        'coefficient',
        'observations',
    ];
}