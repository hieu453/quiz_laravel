<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'youtube_link',
        'document_link',
    ];

    public function quizz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }
}
