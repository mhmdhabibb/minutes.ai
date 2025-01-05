<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'file_name',
        'original_file_name', // Add this
        'transcription',
        'summary',
    ];
    

    protected $casts = [
        'transcription' => 'array',
    ];
}
