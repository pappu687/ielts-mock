<x-backend-layout>
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between p-3">
                        <div class="card-title">All Users</div>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-secondary"><i
                                class="ri-add-line align-middle me-1 fw-medium d-inline-block"></i>Create New User</a>
                    </div>
                    <div class="card-body pt-0">
                        <table id="users-table" class="table table-bordered w-100 table-striped my-3 border-bottom">
                            <thead>
                                <tr>
                                    @foreach ($columns as $column)
                                        <th class="bg-primary-transparent">{{ $column['title'] }}</th>
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
                        topStart: 'info'
                    },                    
                    language: {
                        processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'                        
                    },                    
                    autoWidth: false                    
                });

                // Custom functions for user actions
                window.suspendUser = function(userId) {
                    if (confirm('Are you sure you want to suspend this user?')) {
                        // Implement suspend logic here
                        console.log('Suspending user:', userId);
                    }
                };

                window.deactivateUser = function(userId) {
                    if (confirm('Are you sure you want to deactivate this user?')) {
                        // Implement deactivate logic here
                        console.log('Deactivating user:', userId);
                    }
                };
            });
        </script>
    @endpush
</x-backend-layout>
