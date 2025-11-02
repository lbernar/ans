<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quest_id',
        'question',
        'type',
        'bu',
    ];

    /**
     * Get the answers for the question.
     */
    public function answers()
    {
        return $this->hasMany(Answer::class, 'quest_id', 'quest_id');
    }

    /**
     * Get the results for the question.
     */
    public function results()
    {
        return $this->hasMany(Result::class, 'quest_id', 'quest_id');
    }
}

