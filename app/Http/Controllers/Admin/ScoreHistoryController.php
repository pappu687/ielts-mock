<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class ScoreHistoryController extends Controller
{
    public function index(User $user)
    {
        return view('admin.score-history.index', compact('user'));
    }

    public function trends(User $user)
    {
        return view('admin.score-history.trends', compact('user'));
    }

    public function export(User $user)
    {
        return view('admin.score-history.export', compact('user'));
    }
}
