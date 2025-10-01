<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WritingPrompt;
use App\Helpers\DataTableHelper;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WritingPromptController extends Controller
{
    public function index()
    {
        $columns = DataTableHelper::getColumns('writing_prompts');
        return view('admin.writing-prompts.index', compact('columns'));
    }

    public function store(Request $request)
    {
        return view('admin.writing-prompts.store');
    }

    public function update(Request $request, WritingPrompt $writingPrompt)
    {
        return view('admin.writing-prompts.update', compact('writingPrompt'));
    }

    public function setCriteria(Request $request, WritingPrompt $writingPrompt)
    {
        return view('admin.writing-prompts.criteria', compact('writingPrompt'));
    }

    /**
     * Get writing prompts data for DataTable
     */
    public function listWritingPrompts(Request $request)
    {
        if ($request->ajax()) {
            $writingPrompts = WritingPrompt::select(['id', 'task_type', 'difficulty_level', 'minimum_words', 'created_at']);
            
            return DataTables::of($writingPrompts)
                ->addColumn('minimum_words', function ($writingPrompt) {
                    return $writingPrompt->minimum_words ? $writingPrompt->minimum_words . ' words' : 'N/A';
                })
                ->editColumn('created_at', function ($writingPrompt) {
                    return $writingPrompt->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('actions', function ($writingPrompt) {
                    $actions = '<div class="btn-group btn-group-sm" role="group">';
                    $actions .= '<a href="#" class="btn btn-sm btn-outline-info">View</a>';
                    $actions .= '<a href="#" class="btn btn-sm btn-outline-primary">Edit</a>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-warning" onclick="setCriteria(' . $writingPrompt->id . ')">Criteria</button>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-danger" onclick="deletePrompt(' . $writingPrompt->id . ')">Delete</button>';
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['actions', 'word_limit', 'created_at'])
                ->make(true);
        }
    }
}
