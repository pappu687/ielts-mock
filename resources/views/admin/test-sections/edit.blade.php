<x-backend-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Page Header -->
                <div class="card custom-card mb-4">
                    <div class="card-header justify-content-between p-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <h4 class="card-title mb-1">Edit Section</h4>
                                <div class="d-flex gap-3 text-muted">
                                    <span><i class="ri-book-open-line me-1"></i>{{ $testSection->test->name }}</span>
                                    <span><i class="ri-list-check me-1"></i>{{ $testSection->name }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.tests.show', $testSection->test) }}" class="btn btn-outline-secondary btn-sm">
                                <i class="ri-arrow-left-line me-1"></i>Back to Test
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Edit Form -->
                <div class="card custom-card">
                    <div class="card-header p-3">
                        <h5 class="card-title mb-0">Section Details</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.test-sections.update', $testSection) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Section Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name', $testSection->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="order" class="form-label">Order <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                               id="order" name="order" value="{{ old('order', $testSection->order) }}" 
                                               min="1" required>
                                        @error('order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="3">{{ old('description', $testSection->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="time_limit_minutes" class="form-label">Time Limit (minutes)</label>
                                        <input type="number" class="form-control @error('time_limit_minutes') is-invalid @enderror" 
                                               id="time_limit_minutes" name="time_limit_minutes" 
                                               value="{{ old('time_limit_minutes', $testSection->time_limit_minutes) }}" 
                                               min="1" max="300">
                                        @error('time_limit_minutes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-check mt-4">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                                   value="1" {{ old('is_active', $testSection->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Active Section
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Instructions -->
                            <div class="mb-4">
                                <label class="form-label">Instructions</label>
                                <div id="instructions-container">
                                    @if(old('instructions') || $testSection->instructions)
                                        @foreach(old('instructions', $testSection->instructions ?? []) as $index => $instruction)
                                            <div class="instruction-item mb-2 d-flex gap-2">
                                                <input type="text" class="form-control" name="instructions[]" 
                                                       value="{{ $instruction }}" placeholder="Enter instruction...">
                                                <button type="button" class="btn btn-outline-danger btn-sm remove-instruction">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="instruction-item mb-2 d-flex gap-2">
                                            <input type="text" class="form-control" name="instructions[]" 
                                                   placeholder="Enter instruction...">
                                            <button type="button" class="btn btn-outline-danger btn-sm remove-instruction">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-outline-primary btn-sm" id="add-instruction">
                                    <i class="ri-add-line me-1"></i>Add Instruction
                                </button>
                            </div>

                            <!-- Form Actions -->
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.tests.show', $testSection->test) }}" class="btn btn-outline-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-save-line me-1"></i>Update Section
                                </button>
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
                // Add instruction
                $('#add-instruction').click(function() {
                    const container = $('#instructions-container');
                    const newItem = $(`
                        <div class="instruction-item mb-2 d-flex gap-2">
                            <input type="text" class="form-control" name="instructions[]" placeholder="Enter instruction...">
                            <button type="button" class="btn btn-outline-danger btn-sm remove-instruction">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                    `);
                    container.append(newItem);
                });

                // Remove instruction
                $(document).on('click', '.remove-instruction', function() {
                    $(this).closest('.instruction-item').remove();
                });

                // Ensure at least one instruction field
                function checkInstructions() {
                    if ($('.instruction-item').length === 0) {
                        $('#add-instruction').click();
                    }
                }

                // Check on page load
                checkInstructions();
            });
        </script>
    @endpush
</x-backend-layout>
