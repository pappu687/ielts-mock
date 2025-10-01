<x-backend-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between p-3">
                        <div class="card-title">All Question Banks</div>
                        <a href="#" class="btn btn-primary"><i
                                class="ri-add-line align-middle me-1 fw-medium d-inline-block"></i>Create New Question Bank</a>
                    </div>
                    <div class="card-body">
                        <table id="question-banks-table" class="table table-bordered text-nowrap w-100 table-striped my-3">
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
                const table = $('#question-banks-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.question-banks.list') }}',
                        type: 'POST'
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

                // Custom functions for question bank actions
                window.toggleActive = function(questionBankId) {
                    if (confirm('Are you sure you want to toggle this question bank?')) {
                        // Implement toggle logic here
                        console.log('Toggling question bank:', questionBankId);
                    }
                };

                window.deleteQuestionBank = function(questionBankId) {
                    if (confirm('Are you sure you want to delete this question bank?')) {
                        // Implement delete logic here
                        console.log('Deleting question bank:', questionBankId);
                    }
                };
            });
        </script>
    @endpush
</x-backend-layout>
