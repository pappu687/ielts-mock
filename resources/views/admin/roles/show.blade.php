<x-admin-layout>
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-3 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">
                Role Details
            </h1>
            <div class="ms-md-1 ms-0">
                <a class="btn btn-md btn-outline-dark" href="{{ route('admin.roles.index') }}">
                    All Roles
                </a>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    {{ trans('global.show') }} {{ trans('cruds.role.title') }}
                </div>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.role.fields.id') }}
                                </th>
                                <td>
                                    {{ $role->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.role.fields.title') }}
                                </th>
                                <td>
                                    {{ $role->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Permissions
                                </th>
                                <td>
                                    @foreach ($role->permissions()->pluck('name') as $permission)
                                        <span class="badge bg-info fs-10">{{ $permission }}</span>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
