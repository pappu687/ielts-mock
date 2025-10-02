<x-backend-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between p-3">
                        <div class="card-title">
                            Question Details
                            <small class="text-muted d-block">{{ $testSection->test->name }} - {{ $testSection->name }}</small>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.test-sections.questions.edit', [$testSection, $question]) }}" class="btn btn-warning btn-sm">
                                <i class="ri-edit-line me-1"></i>Edit
                            </a>
                            <a href="{{ route('admin.tests.show', $testSection->test) }}" class="btn btn-outline-secondary btn-sm">
                                <i class="ri-arrow-left-line me-1"></i>Back to Test
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Question Content -->
                                <div class="mb-4">
                                    <h6 class="text-primary mb-3">Question</h6>
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="mb-0">{!! nl2br(e($question->question_text)) !!}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Options (if MCQ) -->
                                @if($question->isMcq() && $question->options)
                                    <div class="mb-4">
                                        <h6 class="text-primary mb-3">Options</h6>
                                        <div class="list-group">
                                            @foreach($question->options as $key => $option)
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong>{{ chr(65 + $key) }}.</strong> {{ $option }}
                                                    </div>
                                                    @if(isset($question->correct_answers['mcq']) && $question->correct_answers['mcq'] == ($key + 1))
                                                        <span class="badge bg-success">Correct</span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Correct Answer -->
                                @if($question->correct_answers)
                                    <div class="mb-4">
                                        <h6 class="text-primary mb-3">Correct Answer</h6>
                                        <div class="card bg-success bg-opacity-10">
                                            <div class="card-body">
                                                @if($question->isMcq())
                                                    <p class="mb-0"><strong>Option {{ chr(64 + ($question->correct_answers['mcq'] ?? 1)) }}</strong></p>
                                                @elseif($question->isTrueFalse())
                                                    <p class="mb-0"><strong>{{ ucfirst(str_replace('_', ' ', $question->correct_answers['true_false'] ?? 'Not specified')) }}</strong></p>
                                                @elseif($question->isFillBlank())
                                                    <p class="mb-0"><strong>{{ $question->correct_answers['fill_blank'] ?? 'Not specified' }}</strong></p>
                                                @else
                                                    <p class="mb-0">{{ json_encode($question->correct_answers) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Explanation -->
                                @if($question->explanation)
                                    <div class="mb-4">
                                        <h6 class="text-primary mb-3">Explanation</h6>
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="mb-0">{!! nl2br(e($question->explanation)) !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Hint -->
                                @if($question->hint)
                                    <div class="mb-4">
                                        <h6 class="text-primary mb-3">Hint</h6>
                                        <div class="card bg-warning bg-opacity-10">
                                            <div class="card-body">
                                                <p class="mb-0">{!! nl2br(e($question->hint)) !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <!-- Question Metadata -->
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Question Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <small class="text-muted">Question Type:</small><br>
                                            <strong>{{ ucfirst(str_replace('_', ' ', $question->question_type_new ?? $question->question_type ?? 'Not specified')) }}</strong>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted">Points:</small><br>
                                            <strong>{{ $question->points ?? 1 }}</strong>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted">Difficulty:</small><br>
                                            <span class="badge bg-{{ $question->difficulty_level === 'easy' ? 'success' : ($question->difficulty_level === 'medium' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($question->difficulty_level ?? 'Medium') }}
                                            </span>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted">Estimated Time:</small><br>
                                            <strong>{{ $question->estimated_time ?? 60 }} seconds</strong>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted">Order:</small><br>
                                            <strong>{{ $question->order ?? 1 }}</strong>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted">Created:</small><br>
                                            <strong>{{ $question->created_at->format('M d, Y H:i') }}</strong>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted">Last Updated:</small><br>
                                            <strong>{{ $question->updated_at->format('M d, Y H:i') }}</strong>
                                        </div>
                                    </div>
                                </div>

                                <!-- Audio Segments (for listening) -->
                                @if($question->audio_segments && count($question->audio_segments) > 0)
                                    <div class="card bg-info bg-opacity-10 mt-3">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0 text-info">
                                                <i class="ri-music-2-line me-1"></i>Audio Segments
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            @foreach($question->audio_segments as $segment)
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span>{{ $segment['start'] ?? '00:00' }} - {{ $segment['end'] ?? '00:00' }}</span>
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="ri-play-line"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Actions -->
                                <div class="d-grid gap-2 mt-3">
                                    <a href="{{ route('admin.test-sections.questions.edit', [$testSection, $question]) }}" class="btn btn-warning">
                                        <i class="ri-edit-line me-1"></i>Edit Question
                                    </a>
                                    <button type="button" class="btn btn-danger" onclick="deleteQuestion({{ $question->id }})">
                                        <i class="ri-delete-bin-line me-1"></i>Delete Question
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function deleteQuestion(questionId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete this question? This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Processing...',
                            text: 'Please wait while we delete the question.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Make Ajax request
                        $.ajax({
                            url: '{{ route('admin.test-sections.questions.destroy', [$testSection, $question]) }}',
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    // Redirect back to test
                                    window.location.href = '{{ route('admin.tests.show', $testSection->test) }}';
                                });
                            },
                            error: function(xhr) {
                                let message = 'Failed to delete question. Please try again.';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    message = xhr.responseJSON.message;
                                }
                                Swal.fire(
                                    'Error!',
                                    message,
                                    'error'
                                );
                            }
                        });
                    }
                });
            }
        </script>
    @endpush
</x-backend-layout>
