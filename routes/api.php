<?php

use Illuminate\Support\Facades\Route;

Route::get('/version', function () {
    return response()->json(['last_hash' => config('app.version')]);
});
