<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function emailTemplates()
    {
        return view('admin.notifications.email.templates');
    }

    public function emailLogs()
    {
        return view('admin.notifications.email.logs');
    }

    public function emailSettings(Request $request)
    {
        return view('admin.notifications.email.settings');
    }

    public function createInApp(Request $request)
    {
        return view('admin.notifications.in-app.create');
    }

    public function inAppHistory()
    {
        return view('admin.notifications.in-app.history');
    }

    public function smsTemplates(Request $request)
    {
        return view('admin.notifications.sms.templates');
    }

    public function smsSettings(Request $request)
    {
        return view('admin.notifications.sms.settings');
    }

    public function pushNotifications(Request $request)
    {
        return view('admin.notifications.push.create');
    }

    public function pushLogs()
    {
        return view('admin.notifications.push.logs');
    }
}
