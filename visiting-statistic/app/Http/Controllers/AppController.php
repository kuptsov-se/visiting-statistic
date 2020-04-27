<?php declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Laravel\Lumen\Routing\Controller;

class AppController extends Controller
{
    public function index() : Renderable
    {
        return view('app');
    }
}
