<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiModel extends Model
{
    protected $table = 'ai_models';

    protected $fillable = [
        'category', 
        'name', 
        'type', 
        'version', 
        'description', 
        'file_path', 
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}