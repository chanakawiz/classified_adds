<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $ads = $category->ads()->latest()->paginate(10);

        return view('categories.show', compact('category', 'ads'));
    }

}
