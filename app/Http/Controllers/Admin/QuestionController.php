<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Helpers\DataTableHelper;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuestionController extends Controller
{
    public function index()
    {
        $columns = DataTableHelper::getColumns('questions');
        return view('admin.questions.index', compact('columns'));
    }

    public function store(Request $request)
    {
        return view('admin.questions.store');
    }

    public function update(Request $request, Question $question)
    {
        return view('admin.questions.update', compact('question'));
    }

    public function approve(Request $request, Question $question)
    {
        return view('admin.questions.approve', compact('question'));
    }

    public function updateMetadata(Request $request, Question $question)
    {
        return view('admin.questions.metadata', compact('question'));
    }

    /**
     * Get questions data for DataTable
     */
    public function listQuestions(Request $request)
    {
        if ($request->ajax()) {
            $questions = Question::select(['id', 'question_text', 'question_type', 'difficulty', 'is_approved', 'created_at']);
            
            return DataTables::of($questions)
                ->addColumn('is_approved', function ($question) {
                    return $question->is_approved ? 
                        '<span class="badge badge-success">Approved</span>' : 
                        '<span class="badge badge-outline-warning">Pending</span>';
                })
                ->editColumn('is_approved', function ($question) {
                    return $question->is_approved ? 'Yes' : 'No';
                })
                ->editColumn('question_text', function ($question) {
                    return \Str::limit($question->question_text, 50);
                })
                ->editColumn('created_at', function ($question) {
                    return $question->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('actions', function ($question) {
                    $actions = '<div class="btn-group btn-group-sm" role="group">';
                    $actions .= '<a href="#" class="btn btn-sm btn-outline-info">View</a>';
                    $actions .= '<a href="#" class="btn btn-sm btn-outline-primary">Edit</a>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-success" onclick="approveQuestion(' . $question->id . ')">Approve</button>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteQuestion(' . $question->id . ')">Delete</button>';
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['is_approved', 'actions', 'question_text', 'created_at'])
                ->make(true);
        }
    }
}
