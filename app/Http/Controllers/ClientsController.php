<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        $clients = Clients::where('status', 1)->pluck('name', 'id');

        return $clients;
    }
}
