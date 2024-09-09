<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectsShowCases;

class ProjectsShowCaseController extends Controller
{
    public function index()
    {
        $projects_show_case = ProjectsShowCases::orderBy('position', 'asc')->where('status', 1)->get();
        return $projects_show_case;
    }
}
