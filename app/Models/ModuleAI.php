<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleAI extends Model
{
    protected $fillable = [
        'name',
        'version',
        'type',
        'description'
    ];
}