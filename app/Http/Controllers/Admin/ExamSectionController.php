<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExamSection;

class ExamSectionController extends Controller
{
    public function show(ExamSection $examSection)
    {
        return view('admin.exam-sections.show', compact('examSection'));
    }

    public function updateSettings(Request $request, ExamSection $examSection)
    {
        return view('admin.exam-sections.settings', compact('examSection'));
    }

    public function responses(ExamSection $examSection)
    {
        return view('admin.exam-sections.responses', compact('examSection'));
    }
}
