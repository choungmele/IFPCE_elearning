<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    use HasFactory;
     
    protected $fillable = [
        'nom',
        'code_specialite',
       
    ];

    public function apprenants()
    {
        return $this->hasMany(Apprenant::class);
    }
    public function courss()
    {
        //return $this->hasMany(Cours::class);
        return $this->belongsToMany(Cours::class, 'cours_specialite');
    }
    public function programmations()
    {
        return $this->hasMany(programmationCours::class);
    }
   
}
