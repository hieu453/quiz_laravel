<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $casts = [
        'answers' => 'json',
    ];

    protected $fillable = [
        'user_id',
        'quiz_id',
        'answers'
    ];
}
