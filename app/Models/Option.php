<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'question_id',
        'is_correct'
    ];

    public $timestamps = false;

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
