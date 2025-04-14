<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];

    public function authors() {
        return $this->belongsToMany(Author::class);  
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
