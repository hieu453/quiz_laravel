<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class Quiz extends Model
{
    use HasFactory, Commentable;

    protected $fillable = [
        'title',
        'has_questions'
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
