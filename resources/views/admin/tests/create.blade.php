<x-backend-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between p-3">
                        <div class="card-title">Create New Test</div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.tests.index') }}" class="btn btn-outline-secondary">
                                <i class="ri-arrow-left-line align-middle me-1"></i>Back to Tests
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.tests.store') }}" method="POST" id="create-test-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Test Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="type" class="form-label">Test Type <span class="text-danger">*</span></label>
                                        <select class="form-select @error('type') is-invalid @enderror" 
                                                id="type" name="type" required>
                                            <option value="">Select Test Type</option>
                                            <option value="listening" {{ old('type') == 'listening' ? 'selected' : '' }}>Listening</option>
                                            <option value="reading" {{ old('type') == 'reading' ? 'selected' : '' }}>Reading</option>
                                            <option value="writing" {{ old('type') == 'writing' ? 'selected' : '' }}>Writing</option>
                                            <option value="speaking" {{ old('type') == 'speaking' ? 'selected' : '' }}>Speaking</option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="duration_minutes" class="form-label">Duration (minutes)</label>
                                        <input type="number" class="form-control @error('duration_minutes') is-invalid @enderror" 
                                               id="duration_minutes" name="duration_minutes" 
                                               value="{{ old('duration_minutes') }}" min="1" max="300">
                                        @error('duration_minutes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Leave empty to use default duration based on test type</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">Test Type Information</h6>
                                        </div>
                                        <div class="card-body">
                                            <div id="type-info">
                                                <p class="text-muted">Select a test type to see information about default sections.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.tests.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ri-save-line align-middle me-1"></i>Create Test
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
                const typeInfo = {
                    'listening': {
                        title: 'Listening Test',
                        description: '4 parts with audio files',
                        sections: [
                            'Part 1: Conversation between two people',
                            'Part 2: Monologue in a social context',
                            'Part 3: Conversation between multiple people',
                            'Part 4: Academic lecture or talk'
                        ],
                        duration: '40 minutes'
                    },
                    'reading': {
                        title: 'Reading Test',
                        description: '3 passages with comprehension questions',
                        sections: [
                            'Passage 1: General interest text',
                            'Passage 2: Workplace or training context',
                            'Passage 3: Academic text'
                        ],
                        duration: '60 minutes'
                    },
                    'writing': {
                        title: 'Writing Test',
                        description: '2 tasks with different requirements',
                        sections: [
                            'Task 1: Describe visual information (20 min)',
                            'Task 2: Essay writing (40 min)'
                        ],
                        duration: '60 minutes'
                    },
                    'speaking': {
                        title: 'Speaking Test',
                        description: '3 parts with different interaction styles',
                        sections: [
                            'Part 1: Introduction and interview (5 min)',
                            'Part 2: Individual long turn (4 min)',
                            'Part 3: Two-way discussion (5 min)'
                        ],
                        duration: '14 minutes'
                    }
                };

                $('#type').change(function() {
                    const selectedType = $(this).val();
                    const info = typeInfo[selectedType];
                    
                    if (info) {
                        let html = `
                            <h6 class="text-primary">${info.title}</h6>
                            <p class="text-muted mb-3">${info.description}</p>
                            <p><strong>Duration:</strong> ${info.duration}</p>
                            <p><strong>Default Sections:</strong></p>
                            <ul class="list-unstyled">
                        `;
                        
                        info.sections.forEach(section => {
                            html += `<li class="mb-1"><i class="ri-check-line text-success me-1"></i>${section}</li>`;
                        });
                        
                        html += '</ul>';
                        $('#type-info').html(html);
                    } else {
                        $('#type-info').html('<p class="text-muted">Select a test type to see information about default sections.</p>');
                    }
                });

                // Trigger change event if there's an old value
                @if(old('type'))
                    $('#type').trigger('change');
                @endif
            });
        </script>
    @endpush
</x-backend-layout>
