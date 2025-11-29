<x-backend-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between p-3">
                        <div class="card-title">Speaking Assessments</div>
                    </div>
                    <div class="card-body">
                        <table id="speaking-assessments-table" class="table table-bordered w-100 table-striped my-3 border-bottom">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Exam Type</th>
                                    <th>Date</th>
                                    <th>Overall Score</th>
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

    <!-- Offcanvas for Grading -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="gradeOffcanvas" aria-labelledby="gradeOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="gradeOffcanvasLabel">Grade Speaking Assessment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form id="gradeForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="assessmentId" name="assessment_id">
                
                <div class="mb-3">
                    <label for="fluencyCoherence" class="form-label">Fluency & Coherence</label>
                    <input type="number" class="form-control" id="fluencyCoherence" name="fluency_coherence_score" step="0.5" min="0" max="9" required>
                </div>
                <div class="mb-3">
                    <label for="lexicalResource" class="form-label">Lexical Resource</label>
                    <input type="number" class="form-control" id="lexicalResource" name="lexical_resource_score" step="0.5" min="0" max="9" required>
                </div>
                <div class="mb-3">
                    <label for="grammarRange" class="form-label">Grammar Range & Accuracy</label>
                    <input type="number" class="form-control" id="grammarRange" name="grammar_range_score" step="0.5" min="0" max="9" required>
                </div>
                <div class="mb-3">
                    <label for="pronunciation" class="form-label">Pronunciation</label>
                    <input type="number" class="form-control" id="pronunciation" name="pronunciation_score" step="0.5" min="0" max="9" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Save Scores</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="offcanvas">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                const table = $('#speaking-assessments-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.speaking-assessments.index') }}',
                        type: 'GET'
                    },
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'user_name', name: 'examSection.examSession.user.name' },
                        { data: 'exam_type', name: 'examSection.examSession.examType.name' },
                        { data: 'date', name: 'created_at' },
                        { data: 'overall_score', name: 'overall_band_score' },
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

                // Handle Grade Button Click
                $('#speaking-assessments-table').on('click', '.grade-btn', function() {
                    const id = $(this).data('id');
                    const fc = $(this).data('fc');
                    const lr = $(this).data('lr');
                    const gr = $(this).data('gr');
                    const pr = $(this).data('pr');
                    
                    $('#assessmentId').val(id);
                    $('#fluencyCoherence').val(fc);
                    $('#lexicalResource').val(lr);
                    $('#grammarRange').val(gr);
                    $('#pronunciation').val(pr);
                });

                // Handle Form Submit
                $('#gradeForm').on('submit', function(e) {
                    e.preventDefault();
                    
                    const id = $('#assessmentId').val();
                    const formData = $(this).serialize();
                    const url = '{{ route('admin.speaking-assessments.scores', ':id') }}'.replace(':id', id);

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
                            const offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('gradeOffcanvas'));
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
