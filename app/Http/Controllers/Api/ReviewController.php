<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewShowResource;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //
    function show($id)
    {
        return new ReviewShowResource(Review::findOrFail($id));
    }
}
