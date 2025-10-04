<x-backend-layout>
    <div class="container-fluid">

        <div class="row row-cols-xxl-4">
            <div class="col col-lg-6">
                <div class="card custom-card bg-primary-transparent border-0 shadow-none">
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-3 flex-wrap">
                            <div class="lh-1">
                                <span class="avatar avatar-lg avatar-rounded bg-primary svg-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                        width="24px" fill="#5f6368">
                                        <path d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z" />
                                    </svg>
                                </span>
                            </div>
                            <div>
                                <span class="d-block mb-1">
                                    Test Type
                                </span>
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="fw-semibold mb-0">{{ ucfirst($test->type) }} Test</h5>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-lg-6">
                <div class="card custom-card bg-success-transparent border-0 shadow-none">
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-3 flex-wrap">
                            <div class="lh-1">
                                <span class="avatar avatar-lg avatar-rounded bg-success svg-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                        width="24px" fill="#5f6368">
                                        <path d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                                    </svg>
                                </span>
                            </div>
                            <div>
                                <span class="d-block mb-1">
                                    Duration
                                </span>
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="fw-semibold mb-0">{{ $test->duration_minutes ?? 'N/A' }} minutes</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-lg-6">
                <div class="card custom-card bg-info-transparent border-0 shadow-none">
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-3 flex-wrap">
                            <div class="lh-1">
                                <span class="avatar avatar-lg avatar-rounded bg-info svg-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                        height="24px" viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                        <g>
                                            <rect fill="none" height="24" width="24" />
                                        </g>
                                        <g>
                                            <path
                                                d="M20,7h-5V4c0-1.1-0.9-2-2-2h-2C9.9,2,9,2.9,9,4v3H4C2.9,7,2,7.9,2,9v11c0,1.1,0.9,2,2,2h16c1.1,0,2-0.9,2-2V9 C22,7.9,21.1,7,20,7z M9,12c0.83,0,1.5,0.67,1.5,1.5S9.83,15,9,15s-1.5-0.67-1.5-1.5S8.17,12,9,12z M12,18H6v-0.75c0-1,2-1.5,3-1.5 s3,0.5,3,1.5V18z M13,9h-2V4h2V9z M18,16.5h-4V15h4V16.5z M18,13.5h-4V12h4V13.5z" />
                                        </g>
                                    </svg>
                                </span>
                            </div>
                            <div>
                                <span class="d-block mb-1">
                                    Sections
                                </span>
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="fw-semibold mb-0">{{ $test->sections->count() }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-lg-6">
                <div class="card custom-card bg-danger-transparent border-0 shadow-none">
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-3 flex-wrap">
                            <div class="lh-1">
                                <span class="avatar avatar-lg avatar-rounded bg-danger svg-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                        height="24px" viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                        <g>
                                            <rect fill="none" height="24" width="24" />
                                        </g>
                                        <g>
                                            <path
                                                d="M12,2C6.48,2,2,6.48,2,12s4.48,10,10,10s10-4.48,10-10S17.52,2,12,2z M12.88,17.76V19h-1.75v-1.29 c-0.74-0.18-2.39-0.77-3.02-2.96l1.65-0.67c0.06,0.22,0.58,2.09,2.4,2.09c0.93,0,1.98-0.48,1.98-1.61c0-0.96-0.7-1.46-2.28-2.03 c-1.1-0.39-3.35-1.03-3.35-3.31c0-0.1,0.01-2.4,2.62-2.96V5h1.75v1.24c1.84,0.32,2.51,1.79,2.66,2.23l-1.58,0.67 c-0.11-0.35-0.59-1.34-1.9-1.34c-0.7,0-1.81,0.37-1.81,1.39c0,0.95,0.86,1.31,2.64,1.9c2.4,0.83,3.01,2.05,3.01,3.45 C15.9,17.17,13.4,17.67,12.88,17.76z" />
                                        </g>
                                    </svg>
                                </span>
                            </div>
                            <div>
                                <span class="d-block mb-1">
                                    # Questions
                                </span>
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="fw-semibold mb-0">{{ $test->total_questions }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Test Header -->
                <div class="card custom-card mb-4">
                    <div class="card-header justify-content-between p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <h4 class="card-title mb-1 fw-bold">{{ $test->name }} <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill {{ $test->is_active ? 'bg-success' : 'bg-secondary' }} fs-12 fw-normal ms-5">
                                        {{ $test->is_active ? 'Active' : 'Inactive' }}
                                    </span></h4>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.tests.edit', $test) }}" class="btn btn-warning btn-sm">
                                <i class="ri-edit-line me-1"></i>Edit
                            </a>
                            <a href="{{ route('admin.tests.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="ri-arrow-left-line me-1"></i>Back
                            </a>
                        </div>
                    </div>
                    @if ($test->description)
                        <div class="p-3 alert alert-success d-flex align-items-center rounded-0" role="alert">
                            <div>
                                {{ $test->description }}
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Test Sections -->
                <div class="card custom-card">
                    <div class="card-header justify-content-between py-2">
                        <div class="card-title">Test Sections</div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary rounded-5" data-bs-toggle="modal"
                                data-bs-target="#addSectionModal">
                                <i class="ri-add-line me-1"></i>Add Section
                            </button>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        @if ($test->sections->count() > 0)
                            <div class="accordion accordion-customicon1 accordionicon-left  accordions-items-seperate"
                                id="sectionsAccordion">

                                @foreach ($test->sections as $section)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="section{{ $section->id }}">
                                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $section->id }}"
                                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ $section->id }}">
                                                <div
                                                    class="d-flex justify-content-between align-items-center w-100 me-3">
                                                    <div>
                                                        <strong>{{ $section->name }}</strong>
                                                        @if ($section->description)
                                                            <span class="text-muted ms-2">-
                                                                {{ $section->description }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                        <span class="badge bg-info">{{ $section->questions->count() }}
                                                            questions</span>
                                                        @if ($section->time_limit_minutes)
                                                            <span
                                                                class="badge bg-secondary">{{ $section->time_limit_minutes }}
                                                                min</span>
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
                                                @if ($section->resources->count() > 0)
                                                    <div class="mb-4">
                                                        <h6 class="text-primary mb-3">
                                                            <i class="ri-file-line me-1"></i>Resources
                                                        </h6>
                                                        <div class="row">
                                                            @foreach ($section->resources as $resource)
                                                                <div class="col-md-6 mb-3">
                                                                    <div class="card border">
                                                                        <div class="card-body p-3">
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-start">
                                                                                <div>
                                                                                    <h6 class="card-title mb-1">
                                                                                        <i
                                                                                            class="ri-file-{{ $resource->type === 'audio' ? 'music' : ($resource->type === 'image' ? 'image' : 'text') }}-line me-1"></i>
                                                                                        {{ $resource->title ?? ucfirst($resource->type) }}
                                                                                    </h6>
                                                                                    <small class="text-muted">
                                                                                        {{ ucfirst($resource->type) }}
                                                                                        @if ($resource->file_size)
                                                                                            -
                                                                                            {{ $resource->file_size_human }}
                                                                                        @endif
                                                                                    </small>
                                                                                </div>
                                                                                <div class="dropdown">
                                                                                    <button
                                                                                        class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                                                        type="button"
                                                                                        data-bs-toggle="dropdown">
                                                                                        <i class="ri-more-2-line"></i>
                                                                                    </button>
                                                                                    <ul class="dropdown-menu">
                                                                                        <li><a class="dropdown-item"
                                                                                                href="#"><i
                                                                                                    class="ri-eye-line me-1"></i>View</a>
                                                                                        </li>
                                                                                        <li><a class="dropdown-item"
                                                                                                href="#"><i
                                                                                                    class="ri-edit-line me-1"></i>Edit</a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <hr
                                                                                                class="dropdown-divider">
                                                                                        </li>
                                                                                        <li><a class="dropdown-item text-danger"
                                                                                                href="#"><i
                                                                                                    class="ri-delete-bin-line me-1"></i>Delete</a>
                                                                                        </li>
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
                                                    <div
                                                        class="d-flex justify-content-between align-items-center mb-3">
                                                        <h6 class="text-primary mb-0">
                                                            <i class="ri-question-line me-1"></i>Questions
                                                            ({{ $section->questions->count() }})
                                                        </h6>
                                                        <button class="btn btn-outline-primary rounded-3"
                                                            onclick="addQuestion({{ $section->id }})">
                                                            <i class="ri-add-line me-1"></i>Add Question
                                                        </button>
                                                    </div>

                                                    @if ($section->questions->count() > 0)
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-bordered table-md table-striped bg-light">
                                                                <thead class="table-dark">
                                                                    <tr>
                                                                        <th width="50">#</th>
                                                                        <th>Question</th>
                                                                        <th width="120">Type</th>
                                                                        <th width="80">Points</th>
                                                                        <th width="100">Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($section->questions->sortBy('order') as $question)
                                                                        <tr>
                                                                            <td class="text-center">
                                                                                {{ $question->order }}</td>
                                                                            <td>
                                                                                <div class="text-truncate"
                                                                                    style="max-width: 300px;">
                                                                                    {{ Str::limit(strip_tags($question->question_text), 80) }}
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <span class="badge bg-dark">
                                                                                    {{ ucfirst(str_replace('_', ' ', $question->question_type_new ?? $question->question_type)) }}
                                                                                </span>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                {{ $question->points ?? 1 }}</td>
                                                                            <td>
                                                                                <div class="btn-group btn-group-sm">
                                                                                    <a href="{{ route('admin.test-sections.questions.show', [$section, $question]) }}"
                                                                                        class="btn btn-outline-info btn-sm"
                                                                                        title="View">
                                                                                        <i class="ri-eye-line"></i>
                                                                                    </a>
                                                                                    <a href="{{ route('admin.test-sections.questions.edit', [$section, $question]) }}"
                                                                                        class="btn btn-outline-warning btn-sm"
                                                                                        title="Edit">
                                                                                        <i class="ri-edit-line"></i>
                                                                                    </a>
                                                                                    <button
                                                                                        class="btn btn-outline-danger btn-sm"
                                                                                        title="Delete"
                                                                                        onclick="deleteQuestion({{ $question->id }}, '{{ Str::limit(strip_tags($question->question_text), 30) }}', {{ $section->id }})">
                                                                                        <i
                                                                                            class="ri-delete-bin-line"></i>
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
                                                            <i class="ri-question-line text-muted"
                                                                style="font-size: 3rem;"></i>
                                                            <p class="text-muted mt-2">No questions added yet</p>
                                                            <button class="btn btn-primary"
                                                                onclick="addQuestion({{ $section->id }})">
                                                                <i class="ri-add-line me-1"></i>Add First Question
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Section Actions -->
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('admin.test-sections.edit', $section) }}"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="ri-edit-line me-1"></i>Edit Section
                                                    </a>
                                                    <button class="btn btn-outline-info btn-sm"
                                                        onclick="addResource({{ $section->id }})">
                                                        <i class="ri-upload-line me-1"></i>Add Resource
                                                    </button>
                                                    <button class="btn btn-outline-danger btn-sm"
                                                        onclick="deleteSection({{ $section->id }}, '{{ $section->name }}')">
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
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addSectionModal">
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
        <div class="modal-dialog modal-dialog-centered">
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
                            <input type="number" class="form-control" id="section_time_limit"
                                name="time_limit_minutes" min="1">
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
