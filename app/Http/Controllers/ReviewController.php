<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request)
    {
        $request->validate([
            'text' => 'required|string|min:10|max:1000',
        ]);

        // 2. ПРОВЕРКА: Оставлял ли пользователь уже отзыв?
        $hasReview = Review::where('user_id', Auth::id())->exists();

        if ($hasReview) {
            return back()->withErrors(['text' => 'Вы уже оставили отзыв. Можно оставить только один отзыв.']);
        }

        // 3. Сохранение
        Review::create([
            'user_id' => Auth::id(),
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Спасибо за ваш отзыв!');
    }
}
