<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestRequest;
use App\Http\Requests\UpdateTestRequest;
use App\Models\Test;
use App\Models\TestSection;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = [
            ['data' => 'id', 'title' => 'ID', 'className' => 'text-center'],
            ['data' => 'name', 'title' => 'Test Name'],
            ['data' => 'type', 'title' => 'Type', 'className' => 'text-center'],
            ['data' => 'sections_count', 'title' => 'Sections', 'className' => 'text-center'],
            ['data' => 'questions_count', 'title' => 'Questions', 'className' => 'text-center'],
            ['data' => 'duration_minutes', 'title' => 'Duration (min)', 'className' => 'text-center'],
            ['data' => 'status', 'title' => 'Status', 'className' => 'text-center'],
            ['data' => 'created_at', 'title' => 'Created', 'className' => 'text-center'],
            ['data' => 'actions', 'title' => 'Actions', 'orderable' => false, 'searchable' => false, 'className' => 'text-center']
        ];

        return view('admin.tests.index', compact('columns'));
    }

    /**
     * Get tests data for DataTables
     */
    public function listTests()
    {
        $tests = Test::withCount(['sections', 'sections as questions_count' => function ($query) {
            $query->withCount('questions');
        }])->latest();

        return DataTables::of($tests)
            ->addColumn('status', function ($test) {
                return $test->is_active 
                    ? '<span class="badge bg-success">Active</span>' 
                    : '<span class="badge bg-secondary">Inactive</span>';
            })
            ->addColumn('duration_minutes', function ($test) {
                return $test->duration_minutes ? $test->duration_minutes . ' min' : 'N/A';
            })
            ->addColumn('questions_count', function ($test) {
                return $test->sections->sum('questions_count');
            })
            ->addColumn('actions', function ($test) {
                $actions = '<div class="btn-group" role="group">';
                $actions .= '<a href="' . route('admin.tests.show', $test->id) . '" class="btn btn-sm btn-info" title="View"><i class="ri-eye-line"></i></a>';
                $actions .= '<a href="' . route('admin.tests.edit', $test->id) . '" class="btn btn-sm btn-warning" title="Edit"><i class="ri-edit-line"></i></a>';
                $actions .= '<button type="button" class="btn btn-sm btn-danger" onclick="deleteTest(' . $test->id . ')" title="Delete"><i class="ri-delete-bin-line"></i></button>';
                $actions .= '</div>';
                return $actions;
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestRequest $request)
    {
        $test = Test::create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'duration_minutes' => $request->duration_minutes,
            'created_by' => auth()->id(),
            'settings' => $request->settings ?? [],
        ]);

        // Create default sections based on test type
        $this->createDefaultSections($test, $request->type);

        return redirect()
            ->route('admin.tests.show', $test)
            ->with('success', 'Test created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        $test->load(['sections.questions', 'sections.resources']);
        return view('admin.tests.show', compact('test'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        return view('admin.tests.edit', compact('test'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestRequest $request, Test $test)
    {
        $test->update([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'duration_minutes' => $request->duration_minutes,
            'settings' => $request->settings ?? [],
        ]);

        return redirect()
            ->route('admin.tests.show', $test)
            ->with('success', 'Test updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        $test->delete();

        return response()->json([
            'success' => true,
            'message' => 'Test deleted successfully.'
        ]);
    }

    /**
     * Toggle test active status
     */
    public function toggleStatus(Test $test)
    {
        $test->update(['is_active' => !$test->is_active]);

        return response()->json([
            'success' => true,
            'message' => 'Test status updated successfully.',
            'is_active' => $test->is_active
        ]);
    }

    /**
     * Create default sections based on test type
     */
    private function createDefaultSections(Test $test, string $type)
    {
        $sections = [];

        switch ($type) {
            case 'listening':
                $sections = [
                    ['name' => 'Part 1', 'description' => 'Conversation between two people'],
                    ['name' => 'Part 2', 'description' => 'Monologue in a social context'],
                    ['name' => 'Part 3', 'description' => 'Conversation between multiple people'],
                    ['name' => 'Part 4', 'description' => 'Academic lecture or talk'],
                ];
                break;

            case 'reading':
                $sections = [
                    ['name' => 'Passage 1', 'description' => 'General interest text'],
                    ['name' => 'Passage 2', 'description' => 'Workplace or training context'],
                    ['name' => 'Passage 3', 'description' => 'Academic text'],
                ];
                break;

            case 'writing':
                $sections = [
                    ['name' => 'Task 1', 'description' => 'Describe visual information'],
                    ['name' => 'Task 2', 'description' => 'Essay writing'],
                ];
                break;

            case 'speaking':
                $sections = [
                    ['name' => 'Part 1', 'description' => 'Introduction and interview'],
                    ['name' => 'Part 2', 'description' => 'Individual long turn'],
                    ['name' => 'Part 3', 'description' => 'Two-way discussion'],
                ];
                break;
        }

        foreach ($sections as $index => $section) {
            TestSection::create([
                'test_id' => $test->id,
                'name' => $section['name'],
                'description' => $section['description'],
                'order' => $index + 1,
                'time_limit_minutes' => $this->getDefaultTimeLimit($type, $index + 1),
            ]);
        }
    }

    /**
     * Get default time limit for sections
     */
    private function getDefaultTimeLimit(string $type, int $sectionNumber): ?int
    {
        $limits = [
            'listening' => [10, 10, 10, 10], // 40 minutes total
            'reading' => [20, 20, 20], // 60 minutes total
            'writing' => [20, 40], // 60 minutes total
            'speaking' => [5, 4, 5], // 14 minutes total
        ];

        return $limits[$type][$sectionNumber - 1] ?? null;
    }
}
