<x-backend-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between p-3">
                        <div class="card-title">Reading Assessments</div>
                    </div>
                    <div class="card-body">
                        <table id="reading-assessments-table" class="table table-bordered w-100 table-striped my-3 border-bottom">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Exam Type</th>
                                    <th>Date</th>
                                    <th>Band Score</th>
                                    <th>Status</th>
                                    <th>Actions</th>
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

    <!-- Offcanvas for Editing Score -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="editScoreOffcanvas" aria-labelledby="editScoreOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="editScoreOffcanvasLabel">Edit Reading Score</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form id="editScoreForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="examSectionId" name="exam_section_id">
                
                <div class="mb-3">
                    <label for="bandScore" class="form-label">Band Score</label>
                    <input type="number" class="form-control" id="bandScore" name="band_score" step="0.5" min="0" max="9" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="offcanvas">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                const table = $('#reading-assessments-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.reading-assessments.scores') }}',
                        type: 'GET'
                    },
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'user_name', name: 'examSession.user.name' },
                        { data: 'exam_type', name: 'examSession.examType.name' },
                        { data: 'date', name: 'created_at' },
                        { data: 'band_score', name: 'band_score' },
                        { data: 'status', name: 'status' },
                        { data: 'actions', name: 'actions', orderable: false, searchable: false }
                    ],
                    order: [[0, 'desc']],
                    pageLength: 25,
                    language: {
                        searchPlaceholder: 'Search...',
                        processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
                    }
                });

                // Handle Edit Button Click
                $('#reading-assessments-table').on('click', '.edit-score-btn', function() {
                    const id = $(this).data('id');
                    const score = $(this).data('score');
                    
                    $('#examSectionId').val(id);
                    $('#bandScore').val(score);
                });

                // Handle Form Submit
                $('#editScoreForm').on('submit', function(e) {
                    e.preventDefault();
                    
                    const id = $('#examSectionId').val();
                    const formData = $(this).serialize();
                    const url = '{{ route('admin.reading-assessments.update-score', ':id') }}'.replace(':id', id);

                    // Show loading state
                    const submitBtn = $(this).find('button[type="submit"]');
                    const originalBtnText = submitBtn.text();
                    submitBtn.prop('disabled', true).text('Saving...');

                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: formData,
                        success: function(response) {
                            // Close offcanvas
                            const offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('editScoreOffcanvas'));
                            offcanvas.hide();

                            // Show success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });

                            // Reload table
                            table.ajax.reload();
                        },
                        error: function(xhr) {
                            let message = 'Something went wrong';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: message
                            });
                        },
                        complete: function() {
                            submitBtn.prop('disabled', false).text(originalBtnText);
                        }
                    });
                });
            });
        </script>
    @endpush
</x-backend-layout>
