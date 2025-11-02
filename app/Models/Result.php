<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'resp_id',
        'quest_id',
    ];

    /**
     * Get the question that owns the result.
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'quest_id', 'quest_id');
    }
}

