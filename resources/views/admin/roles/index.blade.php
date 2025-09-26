<x-backend-layout>
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">
                Manage User Roles
            </h1>
            <div class="ms-md-1 ms-0">
                <a class="btn btn-md btn-primary" href="{{ route('admin.roles.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.role.title_singular') }}
                </a>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    {{ trans('cruds.role.title_singular') }} {{ trans('global.list') }}
                </div>
            </div>
            <table class="table table-striped table-hover datatable datatable-Role">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.role.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.role.fields.title') }}
                        </th>
                        <th width="150">
                            {{ trans('cruds.role.fields.permissions') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                        <tr data-entry-id="{{ $role->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $role->id ?? '' }}
                            </td>
                            <td>
                                {{ $role->name ?? '' }}
                            </td>
                            <td>
                                @foreach ($role->permissions()->pluck('name') as $permission)
                                    <span class="badge bg-info">{{ $permission }}</span>
                                @endforeach
                            </td>
                            <td width="200">
                                <a class="btn btn-sm btn-primary" href="{{ route('admin.roles.show', $role->id) }}">
                                    {{ trans('global.view') }}
                                </a>

                                <a class="btn btn-sm btn-info" href="{{ route('admin.roles.edit', $role->id) }}">
                                    {{ trans('global.edit') }}
                                </a>

                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                    onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                    style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-sm btn-danger"
                                        value="{{ trans('global.delete') }}">
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @section('scripts')
            @parent
            <script>
                $(function() {
                    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
                    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
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
                                alert('{{ trans('global.datatables.zero_selected') }}')

                                return
                            }

                            if (confirm('{{ trans('global.areYouSure') }}')) {
                                $.ajax({
                                        headers: {
                                            'x-csrf-token': _token
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
