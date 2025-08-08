<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::withCount('ads')
            ->with(['recent_ads' => function($q) {
                $q->latest()->take(3);
            }])
            ->orderByDesc('ads_count')
            ->get();

        return view('welcome', compact('categories'));
    }
}

