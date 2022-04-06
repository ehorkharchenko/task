<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{

    public function addReview(Request $request) {

        $review = new Review();

        $review->company_id = $request->input('id');
        $review->name = $request->input('name');
        $review->email = $request->input('email');
        $review->text = $request->input('text');
        $review->confirmed = false;

        $review->save();

        return redirect()->route('home');
    }

}
