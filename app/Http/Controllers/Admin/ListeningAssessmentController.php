<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExamSection;

class ListeningAssessmentController extends Controller
{
    public function scores(Request $request)
    {
        if ($request->ajax()) {
            $query = ExamSection::with(['examSession.user', 'examSession.examType'])
                ->where('section_type', 'listening')
                ->select('exam_sections.*');

            return datatables()->of($query)
                ->addColumn('user_name', function ($row) {
                    return $row->examSession->user->name ?? 'N/A';
                })
                ->addColumn('exam_type', function ($row) {
                    return $row->examSession->examType->name ?? 'N/A';
                })
                ->addColumn('date', function ($row) {
                    return $row->created_at->format('Y-m-d H:i');
                })
                ->addColumn('status', function ($row) {
                    $statusClass = match($row->status) {
                        'completed' => 'success',
                        'in_progress' => 'primary',
                        'pending' => 'warning',
                        default => 'secondary'
                    };
                    return '<span class="badge bg-'.$statusClass.'">'.ucfirst($row->status).'</span>';
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <button type="button" class="btn btn-sm btn-primary edit-score-btn" 
                            data-id="'.$row->id.'" 
                            data-score="'.$row->band_score.'"
                            data-bs-toggle="offcanvas" 
                            data-bs-target="#editScoreOffcanvas">
                            <i class="ri-edit-line"></i> Edit
                        </button>
                    ';
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

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

    public function updateScore(Request $request, ExamSection $examSection)
    {
        $request->validate([
            'band_score' => 'required|numeric|min:0|max:9',
        ]);

        $examSection->update([
            'band_score' => $request->band_score,
        ]);

        return response()->json(['message' => 'Score updated successfully']);
    }
}
