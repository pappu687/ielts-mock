<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemSettingController extends Controller
{
    public function systemStatus()
    {
        return view('admin.settings.system-status');
    }

    public function general(Request $request)
    {
        return view('admin.settings.general');
    }

    public function security(Request $request)
    {
        return view('admin.settings.security');
    }

    public function integrations(Request $request)
    {
        return view('admin.settings.integrations');
    }

    public function examIntegrity(Request $request)
    {
        return view('admin.settings.exam-integrity');
    }

    public function maintenance(Request $request)
    {
        return view('admin.settings.maintenance');
    }
}
