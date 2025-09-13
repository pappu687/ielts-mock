<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserProgressController extends Controller
{
    public function index(User $user)
    {
        return view('admin.progress.index', compact('user'));
    }

    public function reports(User $user)
    {
        return view('admin.progress.reports', compact('user'));
    }

    public function performance(User $user)
    {
        return view('admin.progress.performance', compact('user'));
    }

    public function assignStudyPlan(Request $request, User $user)
    {
        return view('admin.progress.assign-study-plan', compact('user'));
    }
}
