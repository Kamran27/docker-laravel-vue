<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'publisher', 'proglang', 'description', 'image', 'file_path' ];
    
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'thesis_tag');
    }    
}
