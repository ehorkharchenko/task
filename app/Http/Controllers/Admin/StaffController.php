<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index() {

        return view('admin.staff');
    }

    public function appoint (Request $request) {

        $user = User::all()->where('email', $request->input('email') )->first();

        $user->assignRole('user');
        $user->assignRole('moderator');

        return redirect()->route('appoint-moderator');
    }
}
