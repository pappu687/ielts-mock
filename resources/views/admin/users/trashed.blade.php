<x-backend-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between p-3">
                        <div class="card-title">Trashed Users</div>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary"><i
                                class="ri-arrow-left-line align-middle me-1 fw-medium d-inline-block"></i>Back To
                            Users</a>
                    </div>
                    <div class="card-body pt-0">
                        <table id="users-trashed-table"
                            class="table table-bordered w-100 table-striped my-3 border-bottom">
                            <thead>
                                <tr>
                                    @foreach ($columns as $column)
                                        <th class="bg-primary-transparent">{{ $column['title'] }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                const table = $('#users-trashed-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.users.list') }}',
                        type: 'GET',
                        data: {
                            trashed: 1
                        }
                    },
                    columns: @json($columns),
                    order: [
                        [0, 'desc']
                    ],
                    pageLength: 25,
                    layout: {
                        topEnd: 'pageLength',
                        topStart: 'info'
                    },
                    language: {
                        processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
                    },
                    autoWidth: false
                });

                window.restoreUser = function(userId) {
                    Swal.fire({
                        title: 'Restore user?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, restore',
                        cancelButtonText: 'Cancel'
                    }).then((res) => {
                        if (!res.isConfirmed) return;
                        $.ajax({
                            url: '{{ route('admin.users.restore', ':id') }}'.replace(':id', userId),
                            type: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(resp) {
                                Swal.fire('Restored!', resp.message || 'User restored.',
                                    'success').then(() => table.ajax.reload());
                            },
                            error: function() {
                                Swal.fire('Error', 'Failed to restore user.', 'error');
                            }
                        });
                    });
                };

                window.forceDeleteUser = function(userId) {
                    Swal.fire({
                        title: 'Delete permanently?',
                        text: 'This cannot be undone.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete',
                        cancelButtonText: 'Cancel'
                    }).then((res) => {
                        if (!res.isConfirmed) return;
                        $.ajax({
                            url: '{{ route('admin.users.forceDestroy', ':id') }}'.replace(':id',
                                userId),
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(resp) {
                                Swal.fire('Deleted!', resp.message ||
                                    'User permanently deleted.', 'success').then(() => table
                                    .ajax.reload());
                            },
                            error: function() {
                                Swal.fire('Error', 'Failed to delete user.', 'error');
                            }
                        });
                    });
                };
            });
        </script>
    @endpush
</x-backend-layout>