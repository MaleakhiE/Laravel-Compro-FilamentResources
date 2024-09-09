<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::orderBy('position', 'asc')->where('status', '1')->get();

        return $menu;
    }
}
