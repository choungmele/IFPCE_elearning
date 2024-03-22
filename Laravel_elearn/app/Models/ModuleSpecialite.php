<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleSpecialite extends Model
{
    use HasFactory;
    //protected $table = 'module_specialites';
    protected $fillable = [
        'nom',
        'code',
        'specialite_id',
        // Ajoutez d'autres champs liés à votre module
    ];

    public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }
}
