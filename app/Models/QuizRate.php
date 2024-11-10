<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizRate extends Model
{
    use HasFactory;

    protected $table = 'quiz_rates';

    protected $fillable = [
        'user_id',
        'quiz_id',
        'rating'
    ];
}
