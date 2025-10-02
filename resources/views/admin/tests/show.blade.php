<x-backend-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Test Header -->
                <div class="card custom-card mb-4">
                    <div class="card-header justify-content-between p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <h4 class="card-title mb-1">{{ $test->name }}</h4>
                                <div class="d-flex gap-3 text-muted">
                                    <span><i class="ri-book-open-line me-1"></i>{{ ucfirst($test->type) }} Test</span>
                                    <span><i class="ri-time-line me-1"></i>{{ $test->duration_minutes ?? 'N/A' }} minutes</span>
                                    <span><i class="ri-list-check me-1"></i>{{ $test->sections->count() }} sections</span>
                                    <span><i class="ri-question-line me-1"></i>{{ $test->total_questions }} questions</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <span class="badge {{ $test->is_active ? 'bg-success' : 'bg-secondary' }} fs-6">
                                {{ $test->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            <a href="{{ route('admin.tests.edit', $test) }}" class="btn btn-warning btn-sm">
                                <i class="ri-edit-line me-1"></i>Edit
                            </a>
                            <a href="{{ route('admin.tests.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="ri-arrow-left-line me-1"></i>Back
                            </a>
                        </div>
                    </div>
                    @if($test->description)
                        <div class="card-body pt-0">
                            <p class="text-muted mb-0">{{ $test->description }}</p>
                        </div>
                    @endif
                </div>

                <!-- Test Sections -->
                <div class="card custom-card">
                    <div class="card-header justify-content-between p-3">
                        <div class="card-title">Test Sections</div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                                <i class="ri-add-line me-1"></i>Add Section
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($test->sections->count() > 0)
                            <div class="accordion" id="sectionsAccordion">
                                @foreach($test->sections as $section)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="section{{ $section->id }}">
                                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" 
                                                    type="button" data-bs-toggle="collapse" 
                                                    data-bs-target="#collapse{{ $section->id }}" 
                                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}" 
                                                    aria-controls="collapse{{ $section->id }}">
                                                <div class="d-flex justify-content-between align-items-center w-100 me-3">
                                                    <div>
                                                        <strong>{{ $section->name }}</strong>
                                                        @if($section->description)
                                                            <span class="text-muted ms-2">- {{ $section->description }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                        <span class="badge bg-info">{{ $section->questions->count() }} questions</span>
                                                        @if($section->time_limit_minutes)
                                                            <span class="badge bg-secondary">{{ $section->time_limit_minutes }} min</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $section->id }}" 
                                             class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" 
                                             aria-labelledby="section{{ $section->id }}" 
                                             data-bs-parent="#sectionsAccordion">
                                            <div class="accordion-body">
                                                <!-- Section Resources -->
                                                @if($section->resources->count() > 0)
                                                    <div class="mb-4">
                                                        <h6 class="text-primary mb-3">
                                                            <i class="ri-file-line me-1"></i>Resources
                                                        </h6>
                                                        <div class="row">
                                                            @foreach($section->resources as $resource)
                                                                <div class="col-md-6 mb-3">
                                                                    <div class="card border">
                                                                        <div class="card-body p-3">
                                                                            <div class="d-flex justify-content-between align-items-start">
                                                                                <div>
                                                                                    <h6 class="card-title mb-1">
                                                                                        <i class="ri-file-{{ $resource->type === 'audio' ? 'music' : ($resource->type === 'image' ? 'image' : 'text') }}-line me-1"></i>
                                                                                        {{ $resource->title ?? ucfirst($resource->type) }}
                                                                                    </h6>
                                                                                    <small class="text-muted">
                                                                                        {{ ucfirst($resource->type) }}
                                                                                        @if($resource->file_size)
                                                                                            - {{ $resource->file_size_human }}
                                                                                        @endif
                                                                                    </small>
                                                                                </div>
                                                                                <div class="dropdown">
                                                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                                                                            type="button" data-bs-toggle="dropdown">
                                                                                        <i class="ri-more-2-line"></i>
                                                                                    </button>
                                                                                    <ul class="dropdown-menu">
                                                                                        <li><a class="dropdown-item" href="#"><i class="ri-eye-line me-1"></i>View</a></li>
                                                                                        <li><a class="dropdown-item" href="#"><i class="ri-edit-line me-1"></i>Edit</a></li>
                                                                                        <li><hr class="dropdown-divider"></li>
                                                                                        <li><a class="dropdown-item text-danger" href="#"><i class="ri-delete-bin-line me-1"></i>Delete</a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- Section Questions -->
                                                <div class="mb-4">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <h6 class="text-primary mb-0">
                                                            <i class="ri-question-line me-1"></i>Questions ({{ $section->questions->count() }})
                                                        </h6>
                                                        <button class="btn btn-primary btn-sm" onclick="addQuestion({{ $section->id }})">
                                                            <i class="ri-add-line me-1"></i>Add Question
                                                        </button>
                                                    </div>

                                                    @if($section->questions->count() > 0)
                                                        <div class="table-responsive">
                                                            <table class="table table-sm table-hover">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th width="50">#</th>
                                                                        <th>Question</th>
                                                                        <th width="120">Type</th>
                                                                        <th width="80">Points</th>
                                                                        <th width="100">Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($section->questions->sortBy('order') as $question)
                                                                        <tr>
                                                                            <td class="text-center">{{ $question->order }}</td>
                                                                            <td>
                                                                                <div class="text-truncate" style="max-width: 300px;">
                                                                                    {{ Str::limit(strip_tags($question->question_text), 80) }}
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <span class="badge bg-info">
                                                                                    {{ ucfirst(str_replace('_', ' ', $question->question_type_new ?? $question->question_type)) }}
                                                                                </span>
                                                                            </td>
                                                                            <td class="text-center">{{ $question->points ?? 1 }}</td>
                                                                            <td>
                                                                                <div class="btn-group btn-group-sm">
                                                                                    <a href="{{ route('admin.test-sections.questions.show', [$section, $question]) }}" 
                                                                                       class="btn btn-outline-info btn-sm" title="View">
                                                                                        <i class="ri-eye-line"></i>
                                                                                    </a>
                                                                                    <a href="{{ route('admin.test-sections.questions.edit', [$section, $question]) }}" 
                                                                                       class="btn btn-outline-warning btn-sm" title="Edit">
                                                                                        <i class="ri-edit-line"></i>
                                                                                    </a>
                                                                                    <button class="btn btn-outline-danger btn-sm" title="Delete" 
                                                                                            onclick="deleteQuestion({{ $question->id }}, '{{ Str::limit(strip_tags($question->question_text), 30) }}', {{ $section->id }})">
                                                                                        <i class="ri-delete-bin-line"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    @else
                                                        <div class="text-center py-4">
                                                            <i class="ri-question-line text-muted" style="font-size: 3rem;"></i>
                                                            <p class="text-muted mt-2">No questions added yet</p>
                                                            <button class="btn btn-primary" onclick="addQuestion({{ $section->id }})">
                                                                <i class="ri-add-line me-1"></i>Add First Question
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Section Actions -->
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('admin.test-sections.edit', $section) }}" class="btn btn-outline-primary btn-sm">
                                                        <i class="ri-edit-line me-1"></i>Edit Section
                                                    </a>
                                                    <button class="btn btn-outline-info btn-sm" onclick="addResource({{ $section->id }})">
                                                        <i class="ri-upload-line me-1"></i>Add Resource
                                                    </button>
                                                    <button class="btn btn-outline-danger btn-sm" onclick="deleteSection({{ $section->id }}, '{{ $section->name }}')">
                                                        <i class="ri-delete-bin-line me-1"></i>Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="ri-folder-open-line text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-2">No sections created yet</p>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                                    <i class="ri-add-line me-1"></i>Create First Section
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Section Modal -->
    <div class="modal fade" id="addSectionModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="addSectionForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="section_name" class="form-label">Section Name</label>
                            <input type="text" class="form-control" id="section_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="section_description" class="form-label">Description</label>
                            <textarea class="form-control" id="section_description" name="description" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="section_order" class="form-label">Order</label>
                            <input type="number" class="form-control" id="section_order" name="order" 
                                   value="{{ $test->sections->count() + 1 }}" min="1">
                        </div>
                        <div class="mb-3">
                            <label for="section_time_limit" class="form-label">Time Limit (minutes)</label>
                            <input type="number" class="form-control" id="section_time_limit" name="time_limit_minutes" min="1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Section</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function addQuestion(sectionId) {
                // Redirect to question creation page
                window.location.href = `/admin/test-sections/${sectionId}/questions/create`;
            }

            function addResource(sectionId) {
                // Placeholder for add resource functionality
                Swal.fire({
                    title: 'Add Resource',
                    text: 'This feature will be implemented soon.',
                    icon: 'info'
                });
            }

            function deleteSection(sectionId, sectionName) {
                Swal.fire({
                    title: 'Delete Section?',
                    text: `Are you sure you want to delete "${sectionName}"? This action cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create a form to submit the delete request
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `/admin/test-sections/${sectionId}`;
                        
                        // Add CSRF token
                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';
                        form.appendChild(csrfToken);
                        
                        // Add method override
                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';
                        form.appendChild(methodField);
                        
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }

            function deleteQuestion(questionId, questionText, sectionId) {
                Swal.fire({
                    title: 'Delete Question?',
                    text: `Are you sure you want to delete this question: "${questionText}"? This action cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create a form to submit the delete request
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `/admin/test-sections/${sectionId}/questions/${questionId}`;
                        
                        // Add CSRF token
                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';
                        form.appendChild(csrfToken);
                        
                        // Add method override
                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';
                        form.appendChild(methodField);
                        
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }

            $('#addSectionForm').on('submit', function(e) {
                e.preventDefault();
                
                // Here you would make an AJAX request to create the section
                // For now, just show a success message
                Swal.fire({
                    title: 'Success!',
                    text: 'Section will be added. This feature needs to be implemented.',
                    icon: 'info'
                });
                
                $('#addSectionModal').modal('hide');
            });
        </script>
    @endpush
</x-backend-layout>
