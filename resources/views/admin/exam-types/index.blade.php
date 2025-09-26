<x-backend-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between p-3">
                        <div class="card-title">All Exam Types</div>
                        <button type="button" id="btnOpenCreateExamType" class="btn btn-secondary">
                            <i class="ri-add-line align-middle me-1 fw-medium d-inline-block"></i>Create New Exam Type
                        </button>
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

    <!-- Create/Edit Modal -->
    <div class="modal fade" id="examTypeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="examTypeModalTitle">Create Exam Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="examTypeModalBody">
                    @include('components.exam-type-form', ['examType' => null, 'isEdit' => false])
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
                        topStart: 'search'
                    },                    
                    language: {
                        processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'                        
                    },                    
                    autoWidth: false,
                    responsive: true
                });

                const modalEl = document.getElementById('examTypeModal');
                const modal = new bootstrap.Modal(modalEl);

                $('#btnOpenCreateExamType').on('click', function() {
                    $('#examTypeModalTitle').text('Create Exam Type');
                    $('#examTypeModalBody').html(`@php echo str_replace(['\n', '\r'], ['', ''], view('components.exam-type-form', ['examType' => null, 'isEdit' => false])->render()); @endphp`);
                    modal.show();
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

                window.openEditExamTypeModal = function(examTypeId) {
                    $('#examTypeModalTitle').text('Edit Exam Type');
                    $('#examTypeModalBody').html('<div class="text-center py-4"><div class="spinner-border text-primary" role="status"></div></div>');
                    modal.show();
                    $.get("{{ route('admin.exam-types.edit-form', ':id') }}".replace(':id', examTypeId))
                        .done(function(html) {
                            $('#examTypeModalBody').html(html);
                        })
                        .fail(function() {
                            $('#examTypeModalBody').html('<div class="alert alert-danger">Failed to load form. Please try again.</div>');
                        });
                }
            });
        </script>
    @endpush
</x-backend-layout>
