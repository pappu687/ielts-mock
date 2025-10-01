<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuestionBank;
use App\Helpers\DataTableHelper;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuestionBankController extends Controller
{
    public function index()
    {
        // Example 1: Using dynamic columns with exclusions
        $excludeColumns = ['updated_at', 'created_by']; // Exclude these columns
        $columns = DataTableHelper::getColumns('question_banks', $excludeColumns, true);
        
        // Example 2: Using static columns (backward compatibility)
        // $columns = DataTableHelper::getColumns('question_banks');
        
        // Example 3: Using static columns with exclusions
        // $columns = DataTableHelper::getColumns('question_banks', ['created_by', 'updated_at']);
        
        return view('admin.question-banks.index', compact('columns'));
    }

    public function store(Request $request)
    {
        return view('admin.question-banks.store');
    }

    public function update(Request $request, QuestionBank $questionBank)
    {
        return view('admin.question-banks.update', compact('questionBank'));
    }

    public function toggleActive(Request $request, QuestionBank $questionBank)
    {
        return view('admin.question-banks.toggle', compact('questionBank'));
    }

    public function bulkImport(Request $request)
    {
        return view('admin.question-banks.bulk-import');
    }

    public function bulkExport()
    {
        return view('admin.question-banks.bulk-export');
    }

    /**
     * Get question banks data for DataTable
     */
    public function listQuestionBanks(Request $request)
    {
        if ($request->ajax()) {
            // Select columns that match the dynamic column structure
            $questionBanks = QuestionBank::select(['id', 'name', 'description', 'difficulty_level', 'skill_type', 'is_active', 'created_at']);
            
            return DataTables::of($questionBanks)
                ->addColumn('question_count', function ($questionBank) {
                    // This would be a relationship count in real implementation
                    return rand(5, 50); // Placeholder
                })
                ->addColumn('is_active', function ($questionBank) {
                    return $questionBank->is_active ? 
                        '<span class="badge badge-success">Active</span>' : 
                        '<span class="badge badge-outline-danger">Inactive</span>';
                })
                ->editColumn('is_active', function ($questionBank) {
                    return $questionBank->is_active ? 'Yes' : 'No';
                })
                ->editColumn('created_at', function ($questionBank) {
                    return $questionBank->created_at->format('Y-m-d H:i:s');
                })
                ->editColumn('difficulty_level', function ($questionBank) {
                    return ucfirst($questionBank->difficulty_level);
                })
                ->editColumn('skill_type', function ($questionBank) {
                    return ucfirst($questionBank->skill_type);
                })
                ->addColumn('actions', function ($questionBank) {
                    $actions = '<div class="btn-group btn-group-sm" role="group">';
                    $actions .= '<a href="#" class="btn btn-sm btn-outline-info">View</a>';
                    $actions .= '<a href="#" class="btn btn-sm btn-outline-primary">Edit</a>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-warning" onclick="toggleActive(' . $questionBank->id . ')">Toggle</button>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteQuestionBank(' . $questionBank->id . ')">Delete</button>';
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['is_active', 'actions'])
                ->make(true);
        }
    }
}
