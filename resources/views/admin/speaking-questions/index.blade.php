<x-backend-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between p-3">
                        <div class="card-title">All Speaking Questions</div>
                        <a href="#" class="btn btn-primary"><i
                                class="ri-add-line align-middle me-1 fw-medium d-inline-block"></i>Create New Question</a>
                    </div>
                    <div class="card-body">
                        <table id="speaking-questions-table" class="table table-bordered text-nowrap w-100 table-striped my-3">
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
                const table = $('#speaking-questions-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.speaking-questions.list') }}',
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

                // Custom functions for speaking question actions
                window.updateFollowUps = function(questionId) {
                    if (confirm('Are you sure you want to update follow-ups for this question?')) {
                        // Implement follow-ups logic here
                        console.log('Updating follow-ups for question:', questionId);
                    }
                };

                window.deleteQuestion = function(questionId) {
                    if (confirm('Are you sure you want to delete this question?')) {
                        // Implement delete logic here
                        console.log('Deleting question:', questionId);
                    }
                };
            });
        </script>
    @endpush
</x-backend-layout>
