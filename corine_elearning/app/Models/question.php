<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{


    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'titre',
        'choix_1',
        'choix_2',
        'choix_3',
        'choix_4',
        'correct',
    ];
}
