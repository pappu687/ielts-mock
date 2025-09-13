<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SpeakingAssessment;

class SpeakingAssessmentController extends Controller
{
    public function index()
    {
        return view('admin.speaking-assessments.index');
    }

    public function assignAssessor(Request $request)
    {
        return view('admin.speaking-assessments.assign-assessor');
    }

    public function reviewAI(SpeakingAssessment $speakingAssessment)
    {
        return view('admin.speaking-assessments.ai', compact('speakingAssessment'));
    }

    public function updateScores(Request $request, SpeakingAssessment $speakingAssessment)
    {
        return view('admin.speaking-assessments.scores', compact('speakingAssessment'));
    }

    public function provideFeedback(Request $request, SpeakingAssessment $speakingAssessment)
    {
        return view('admin.speaking-assessments.feedback', compact('speakingAssessment'));
    }
}
