<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Province;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    protected static $middleware = [
        'auth'
    ];

    // Show the ad creation form
    public function create()
    {
        $categories = Category::all();
        $provinces = Province::orderBy('name')->get();
        return view('ads.create', compact('categories', 'provinces'));
    }

    // Handle form submission
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to post an ad.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'nullable|numeric',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'images.*' => 'nullable|image',
        ]);

        // Ensure the selected district belongs to the selected province
        $districtBelongsToProvince = District::where('id', $request->district_id)
            ->where('province_id', $request->province_id)
            ->exists();

        if (! $districtBelongsToProvince) {
            return back()
                ->withErrors(['district_id' => 'Selected district does not belong to the chosen province.'])
                ->withInput();
        }

        $ad = new Ad();
        $ad->user_id = Auth::id(); // <-- Set the user_id from the logged-in user
        $ad->title = $request->title;
        $ad->description = $request->description;
        $ad->category_id = $request->category_id;
        $ad->province_id = $request->province_id;
        $ad->district_id = $request->district_id;
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

    // Show single ad details page
    public function show(Ad $ad)
    {
        return view('ads.show', [
            'ad' => $ad->load(['category', 'province', 'district', 'media']),
        ]);
    }
}
