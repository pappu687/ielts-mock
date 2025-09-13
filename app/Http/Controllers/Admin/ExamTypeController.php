<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Helpers\DataTableHelper;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExamTypeController extends Controller
{
    public function index()
    {
        $columns = DataTableHelper::getColumns('exam_types');
        return view('admin.exam-types.index', compact('columns'));
    }

    public function store(Request $request)
    {
        return view('admin.exam-types.store');
    }

    public function update(Request $request, ExamType $examType)
    {
        return view('admin.exam-types.update', compact('examType'));
    }

    public function setPricing(Request $request, ExamType $examType)
    {
        return view('admin.exam-types.pricing', compact('examType'));
    }

    /**
     * Get exam types data for DataTable
     */
    public function listExamTypes(Request $request)
    {
        if ($request->ajax()) {
            $examTypes = ExamType::select(['id', 'name', 'description', 'duration', 'price', 'is_active', 'created_at']);
            
            return DataTables::of($examTypes)
                ->addColumn('duration', function ($examType) {
                    return $examType->duration ? $examType->duration . ' minutes' : 'N/A';
                })
                ->addColumn('price', function ($examType) {
                    return $examType->price ? '$' . number_format($examType->price, 2) : 'Free';
                })
                ->addColumn('is_active', function ($examType) {
                    return $examType->is_active ? 'Yes' : 'No';
                })
                ->editColumn('created_at', function ($examType) {
                    return $examType->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('actions', function ($examType) {
                    $actions = '<div class="btn-group btn-group-sm" role="group">';
                    $actions .= '<a href="#" class="btn btn-sm btn-outline-info">View</a>';
                    $actions .= '<a href="#" class="btn btn-sm btn-outline-primary">Edit</a>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-warning" onclick="setPricing(' . $examType->id . ')">Pricing</button>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteExamType(' . $examType->id . ')">Delete</button>';
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['actions', 'duration', 'price', 'is_active', 'created_at'])
                ->make(true);
        }
    }
}
