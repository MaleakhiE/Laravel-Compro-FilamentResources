<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banners;

class BannersController extends Controller
{
    public function index()
    {
        $banners = Banners::orderBy('position', 'asc')->where('status', '1')->get();
        return $banners;
    }
}
