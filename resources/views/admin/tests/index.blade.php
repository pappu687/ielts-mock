<x-backend-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between p-3">
                        <div class="card-title">All Tests</div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#createTestOffcanvas">
                                <i class="ri-add-line align-middle me-1 fw-medium d-inline-block"></i>Create New Test
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tests-table" class="table table-bordered w-100 table-striped my-3 border-bottom">
                            <thead>
                                <tr>
                                    @foreach ($columns as $column)
                                        <th class="bg-primary-transparent @isset($column['className']) {{ $column['className'] }} @endisset">
                                            {{ $column['title'] }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <!-- DataTable will populate this -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Test Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="createTestOffcanvas" aria-labelledby="createTestOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="createTestOffcanvasLabel">Create New Test</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form id="createTestForm">
                @csrf
                <div class="mb-3">
                    <label for="createName" class="form-label">Test Name</label>
                    <input type="text" class="form-control" id="createName" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="createType" class="form-label">Test Type</label>
                    <select class="form-select" id="createType" name="type" required>
                        <option value="">Select Type</option>
                        <option value="reading">Reading</option>
                        <option value="listening">Listening</option>
                        <option value="writing">Writing</option>
                        <option value="speaking">Speaking</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="createDuration" class="form-label">Duration (minutes)</label>
                    <input type="number" class="form-control" id="createDuration" name="duration_minutes" min="1" required>
                </div>
                <div class="mb-3">
                    <label for="createDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="createDescription" name="description" rows="3"></textarea>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Create Test</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="offcanvas">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Test Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="editTestOffcanvas" aria-labelledby="editTestOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="editTestOffcanvasLabel">Edit Test</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form id="editTestForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="editTestId" name="id">
                <div class="mb-3">
                    <label for="editName" class="form-label">Test Name</label>
                    <input type="text" class="form-control" id="editName" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="editType" class="form-label">Test Type</label>
                    <select class="form-select" id="editType" name="type" required>
                        <option value="reading">Reading</option>
                        <option value="listening">Listening</option>
                        <option value="writing">Writing</option>
                        <option value="speaking">Speaking</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="editDuration" class="form-label">Duration (minutes)</label>
                    <input type="number" class="form-control" id="editDuration" name="duration_minutes" min="1" required>
                </div>
                <div class="mb-3">
                    <label for="editDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="editDescription" name="description" rows="3"></textarea>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Update Test</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="offcanvas">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                const table = $('#tests-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.tests.list') }}',
                        type: 'GET'
                    },
                    columns: @json($columns),
                    order: [[0, 'desc']],
                    pageLength: 25,
                    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                    layout: {
                        topEnd: 'pageLength',
                        topStart: 'search',
                        bottomStart: 'info'
                    },
                    language: {
                        searchPlaceholder: 'Type to filter...',
                        processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
                    },
                    autoWidth: false
                });

                // Create Test Form Submit
                $('#createTestForm').on('submit', function(e) {
                    e.preventDefault();
                    const form = $(this);
                    const submitBtn = form.find('button[type="submit"]');
                    const originalText = submitBtn.text();

                    submitBtn.prop('disabled', true).text('Creating...');

                    $.ajax({
                        url: '{{ route('admin.tests.store') }}',
                        type: 'POST',
                        data: form.serialize(),
                        success: function(response) {
                            if (response.success) {
                                window.location.href = response.redirect_url;
                            }
                        },
                        error: function(xhr) {
                            let message = 'Failed to create test.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            }
                            Swal.fire('Error!', message, 'error');
                            submitBtn.prop('disabled', false).text(originalText);
                        }
                    });
                });

                // Edit Test Button Click
                $('#tests-table').on('click', '.edit-test-btn', function() {
                    const id = $(this).data('id');
                    const url = '{{ route('admin.tests.edit', ':id') }}'.replace(':id', id);

                    // Show loading or open offcanvas immediately with loading state
                    const offcanvas = new bootstrap.Offcanvas(document.getElementById('editTestOffcanvas'));
                    offcanvas.show();

                    // Load data
                    $.get(url, function(data) {
                        $('#editTestId').val(data.id);
                        $('#editName').val(data.name);
                        $('#editType').val(data.type);
                        $('#editDuration').val(data.duration_minutes);
                        $('#editDescription').val(data.description);
                    }).fail(function() {
                        Swal.fire('Error!', 'Failed to load test data.', 'error');
                        offcanvas.hide();
                    });
                });

                // Edit Test Form Submit
                $('#editTestForm').on('submit', function(e) {
                    e.preventDefault();
                    const form = $(this);
                    const id = $('#editTestId').val();
                    const url = '{{ route('admin.tests.update', ':id') }}'.replace(':id', id);
                    const submitBtn = form.find('button[type="submit"]');
                    const originalText = submitBtn.text();

                    submitBtn.prop('disabled', true).text('Updating...');

                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: form.serialize(),
                        success: function(response) {
                            if (response.success) {
                                const offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('editTestOffcanvas'));
                                offcanvas.hide();
                                Swal.fire('Success!', response.message, 'success');
                                table.ajax.reload();
                            }
                        },
                        error: function(xhr) {
                            let message = 'Failed to update test.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            }
                            Swal.fire('Error!', message, 'error');
                        },
                        complete: function() {
                            submitBtn.prop('disabled', false).text(originalText);
                        }
                    });
                });

                // Delete Test
                window.deleteTest = function(testId) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to delete this test? This action cannot be undone.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Processing...',
                                text: 'Please wait while we delete the test.',
                                allowOutsideClick: false,
                                didOpen: () => { Swal.showLoading(); }
                            });

                            $.ajax({
                                url: '{{ route('admin.tests.destroy', ':id') }}'.replace(':id', testId),
                                type: 'DELETE',
                                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                success: function(response) {
                                    Swal.fire('Deleted!', response.message, 'success').then(() => {
                                        table.ajax.reload();
                                    });
                                },
                                error: function(xhr) {
                                    let message = 'Failed to delete test.';
                                    if (xhr.responseJSON && xhr.responseJSON.message) {
                                        message = xhr.responseJSON.message;
                                    }
                                    Swal.fire('Error!', message, 'error');
                                }
                            });
                        }
                    });
                };
            });
        </script>
    @endpush
</x-backend-layout>
