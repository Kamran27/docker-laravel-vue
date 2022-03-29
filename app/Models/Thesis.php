<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'publisher',
        'proglang',
        'description', 
        'image',
        'file_path' 
    ];

    protected $hidden = [
        'laravel_through_key',
        'updated_at',
        'created_at',
    ];
  
    public function tag()
    {
        return $this->hasManyThrough(
            'App\Models\Tag',
            'App\Models\ThesisTag',
            'thesis_id',
            'id',
            'id',
            'tag_id'
        );
    }    
}
