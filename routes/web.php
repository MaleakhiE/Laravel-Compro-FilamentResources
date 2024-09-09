<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\TypeProjectsController;
use App\Http\Controllers\ProjectsShowCaseController;
use App\Http\Controllers\SystemInformationController;

Route::get('/', function () {
    $banners = app(BannersController::class)->index();
    $services = app(ServicesController::class)->index();
    $clients = app(ClientsController::class)->index();
    $projects = app(ProjectsController::class)->index();
    $type_projects = app(TypeProjectsController::class)->index();
    $projects_show_case = app(ProjectsShowCaseController::class)->index();
    $system_information = app(SystemInformationController::class)->index();
    $menu = app(MenuController::class)->index();

    return view('index', compact('banners', 'services', 'clients', 'projects', 'type_projects', 'projects_show_case', 'system_information', 'menu'));
});
