<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExamSession;

class ExamSessionController extends Controller
{
    public function activeSessions()
    {
        return view('admin.exam-sessions.active');
    }

    public function completedSessions()
    {
        return view('admin.exam-sessions.completed');
    }

    public function monitor()
    {
        return view('admin.exam-sessions.monitor');
    }

    public function manage(Request $request, ExamSession $examSession)
    {
        return view('admin.exam-sessions.manage', compact('examSession'));
    }
}
