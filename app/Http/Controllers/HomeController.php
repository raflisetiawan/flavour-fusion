<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kedai;
use App\Models\Menu;

class HomeController extends Controller
{
    public function index()
    {
        $kedais = Kedai::where('status', 'approved')
                        ->with(['menus' => function ($query) {
                            $query->take(8); // Ambil 8 menu saja
                        }])
                        ->take(8) // Ambil 8 kedai saja
                        ->get();

        return view('pages.index', compact('kedais'));
    }
}
