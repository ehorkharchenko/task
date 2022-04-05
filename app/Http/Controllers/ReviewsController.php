<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function reviews(Request $request, $id) {

        $company = Company::all()->find($id);
        $reviews = $company->reviews;

        return view('company', [ 'company' => $company, 'reviews' =>  $reviews, 'reviews_count' => $reviews->count() ]);
    }

    public function add_review(Request $request) {

        $review = new Review();

        $review->company_id = $request->input('id');
        $review->name = $request->input('name');
        $review->email = $request->input('email');
        $review->text = $request->input('text');
        $review->confirmed = false;

        $review->save();

        return redirect()->route('home');
    }

    public function get_unconfirmed_reviews() {

        $reviews = Review::all()->where('confirmed', false);

        return view('admin.review.confirmation', ['reviews' => $reviews]);
    }

    public function confirm_review(Request $request) {

        $review = Review::find($request->id);
        $review->confirmed = true;
        $review->save();

        return redirect()->route('review-confirmation');
    }

    public function remove_review(Request $request) {

        Review::find($request->id)->delete();

        return redirect()->route('review-confirmation');
    }

    public function edit_review(Request $request) {

        $review = Review::find($request->id);
        $review->name = $request->input('name');
        $review->email = $request->input('email');
        $review->text = $request->input('text');
        $review->save();

//        return redirect()->route('review-confirmation');
    }

    public function list (Request $request, $id) {
        $company = Company::all()->find($id);
        $reviews = $company->reviews;

        return view('admin.review.list', ['reviews' => $reviews]);
    }
}
