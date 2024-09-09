<?php

namespace App\Http\Controllers;

use App\Models\TypeProjects;
use Illuminate\Http\Request;

class TypeProjectsController extends Controller
{
    public function index()
    {
        $type_projects = TypeProjects::where('status', 1)->pluck('name', 'id');

        return $type_projects;
    }
}
