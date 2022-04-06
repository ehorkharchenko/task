<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function createCompany(Request $request) {

        $company = new Company();

        $company->name = $request->input('name');
        $company->description = $request->input('description');

        $company->save();

        return redirect()->route('company-create');
    }

    public function editCompany(Request $request) {

        $company = Company::find( $request->input('id') );

        $company->name = $request->input('name');
        $company->description = $request->input('description');

        $company->save();

        return redirect()->route('company-list');
    }

    public function deleteCompany(Request $request) {

        Company::find( $request->input('id') )->delete();

        return redirect()->route('company-list');
    }

    public function getCompanies() {

        $companies = Company::all();

        return view('admin.company.list', [ 'companies' => $companies ]);
    }

    public function getCompanyReviews(Request $request, $id) {

        $company = Company::all()->find($id);
        $reviews = $company->reviews;

        return view('admin.review.list', ['reviews' => $reviews]);
    }
}
