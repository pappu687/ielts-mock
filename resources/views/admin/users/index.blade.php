<x-backend-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between p-3">
                        <div class="card-title">All Users</div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.users.trashed') }}" class="btn btn-outline-warning">
                                <i class="ri-delete-bin-2-line align-middle me-1"></i>Trashed Users
                            </a>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-secondary"><i
                                    class="ri-add-line align-middle me-1 fw-medium d-inline-block"></i>Create New
                                User</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="users-table" class="table table-bordered w-100 table-striped my-3 border-bottom">
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
                const table = $('#users-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.users.list') }}',
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

                // Custom functions for user actions
                window.suspendUser = function(userId) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to suspend this user?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, suspend!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading
                            Swal.fire({
                                title: 'Processing...',
                                text: 'Please wait while we suspend the user.',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            // Make Ajax request
                            $.ajax({
                                url: '{{ route('admin.users.suspend', ':id') }}'.replace(':id',
                                    userId),
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    Swal.fire(
                                        'Suspended!',
                                        response.message,
                                        'success'
                                    ).then(() => {
                                        // Reload DataTable
                                        table.ajax.reload();
                                    });
                                },
                                error: function(xhr) {
                                    let message = 'Failed to suspend user. Please try again.';
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

                window.deleteUser = function(userId) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to delete this user? This is a soft delete and can be restored by an admin.",
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
                                text: 'Please wait while we delete the user.',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            // Make Ajax request
                            $.ajax({
                                url: '{{ route('admin.users.destroy', ':id') }}'.replace(':id',
                                    userId),
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
                                    let message =
                                        'Failed to delete user. Please try again.';
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
            });
        </script>
    @endpush
</x-backend-layout>