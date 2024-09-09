<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemInformation;

class SystemInformationController extends Controller
{
    public function index()
    {
        $system_information = SystemInformation::first();

        return $system_information;
    }
}
