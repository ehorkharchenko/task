<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function create_company (Request $request) {

        $company = new Company();

        $company->name = $request->input('name');
        $company->description = $request->input('description');

        $company->save();

        return redirect()->route('company-create');
    }

    public function delete_company (Request $request) {

        Company::find( $request->input('id') )->delete();
    }

    public function edit_company (Request $request) {

        $company = Company::find( $request->input('id') );

        $company->name = $request->input('name');
        $company->description = $request->input('description');

        $company->save();
    }

    public function list () {

        $companies = Company::all();

        return view('admin.company.list', [ 'companies' => $companies ]);
    }
}
