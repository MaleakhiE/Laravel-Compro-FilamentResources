<?php

namespace App\Models;

use App\Models\Clients;
use App\Models\TypeProjects;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projects extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'client_id',
        'type_project',
        'image',
        'link',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class);
    }

    public function type()
    {
        return $this->belongsTo(TypeProjects::class, 'type_project');
    }
}
