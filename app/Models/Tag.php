<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function thesis()
    {
        //return $this->morphedByMany(Thesis::class, 'tag_thesis');
        return $this->hasManyThrough(
            'App\Models\Thesis',
            'App\Models\ThesisTag',
            'tag_id',
            'id',
            'id',
            'thesis_id'
        );
    }   
}
