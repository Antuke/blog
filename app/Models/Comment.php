<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'commenter_id',
        'project_id',
        'content',
    ];

    public function commenter()
    {
        return $this->belongsTo(Commenter::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
