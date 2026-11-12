<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;
use App\Models\Reviews;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request)
    {
        Review::create([
            'user_id' => auth()->id(),
            'text' => $request->validated()['text'],
        ]);

        return redirect()
        ->route('index');
    }
}
