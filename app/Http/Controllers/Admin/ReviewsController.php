<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function getUnconfirmedReviews() {

        $reviews = Review::all()->where('confirmed', false);

        return view('admin.review.confirmation', ['reviews' => $reviews]);
    }

    public function confirmReview(Request $request) {

        $review = Review::find($request->id);

        $review->confirmed = true;

        $review->save();

        return redirect()->route('review-unconfirmed');
    }

    public function getCompanyReviews(Request $request, $id) {
        $company = Company::all()->find($id);
        $reviews = $company->reviews;

        return view('admin.review.list', ['reviews' => $reviews]);
    }

    public function editReview(Request $request) {

        $review = Review::find($request->id);

        $review->name = $request->input('name');
        $review->email = $request->input('email');
        $review->text = $request->input('text');

        $review->save();

        return redirect()->route('dashboard');
    }

    public function deleteReview(Request $request) {

        Review::find($request->id)->delete();

        return redirect()->route('dashboard');
    }
}
