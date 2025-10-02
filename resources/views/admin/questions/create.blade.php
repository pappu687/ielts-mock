<x-backend-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between p-3">
                        <div class="card-title">
                            Create New Question
                            <small class="text-muted d-block">{{ $testSection->test->name }} - {{ $testSection->name }}</small>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.tests.show', $testSection->test) }}" class="btn btn-outline-secondary">
                                <i class="ri-arrow-left-line align-middle me-1"></i>Back to Test
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.test-sections.questions.store', $testSection) }}" method="POST" id="create-question-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <!-- Question Type -->
                                    <div class="mb-3">
                                        <label for="question_type_new" class="form-label">Question Type <span class="text-danger">*</span></label>
                                        <select class="form-select @error('question_type_new') is-invalid @enderror" 
                                                id="question_type_new" name="question_type_new" required>
                                            <option value="">Select Question Type</option>
                                            @foreach($questionTypes as $type => $label)
                                                <option value="{{ $type }}" {{ old('question_type_new') == $type ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('question_type_new')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Question Text -->
                                    <div class="mb-3">
                                        <label for="question_text" class="form-label">Question Text <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('question_text') is-invalid @enderror" 
                                                  id="question_text" name="question_text" rows="4" required>{{ old('question_text') }}</textarea>
                                        @error('question_text')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Dynamic Options Section -->
                                    <div id="options-section" class="mb-3" style="display: none;">
                                        <label class="form-label">Answer Options</label>
                                        <div id="options-container">
                                            <!-- Options will be dynamically added here -->
                                        </div>
                                        <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-option">
                                            <i class="ri-add-line me-1"></i>Add Option
                                        </button>
                                    </div>

                                    <!-- Correct Answers Section -->
                                    <div id="correct-answers-section" class="mb-3" style="display: none;">
                                        <label class="form-label">Correct Answer(s)</label>
                                        <div id="correct-answers-container">
                                            <!-- Correct answers will be dynamically added here -->
                                        </div>
                                    </div>

                                    <!-- Fill in the Blank Answer -->
                                    <div id="fill-blank-section" class="mb-3" style="display: none;">
                                        <label for="fill_blank_answer" class="form-label">Correct Answer</label>
                                        <input type="text" class="form-control" id="fill_blank_answer" name="correct_answers[fill_blank]">
                                        <div class="form-text">Enter the correct answer for the blank</div>
                                    </div>

                                    <!-- True/False Options -->
                                    <div id="true-false-section" class="mb-3" style="display: none;">
                                        <label class="form-label">Correct Answer</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="correct_answers[true_false]" value="true" id="true_answer">
                                            <label class="form-check-label" for="true_answer">True</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="correct_answers[true_false]" value="false" id="false_answer">
                                            <label class="form-check-label" for="false_answer">False</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="correct_answers[true_false]" value="not_given" id="not_given_answer">
                                            <label class="form-check-label" for="not_given_answer">Not Given</label>
                                        </div>
                                    </div>

                                    <!-- Explanation -->
                                    <div class="mb-3">
                                        <label for="explanation" class="form-label">Explanation</label>
                                        <textarea class="form-control @error('explanation') is-invalid @enderror" 
                                                  id="explanation" name="explanation" rows="3">{{ old('explanation') }}</textarea>
                                        @error('explanation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Provide an explanation for the correct answer</div>
                                    </div>

                                    <!-- Hint -->
                                    <div class="mb-3">
                                        <label for="hint" class="form-label">Hint</label>
                                        <textarea class="form-control @error('hint') is-invalid @enderror" 
                                                  id="hint" name="hint" rows="2">{{ old('hint') }}</textarea>
                                        @error('hint')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Provide a helpful hint for students</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <!-- Question Settings -->
                                    <div class="card bg-light">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">Question Settings</h6>
                                        </div>
                                        <div class="card-body">
                                            <!-- Points -->
                                            <div class="mb-3">
                                                <label for="points" class="form-label">Points</label>
                                                <input type="number" class="form-control @error('points') is-invalid @enderror" 
                                                       id="points" name="points" value="{{ old('points', 1) }}" min="1" max="10">
                                                @error('points')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Difficulty Level -->
                                            <div class="mb-3">
                                                <label for="difficulty_level" class="form-label">Difficulty Level</label>
                                                <select class="form-select @error('difficulty_level') is-invalid @enderror" 
                                                        id="difficulty_level" name="difficulty_level">
                                                    <option value="easy" {{ old('difficulty_level', 'medium') == 'easy' ? 'selected' : '' }}>Easy</option>
                                                    <option value="medium" {{ old('difficulty_level', 'medium') == 'medium' ? 'selected' : '' }}>Medium</option>
                                                    <option value="hard" {{ old('difficulty_level', 'medium') == 'hard' ? 'selected' : '' }}>Hard</option>
                                                </select>
                                                @error('difficulty_level')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Estimated Time -->
                                            <div class="mb-3">
                                                <label for="estimated_time" class="form-label">Estimated Time (seconds)</label>
                                                <input type="number" class="form-control @error('estimated_time') is-invalid @enderror" 
                                                       id="estimated_time" name="estimated_time" value="{{ old('estimated_time', 60) }}" min="10" max="300">
                                                @error('estimated_time')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Audio Segments (for listening questions) -->
                                            @if($testSection->test->type === 'listening')
                                                <div class="mb-3">
                                                    <label for="audio_start_time" class="form-label">Audio Start Time</label>
                                                    <input type="text" class="form-control" id="audio_start_time" placeholder="00:00">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="audio_end_time" class="form-label">Audio End Time</label>
                                                    <input type="text" class="form-control" id="audio_end_time" placeholder="00:30">
                                                </div>
                                                <button type="button" class="btn btn-outline-primary btn-sm" id="add-audio-segment">
                                                    <i class="ri-add-line me-1"></i>Add Audio Segment
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Test Section Info -->
                                    <div class="card bg-info bg-opacity-10 mt-3">
                                        <div class="card-body">
                                            <h6 class="card-title text-info">
                                                <i class="ri-information-line me-1"></i>Section Information
                                            </h6>
                                            <p class="card-text small">
                                                <strong>Test:</strong> {{ $testSection->test->name }}<br>
                                                <strong>Section:</strong> {{ $testSection->name }}<br>
                                                <strong>Type:</strong> {{ ucfirst($testSection->test->type) }}<br>
                                                <strong>Questions:</strong> {{ $testSection->questions->count() }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.tests.show', $testSection->test) }}" class="btn btn-outline-secondary">Cancel</a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ri-save-line align-middle me-1"></i>Create Question
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                let optionCount = 0;
                let audioSegmentCount = 0;

                // Handle question type change
                $('#question_type_new').change(function() {
                    const questionType = $(this).val();
                    
                    // Hide all dynamic sections
                    $('#options-section, #correct-answers-section, #fill-blank-section, #true-false-section').hide();
                    
                    // Show relevant sections based on question type
                    switch(questionType) {
                        case 'mcq':
                        case 'multiple_choice':
                            $('#options-section, #correct-answers-section').show();
                            break;
                        case 'fill_blank':
                        case 'sentence_completion':
                            $('#fill-blank-section').show();
                            break;
                        case 'true_false':
                            $('#true-false-section').show();
                            break;
                    }
                });

                // Add option functionality
                $('#add-option').click(function() {
                    optionCount++;
                    const optionHtml = `
                        <div class="input-group mb-2" data-option="${optionCount}">
                            <span class="input-group-text">Option ${String.fromCharCode(64 + optionCount)}</span>
                            <input type="text" class="form-control" name="options[${optionCount}]" placeholder="Enter option text">
                            <button type="button" class="btn btn-outline-danger" onclick="removeOption(${optionCount})">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                    `;
                    $('#options-container').append(optionHtml);
                    
                    // Add to correct answers
                    addCorrectAnswerOption(optionCount);
                });

                // Remove option functionality
                window.removeOption = function(optionNum) {
                    $(`[data-option="${optionNum}"]`).remove();
                    $(`[data-correct-option="${optionNum}"]`).remove();
                };

                // Add correct answer option
                function addCorrectAnswerOption(optionNum) {
                    const correctAnswerHtml = `
                        <div class="form-check" data-correct-option="${optionNum}">
                            <input class="form-check-input" type="radio" name="correct_answers[mcq]" value="${optionNum}" id="correct_option_${optionNum}">
                            <label class="form-check-label" for="correct_option_${optionNum}">
                                Option ${String.fromCharCode(64 + optionNum)} is correct
                            </label>
                        </div>
                    `;
                    $('#correct-answers-container').append(correctAnswerHtml);
                }

                // Add audio segment functionality
                $('#add-audio-segment').click(function() {
                    audioSegmentCount++;
                    const startTime = $('#audio_start_time').val();
                    const endTime = $('#audio_end_time').val();
                    
                    if (startTime && endTime) {
                        // Add hidden input for audio segments
                        const audioSegmentHtml = `
                            <input type="hidden" name="audio_segments[${audioSegmentCount}][start]" value="${startTime}">
                            <input type="hidden" name="audio_segments[${audioSegmentCount}][end]" value="${endTime}">
                        `;
                        $('#create-question-form').append(audioSegmentHtml);
                        
                        // Show added segment
                        Swal.fire({
                            title: 'Audio Segment Added',
                            text: `Segment ${audioSegmentCount}: ${startTime} - ${endTime}`,
                            icon: 'success',
                            timer: 2000
                        });
                        
                        // Clear inputs
                        $('#audio_start_time, #audio_end_time').val('');
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Please enter both start and end times',
                            icon: 'error'
                        });
                    }
                });

                // Trigger change event if there's an old value
                @if(old('question_type_new'))
                    $('#question_type_new').trigger('change');
                @endif
            });
        </script>
    @endpush
</x-backend-layout>
