<x-backend-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between p-3">
                        <div class="card-title">All Tests</div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.tests.create') }}" class="btn btn-secondary">
                                <i class="ri-add-line align-middle me-1 fw-medium d-inline-block"></i>Create New Test
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tests-table" class="table table-bordered w-100 table-striped my-3 border-bottom">
                            <thead>
                                <tr>
                                    @foreach ($columns as $column)
                                        <th
                                            class="bg-primary-transparent @isset($column['className']) {{ $column['className'] }} @endisset">
                                            {{ $column['title'] }}</th>
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
                    order: [
                        [0, 'desc']
                    ],

                    pageLength: 25,
                    lengthMenu: [
                        [10, 25, 50, 100],
                        [10, 25, 50, 100]
                    ],
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

                // Custom functions for test actions
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
                            // Show loading
                            Swal.fire({
                                title: 'Processing...',
                                text: 'Please wait while we delete the test.',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            // Make Ajax request
                            $.ajax({
                                url: '{{ route('admin.tests.destroy', ':id') }}'.replace(':id', testId),
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
                                        // Reload DataTable
                                        table.ajax.reload();
                                    });
                                },
                                error: function(xhr) {
                                    let message = 'Failed to delete test. Please try again.';
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
                };

                window.toggleTestStatus = function(testId) {
                    $.ajax({
                        url: '{{ route('admin.tests.toggle-status', ':id') }}'.replace(':id', testId),
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Success!',
                                response.message,
                                'success'
                            ).then(() => {
                                // Reload DataTable
                                table.ajax.reload();
                            });
                        },
                        error: function(xhr) {
                            let message = 'Failed to update test status. Please try again.';
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
                };
            });
        </script>
    @endpush
</x-backend-layout>
