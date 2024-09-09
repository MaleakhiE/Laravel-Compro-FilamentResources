<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectsShowCases extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'project_id',
        'image',
        'video',
        'position',
        'description',
        'status',
    ];

    public function projects()
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }
}
