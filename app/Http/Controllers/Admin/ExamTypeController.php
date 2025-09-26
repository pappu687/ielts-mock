<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Helpers\DataTableHelper;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

class ExamTypeController extends Controller
{
    public function index()
    {
        $columns = DataTableHelper::getColumns('exam_types');
        return view('admin.exam-types.index', compact('columns'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'duration_minutes' => ['required', 'integer', 'min:1'],
            'skills_included' => ['nullable', 'array'],
            'skills_included.*' => [Rule::in(['listening','reading','writing','speaking'])],
            'pricing_tier' => ['nullable', 'string', 'max:50'],
        ]);

        $examType = ExamType::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'duration_minutes' => $validated['duration_minutes'],
            'skills_included' => $validated['skills_included'] ?? [],
            'pricing_tier' => $validated['pricing_tier'] ?? null,
        ]);

        return redirect()->route('admin.exam-types.index')->with('success', 'Exam Type created successfully');
    }

    public function update(Request $request, ExamType $examType)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'duration_minutes' => ['required', 'integer', 'min:1'],
            'skills_included' => ['nullable', 'array'],
            'skills_included.*' => [Rule::in(['listening','reading','writing','speaking'])],
            'pricing_tier' => ['nullable', 'string', 'max:50'],
        ]);

        $examType->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'duration_minutes' => $validated['duration_minutes'],
            'skills_included' => $validated['skills_included'] ?? [],
            'pricing_tier' => $validated['pricing_tier'] ?? null,
        ]);

        return redirect()->route('admin.exam-types.index')->with('success', 'Exam Type updated successfully');
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
            $examTypes = ExamType::select(['id', 'name', 'description', 'duration_minutes', 'pricing_tier', 'created_at']);
            
            return DataTables::of($examTypes)
                ->addColumn('duration', function ($examType) {
                    return $examType->duration_minutes ? $examType->duration_minutes . ' minutes' : 'N/A';
                })
                ->addColumn('price', function ($examType) {
                    return $examType->pricing_tier ? ucfirst($examType->pricing_tier) : 'Default';
                })
                ->editColumn('created_at', function ($examType) {
                    return $examType->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('actions', function ($examType) {
                    $actions = '<div class="btn-group btn-group-sm" role="group">';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-primary" onclick="openEditExamTypeModal(' . $examType->id . ')">Edit</button>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-warning" onclick="setPricing(' . $examType->id . ')">Pricing</button>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteExamType(' . $examType->id . ')">Delete</button>';
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['actions', 'duration', 'price', 'created_at'])
                ->make(true);
        }
    }
}
