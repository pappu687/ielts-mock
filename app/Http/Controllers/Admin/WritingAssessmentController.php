<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\WritingAssessment;

class WritingAssessmentController extends Controller
{
    public function index()
    {
        return view('admin.writing-assessments.index');
    }

    public function assignAssessor(Request $request)
    {
        return view('admin.writing-assessments.assign-assessor');
    }

    public function reviewAI(WritingAssessment $writingAssessment)
    {
        return view('admin.writing-assessments.ai', compact('writingAssessment'));
    }

    public function updateScores(Request $request, WritingAssessment $writingAssessment)
    {
        return view('admin.writing-assessments.scores', compact('writingAssessment'));
    }

    public function provideFeedback(Request $request, WritingAssessment $writingAssessment)
    {
        return view('admin.writing-assessments.feedback', compact('writingAssessment'));
    }
}
