<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function getCompanyReviews(Request $request, $id) {

        $company = Company::all()->find($id);
        $reviews = $company->reviews;

        return view('company', [ 'company' => $company, 'reviews' =>  $reviews, 'reviews_count' => $reviews->count() ]);
    }

}
