<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExamSection;

class ReadingAssessmentController extends Controller
{
    public function scores()
    {
        return view('admin.reading-assessments.scores');
    }

    public function responses(ExamSection $examSection)
    {
        return view('admin.reading-assessments.responses', compact('examSection'));
    }

    public function generateFeedback(Request $request, ExamSection $examSection)
    {
        return view('admin.reading-assessments.feedback', compact('examSection'));
    }
}
