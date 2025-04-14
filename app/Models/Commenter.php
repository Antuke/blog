<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commenter extends Model
{
    protected $fillable = [
        'name',
        'email',
        'google_id',
    ];
    protected $table = 'commenters';
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
