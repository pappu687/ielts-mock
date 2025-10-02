<x-backend-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between p-3">
                        <div class="card-title">Edit Test: {{ $test->name }}</div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.tests.show', $test) }}" class="btn btn-outline-info">
                                <i class="ri-eye-line align-middle me-1"></i>View Test
                            </a>
                            <a href="{{ route('admin.tests.index') }}" class="btn btn-outline-secondary">
                                <i class="ri-arrow-left-line align-middle me-1"></i>Back to Tests
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.tests.update', $test) }}" method="POST" id="edit-test-form">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Test Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name', $test->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="type" class="form-label">Test Type <span class="text-danger">*</span></label>
                                        <select class="form-select @error('type') is-invalid @enderror" 
                                                id="type" name="type" required>
                                            <option value="">Select Test Type</option>
                                            <option value="listening" {{ old('type', $test->type) == 'listening' ? 'selected' : '' }}>Listening</option>
                                            <option value="reading" {{ old('type', $test->type) == 'reading' ? 'selected' : '' }}>Reading</option>
                                            <option value="writing" {{ old('type', $test->type) == 'writing' ? 'selected' : '' }}>Writing</option>
                                            <option value="speaking" {{ old('type', $test->type) == 'speaking' ? 'selected' : '' }}>Speaking</option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="3">{{ old('description', $test->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="duration_minutes" class="form-label">Duration (minutes)</label>
                                        <input type="number" class="form-control @error('duration_minutes') is-invalid @enderror" 
                                               id="duration_minutes" name="duration_minutes" 
                                               value="{{ old('duration_minutes', $test->duration_minutes) }}" min="1" max="300">
                                        @error('duration_minutes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Leave empty to use default duration based on test type</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">Test Information</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <small class="text-muted">Created:</small><br>
                                                <strong>{{ $test->created_at->format('M d, Y') }}</strong>
                                            </div>
                                            <div class="mb-3">
                                                <small class="text-muted">Last Updated:</small><br>
                                                <strong>{{ $test->updated_at->format('M d, Y H:i') }}</strong>
                                            </div>
                                            <div class="mb-3">
                                                <small class="text-muted">Status:</small><br>
                                                <span class="badge {{ $test->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $test->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </div>
                                            <div class="mb-3">
                                                <small class="text-muted">Sections:</small><br>
                                                <strong>{{ $test->sections->count() }}</strong>
                                            </div>
                                            <div class="mb-3">
                                                <small class="text-muted">Total Questions:</small><br>
                                                <strong>{{ $test->total_questions }}</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card bg-warning bg-opacity-10 mt-3">
                                        <div class="card-body">
                                            <h6 class="card-title text-warning">
                                                <i class="ri-alert-line me-1"></i>Warning
                                            </h6>
                                            <p class="card-text small text-muted">
                                                Changing the test type may affect existing sections and questions. 
                                                Please review your test structure after making changes.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.tests.show', $test) }}" class="btn btn-outline-secondary">Cancel</a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ri-save-line align-middle me-1"></i>Update Test
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
                // Warn user if they change test type
                const originalType = '{{ $test->type }}';
                $('#type').change(function() {
                    const newType = $(this).val();
                    if (newType !== originalType) {
                        Swal.fire({
                            title: 'Test Type Change Warning',
                            text: 'Changing the test type may affect existing sections and questions. Are you sure you want to continue?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, continue',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (!result.isConfirmed) {
                                $(this).val(originalType);
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
</x-backend-layout>
