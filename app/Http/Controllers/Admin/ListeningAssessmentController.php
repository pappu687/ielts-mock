<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExamSection;

class ListeningAssessmentController extends Controller
{
    public function scores()
    {
        return view('admin.listening-assessments.scores');
    }

    public function responses(ExamSection $examSection)
    {
        return view('admin.listening-assessments.responses', compact('examSection'));
    }

    public function generateFeedback(Request $request, ExamSection $examSection)
    {
        return view('admin.listening-assessments.feedback', compact('examSection'));
    }
}
