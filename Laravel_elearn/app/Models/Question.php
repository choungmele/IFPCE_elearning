<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'options', 'correct_answer'];
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}