<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpeakingQuestion;
use App\Helpers\DataTableHelper;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SpeakingQuestionController extends Controller
{
    public function index()
    {
        $columns = DataTableHelper::getColumns('speaking_questions');
        return view('admin.speaking-questions.index', compact('columns'));
    }

    public function store(Request $request)
    {
        return view('admin.speaking-questions.store');
    }

    public function update(Request $request, SpeakingQuestion $speakingQuestion)
    {
        return view('admin.speaking-questions.update', compact('speakingQuestion'));
    }

    public function updateFollowUps(Request $request, SpeakingQuestion $speakingQuestion)
    {
        return view('admin.speaking-questions.follow-ups', compact('speakingQuestion'));
    }

    /**
     * Get speaking questions data for DataTable
     */
    public function listSpeakingQuestions(Request $request)
    {
        if ($request->ajax()) {
            $speakingQuestions = SpeakingQuestion::select(['id', 'question_text', 'part_number', 'difficulty_level', 'time_limit', 'created_at']);
            
            return DataTables::of($speakingQuestions)
                ->addColumn('time_limit', function ($speakingQuestion) {
                    return $speakingQuestion->time_limit ? $speakingQuestion->time_limit . ' seconds' : 'N/A';
                })
                ->editColumn('question_text', function ($speakingQuestion) {
                    return \Str::limit($speakingQuestion->question_text, 50);
                })
                ->editColumn('created_at', function ($speakingQuestion) {
                    return $speakingQuestion->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('actions', function ($speakingQuestion) {
                    $actions = '<div class="btn-group btn-group-sm" role="group">';
                    $actions .= '<a href="#" class="btn btn-sm btn-outline-info">View</a>';
                    $actions .= '<a href="#" class="btn btn-sm btn-outline-primary">Edit</a>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-warning" onclick="updateFollowUps(' . $speakingQuestion->id . ')">Follow-ups</button>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteQuestion(' . $speakingQuestion->id . ')">Delete</button>';
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['actions', 'question_text', 'time_limit', 'created_at'])
                ->make(true);
        }
    }
}
