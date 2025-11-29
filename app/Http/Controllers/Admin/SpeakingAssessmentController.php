<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SpeakingAssessment;

class SpeakingAssessmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = SpeakingAssessment::with(['examSection.examSession.user', 'examSection.examSession.examType'])
                ->select('speaking_assessments.*');

            return datatables()->of($query)
                ->addColumn('user_name', function ($row) {
                    return $row->examSection->examSession->user->name ?? 'N/A';
                })
                ->addColumn('exam_type', function ($row) {
                    return $row->examSection->examSession->examType->name ?? 'N/A';
                })
                ->addColumn('date', function ($row) {
                    return $row->created_at->format('Y-m-d H:i');
                })
                ->addColumn('overall_score', function ($row) {
                    return $row->overall_band_score ?? 'Pending';
                })
                ->addColumn('status', function ($row) {
                    return $row->overall_band_score ? '<span class="badge bg-success">Graded</span>' : '<span class="badge bg-warning">Pending</span>';
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <button type="button" class="btn btn-sm btn-primary grade-btn" 
                            data-id="'.$row->id.'" 
                            data-fc="'.$row->fluency_coherence_score.'"
                            data-lr="'.$row->lexical_resource_score.'"
                            data-gr="'.$row->grammar_range_score.'"
                            data-pr="'.$row->pronunciation_score.'"
                            data-bs-toggle="offcanvas" 
                            data-bs-target="#gradeOffcanvas">
                            <i class="ri-edit-line"></i> Grade
                        </button>
                    ';
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

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
        $request->validate([
            'fluency_coherence_score' => 'required|numeric|min:0|max:9',
            'lexical_resource_score' => 'required|numeric|min:0|max:9',
            'grammar_range_score' => 'required|numeric|min:0|max:9',
            'pronunciation_score' => 'required|numeric|min:0|max:9',
        ]);

        $scores = [
            $request->fluency_coherence_score,
            $request->lexical_resource_score,
            $request->grammar_range_score,
            $request->pronunciation_score
        ];

        $overallScore = round(array_sum($scores) / 4 * 2) / 2;

        $speakingAssessment->update([
            'fluency_coherence_score' => $request->fluency_coherence_score,
            'lexical_resource_score' => $request->lexical_resource_score,
            'grammar_range_score' => $request->grammar_range_score,
            'pronunciation_score' => $request->pronunciation_score,
            'overall_band_score' => $overallScore,
            'assessor_type' => 'Human',
            'assessed_at' => now(),
        ]);

        return response()->json(['message' => 'Assessment graded successfully']);
    }

    public function provideFeedback(Request $request, SpeakingAssessment $speakingAssessment)
    {
        return view('admin.speaking-assessments.feedback', compact('speakingAssessment'));
    }
}
