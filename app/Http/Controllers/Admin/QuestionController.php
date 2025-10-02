<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;
use App\Models\TestSection;
use App\Helpers\DataTableHelper;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuestionController extends Controller
{
    /**
     * Display questions for a specific test section
     */
    public function index(TestSection $testSection)
    {
        $testSection->load(['test', 'questions']);
        return view('admin.questions.index', compact('testSection'));
    }

    /**
     * Show the form for creating a new question in a test section
     */
    public function create(TestSection $testSection)
    {
        $testSection->load('test');
        
        // Get question types based on test type
        $questionTypes = $this->getQuestionTypesForTestType($testSection->test->type);
        
        return view('admin.questions.create', compact('testSection', 'questionTypes'));
    }

    /**
     * Store a newly created question in storage
     */
    public function store(StoreQuestionRequest $request, TestSection $testSection)
    {
        // Get the next order number
        $nextOrder = $testSection->questions()->max('order') + 1;
        
        // Process options to remove empty values
        $options = [];
        if ($request->options) {
            foreach ($request->options as $key => $option) {
                if (!empty(trim($option))) {
                    $options[] = trim($option);
                }
            }
        }
        
        // Process correct answers
        $correctAnswers = [];
        if ($request->correct_answers) {
            foreach ($request->correct_answers as $key => $value) {
                if ($value !== null && $value !== '') {
                    $correctAnswers[$key] = $value;
                }
            }
        }
        
        $question = Question::create([
            'question_bank_id' => null, // Questions for test sections don't need question bank
            'test_section_id' => $testSection->id,
            'question_type_new' => $request->question_type_new,
            'question_text' => $request->question_text,
            'content' => $request->content ?? [],
            'options' => $options,
            'correct_answers' => $correctAnswers,
            'explanation' => $request->explanation,
            'hint' => $request->hint,
            'points' => $request->points ?? 1,
            'order' => $nextOrder,
            'difficulty_level' => $request->difficulty_level ?? 'medium',
            'estimated_time' => $request->estimated_time ?? 60,
            'audio_segments' => $request->audio_segments ?? [],
        ]);

        return redirect()
            ->route('admin.test-sections.questions.show', [$testSection, $question])
            ->with('success', 'Question created successfully.');
    }

    /**
     * Display the specified question
     */
    public function show(TestSection $testSection, Question $question)
    {
        $testSection->load('test');
        return view('admin.questions.show', compact('testSection', 'question'));
    }

    /**
     * Show the form for editing the specified question
     */
    public function edit(TestSection $testSection, Question $question)
    {
        $testSection->load('test');
        $questionTypes = $this->getQuestionTypesForTestType($testSection->test->type);
        
        return view('admin.questions.edit', compact('testSection', 'question', 'questionTypes'));
    }

    /**
     * Update the specified question in storage
     */
    public function update(UpdateQuestionRequest $request, TestSection $testSection, Question $question)
    {
        // Process options to remove empty values
        $options = [];
        if ($request->options) {
            foreach ($request->options as $key => $option) {
                if (!empty(trim($option))) {
                    $options[] = trim($option);
                }
            }
        }
        
        // Process correct answers
        $correctAnswers = [];
        if ($request->correct_answers) {
            foreach ($request->correct_answers as $key => $value) {
                if ($value !== null && $value !== '') {
                    $correctAnswers[$key] = $value;
                }
            }
        }
        
        // Process audio segments
        $audioSegments = $question->audio_segments ?? [];
        
        // Add new audio segments
        if ($request->audio_segments) {
            foreach ($request->audio_segments as $segment) {
                if (!empty($segment['start']) && !empty($segment['end'])) {
                    $audioSegments[] = [
                        'start' => $segment['start'],
                        'end' => $segment['end']
                    ];
                }
            }
        }
        
        // Remove audio segments marked for removal
        if ($request->remove_audio_segments) {
            foreach ($request->remove_audio_segments as $index => $remove) {
                if ($remove) {
                    unset($audioSegments[$index]);
                }
            }
            $audioSegments = array_values($audioSegments); // Re-index array
        }

        $question->update([
            'question_type_new' => $request->question_type_new,
            'question_text' => $request->question_text,
            'content' => $request->content ?? [],
            'options' => $options,
            'correct_answers' => $correctAnswers,
            'explanation' => $request->explanation,
            'hint' => $request->hint,
            'points' => $request->points ?? 1,
            'difficulty_level' => $request->difficulty_level ?? 'medium',
            'estimated_time' => $request->estimated_time ?? 60,
            'audio_segments' => $audioSegments,
        ]);

        return redirect()
            ->route('admin.test-sections.questions.show', [$testSection, $question])
            ->with('success', 'Question updated successfully.');
    }

    /**
     * Remove the specified question from storage
     */
    public function destroy(TestSection $testSection, Question $question)
    {
        $question->delete();

        return response()->json([
            'success' => true,
            'message' => 'Question deleted successfully.'
        ]);
    }

    /**
     * Reorder questions within a section
     */
    public function reorder(Request $request, TestSection $testSection)
    {
        $request->validate([
            'questions' => 'required|array',
            'questions.*.id' => 'required|exists:questions,id',
            'questions.*.order' => 'required|integer|min:1',
        ]);

        foreach ($request->questions as $questionData) {
            Question::where('id', $questionData['id'])
                ->where('test_section_id', $testSection->id)
                ->update(['order' => $questionData['order']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Questions reordered successfully.'
        ]);
    }

    /**
     * Get question types based on test type
     */
    private function getQuestionTypesForTestType(string $testType): array
    {
        $questionTypes = [
            'listening' => [
                'mcq' => 'Multiple Choice',
                'fill_blank' => 'Fill in the Blank',
                'note_completion' => 'Note Completion',
                'table_completion' => 'Table Completion',
                'flow_chart' => 'Flow Chart Completion',
                'diagram_labeling' => 'Diagram Labeling',
                'map_labeling' => 'Map Labeling',
                'sentence_completion' => 'Sentence Completion',
            ],
            'reading' => [
                'mcq' => 'Multiple Choice',
                'true_false' => 'True/False/Not Given',
                'fill_blank' => 'Fill in the Blank',
                'matching' => 'Matching',
                'summary_completion' => 'Summary Completion',
                'sentence_completion' => 'Sentence Completion',
            ],
            'writing' => [
                'essay' => 'Essay Writing',
            ],
            'speaking' => [
                'speaking_topic' => 'Speaking Topic',
            ],
        ];

        return $questionTypes[$testType] ?? [];
    }

    /**
     * Get questions data for DataTable
     */
    public function listQuestions(Request $request)
    {
        if ($request->ajax()) {
            $questions = Question::select(['id', 'question_text', 'question_type', 'created_at']);
            
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
                    $actions = '<div class="btn-group btn-group-sm">';

                    // Primary action button (View)
                    $actions .= '<a href="#" class="btn btn-primary">View</a>';

                    // Dropdown toggle button
                    $actions .= '<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split me-2" data-bs-toggle="dropdown" aria-expanded="false">';
                    $actions .= '<span class="visually-hidden">Toggle Dropdown</span>';
                    $actions .= '</button>';

                    // Dropdown menu
                    $actions .= '<ul class="dropdown-menu dropdown-menu-end">';
                    $actions .= '<li><a class="dropdown-item" href="#">Edit</a></li>';
                    $actions .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="approveQuestion(' . $question->id . ')">Approve</a></li>';
                    $actions .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="updateMetadata(' . $question->id . ')">Update Metadata</a></li>';
                    $actions .= '<li><hr class="dropdown-divider"></li>';
                    $actions .= '<li><a class="dropdown-item text-danger" href="javascript:void(0);" onclick="deleteQuestion(' . $question->id . ')">Delete</a></li>';
                    $actions .= '</ul>';
                    $actions .= '</div>';

                    return $actions;
                })
                ->rawColumns(['is_approved', 'actions', 'question_text', 'created_at'])
                ->make(true);
        }
    }
}
