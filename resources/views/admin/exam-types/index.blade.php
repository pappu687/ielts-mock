<x-backend-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between p-3">
                        <div class="card-title">All Exam Types</div>
                        <a href="#" class="btn btn-primary"><i
                                class="ri-add-line align-middle me-1 fw-medium d-inline-block"></i>Create New Exam Type</a>
                    </div>
                    <div class="card-body">
                        <table id="exam-types-table" class="table table-bordered text-nowrap w-100 table-striped my-3">
                            <thead>
                                <tr>
                                    @foreach ($columns as $column)
                                        <th>{{ $column['title'] }}</th>
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
                const table = $('#exam-types-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.exam-types.list') }}',
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
                    autoWidth: false,
                    responsive: true
                });

                // Custom functions for exam type actions
                window.setPricing = function(examTypeId) {
                    if (confirm('Are you sure you want to set pricing for this exam type?')) {
                        // Implement pricing logic here
                        console.log('Setting pricing for exam type:', examTypeId);
                    }
                };

                window.deleteExamType = function(examTypeId) {
                    if (confirm('Are you sure you want to delete this exam type?')) {
                        // Implement delete logic here
                        console.log('Deleting exam type:', examTypeId);
                    }
                };
            });
        </script>
    @endpush
</x-backend-layout>
