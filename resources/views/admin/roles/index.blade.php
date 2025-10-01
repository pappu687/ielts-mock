<x-backend-layout>
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">
                Manage User Roles
            </h1>
            <div class="ms-md-1 ms-0">
                <a class="btn btn-md btn-primary" href="{{ route('admin.roles.create') }}">
                    New Role
                </a>
            </div>
        </div>
        <div class="card custom-card mt-4">            
            <div class="card-body">
                <table class="table table-striped table-hover datatable datatable-Role">
                    <thead>
                        <tr>
                            <th>
                                Role Name
                            </th>
                            <th width="150">
                                Permissions
                            </th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr data-entry-id="{{ $role->id }}">
                                <td>
                                    {{ $role->name ?? '' }}
                                </td>
                                <td>
                                    {{ $role->permissions()->count() }} Permision(s)
                                </td>
                                <td width="200">
                                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('admin.roles.show', $role->id) }}">
                                                View
                                            </a>

                                            <a class="btn btn-sm btn-info"
                                                href="{{ route('admin.roles.edit', $role->id) }}">
                                                Edit
                                            </a>

                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                        </div>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @section('scripts')
            @parent
            <script>
                $(function() {
                    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
                    let deleteButtonTrans = 'Delete'
                    let deleteButton = {
                        text: deleteButtonTrans,
                        url: "{{ route('admin.roles.mass_destroy') }}",
                        className: 'btn-danger',
                        action: function(e, dt, node, config) {
                            var ids = $.map(dt.rows({
                                selected: true
                            }).nodes(), function(entry) {
                                return $(entry).data('entry-id')
                            });

                            if (ids.length === 0) {
                                alert('No rows selected')

                                return
                            }

                            if (confirm('Are you sure?')) {
                                $.ajax({
                                        headers: {
                                            'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        method: 'POST',
                                        url: config.url,
                                        data: {
                                            ids: ids,
                                            _method: 'DELETE'
                                        }
                                    })
                                    .done(function() {
                                        location.reload()
                                    })
                            }
                        }
                    }
                    dtButtons.push(deleteButton)

                    $.extend(true, $.fn.dataTable.defaults, {
                        order: [
                            [1, 'desc']
                        ],
                        pageLength: 100,
                    });
                    $('.datatable-Role:not(.ajaxTable)').DataTable({
                        buttons: dtButtons
                    })
                    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                        $($.fn.dataTable.tables(true)).DataTable()
                            .columns.adjust();
                    });
                })
            </script>
        @endsection
    </div>
</x-backend-layout>
