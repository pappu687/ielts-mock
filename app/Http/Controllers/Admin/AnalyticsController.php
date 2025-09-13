<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function userAnalytics()
    {
        return view('admin.analytics.users');
    }

    public function examAnalytics()
    {
        return view('admin.analytics.exams');
    }

    public function systemAnalytics()
    {
        return view('admin.analytics.system');
    }

    public function learningAnalytics()
    {
        return view('admin.analytics.learning');
    }
}
