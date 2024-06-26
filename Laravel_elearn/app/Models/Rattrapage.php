<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rattrapage extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'file_path', 'publish_at'];
}
