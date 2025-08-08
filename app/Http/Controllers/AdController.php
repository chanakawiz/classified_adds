<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdController extends Controller
{
    protected static $middleware = [
        'auth'
    ];

    // Show the ad creation form
    public function create()
    {
        $categories = Category::all();
        return view('ads.create', compact('categories'));
    }

    // Handle form submission
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to post an ad.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'nullable|numeric',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'images.*' => 'nullable|image',
        ]);

        $ad = new Ad();
        $ad->user_id = auth()->id(); // <-- Set the user_id from the logged-in user
        $ad->title = $request->title;
        $ad->description = $request->description;
        $ad->category_id = $request->category_id;
        $ad->price = $request->price;
        $ad->contact_email = $request->contact_email;
        $ad->contact_phone = $request->contact_phone;

        if ($request->hasFile('images')) {
            foreach (array_slice($request->file('images'), 0, 6) as $image) {
                $ad->addMedia($image)->toMediaCollection('ads');
            }
        } else {
            Log::error('No images uploaded!');
        }

        $ad->save();

        return redirect('/')->with('success', 'Ad created successfully!');
    }
}
