<?php

use Illuminate\Support\Facades\Route;
use App\Models\Province;

Route::get('/hello', function () {
    return response()->json(['message' => 'Hello from API!']);
});

Route::get('/provinces/{province}/districts', function (Province $province) {
    return $province->districts()->select('id', 'name')->orderBy('name')->get();
});
