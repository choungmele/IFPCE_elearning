<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    // app/Models/Session.php
    
    protected $fillable = [
        'nom',
       
    ];

    public function apprenants()
    {
        return $this->hasMany(Apprenant::class);
    }
    public function courss()
    {
        return $this->hasMany(Cours::class);
    }
    public function programmations()
    {
        return $this->hasMany(programmationCours::class);
    }

}
