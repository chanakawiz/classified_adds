<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdController extends Controller
{
    // Show the ad creation form
    public function create()
    {
        $categories = Category::all();
        return view('ads.create', compact('categories'));
    }

    // Handle form submission
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'nullable|numeric',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'images.*' => 'nullable|image|max:2048', // accept images up to 2MB
        ]);

        $ad = Ad::create($request->only([
            'title', 'description', 'category_id', 'price', 'contact_email', 'contact_phone'
        ]));



        if ($request->hasFile('images')) {
            foreach (array_slice($request->file('images'), 0, 6) as $image) {
                $ad->addMedia($image)->toMediaCollection('ads');
            }
        } else {
            Log::error('No images uploaded!');
        }


        return redirect('/')->with('success', 'Ad created successfully!');

    }
}
