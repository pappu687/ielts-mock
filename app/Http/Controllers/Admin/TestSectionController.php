<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTestSectionRequest;
use App\Models\TestSection;
use Illuminate\Http\Request;

class TestSectionController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(TestSection $testSection)
    {
        $testSection->load(['test', 'questions', 'resources']);
        return view('admin.test-sections.show', compact('testSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TestSection $testSection)
    {
        $testSection->load('test');
        return view('admin.test-sections.edit', compact('testSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestSectionRequest $request, TestSection $testSection)
    {
        $testSection->update([
            'name' => $request->name,
            'description' => $request->description,
            'order' => $request->order,
            'time_limit_minutes' => $request->time_limit_minutes,
            'instructions' => $request->instructions ?? [],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()
            ->route('admin.tests.show', $testSection->test)
            ->with('success', 'Section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TestSection $testSection)
    {
        $testId = $testSection->test_id;
        $testSection->delete();

        return redirect()
            ->route('admin.tests.show', $testId)
            ->with('success', 'Section deleted successfully.');
    }

    /**
     * Reorder sections
     */
    public function reorder(Request $request, TestSection $testSection)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|min:1',
        ]);

        foreach ($request->order as $index => $sectionId) {
            TestSection::where('id', $sectionId)
                ->where('test_id', $testSection->test_id)
                ->update(['order' => $index + 1]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Sections reordered successfully.'
        ]);
    }
}
