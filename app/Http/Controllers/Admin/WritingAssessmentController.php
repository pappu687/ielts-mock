<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\WritingAssessment;

class WritingAssessmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = WritingAssessment::with(['examSection.examSession.user', 'examSection.examSession.examType'])
                ->select('writing_assessments.*');

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
                    // Assuming status is on examSection or we derive it from scores
                    return $row->overall_band_score ? '<span class="badge bg-success">Graded</span>' : '<span class="badge bg-warning">Pending</span>';
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <button type="button" class="btn btn-sm btn-primary grade-btn" 
                            data-id="'.$row->id.'" 
                            data-ta="'.$row->task_achievement_score.'"
                            data-cc="'.$row->coherence_cohesion_score.'"
                            data-lr="'.$row->lexical_resource_score.'"
                            data-ga="'.$row->grammar_accuracy_score.'"
                            data-bs-toggle="offcanvas" 
                            data-bs-target="#gradeOffcanvas">
                            <i class="ri-edit-line"></i> Grade
                        </button>
                    ';
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

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
        $request->validate([
            'task_achievement_score' => 'required|numeric|min:0|max:9',
            'coherence_cohesion_score' => 'required|numeric|min:0|max:9',
            'lexical_resource_score' => 'required|numeric|min:0|max:9',
            'grammar_accuracy_score' => 'required|numeric|min:0|max:9',
        ]);

        $scores = [
            $request->task_achievement_score,
            $request->coherence_cohesion_score,
            $request->lexical_resource_score,
            $request->grammar_accuracy_score
        ];

        $overallScore = round(array_sum($scores) / 4 * 2) / 2;

        $writingAssessment->update([
            'task_achievement_score' => $request->task_achievement_score,
            'coherence_cohesion_score' => $request->coherence_cohesion_score,
            'lexical_resource_score' => $request->lexical_resource_score,
            'grammar_accuracy_score' => $request->grammar_accuracy_score,
            'overall_band_score' => $overallScore,
            'assessor_type' => 'Human',
            'assessed_at' => now(),
        ]);

        return response()->json(['message' => 'Assessment graded successfully']);
    }

    public function provideFeedback(Request $request, WritingAssessment $writingAssessment)
    {
        return view('admin.writing-assessments.feedback', compact('writingAssessment'));
    }
}
