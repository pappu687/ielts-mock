<x-backend-layout>
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-3 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">
                Create User Role
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
                    {{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.roles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">{{ trans('cruds.role.fields.title') }}*</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ old('name', isset($role) ? $role->name : '') }}" required>
                        @if ($errors->has('name'))
                            <em class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.role.fields.title_helper') }}
                        </p>
                    </div>
                    <div class="form-group {{ $errors->has('permission') ? 'has-error' : '' }}">
                        <label>{{ trans('cruds.role.fields.permissions') }}*</label>
                        <div class="row mt-2">
                            @foreach ($permissions as $permissionName => $permissionLabel)
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="perm_{{ \Illuminate\Support\Str::slug($permissionName, '_') }}"
                                            name="permission[]"
                                            value="{{ $permissionName }}"
                                            {{ in_array($permissionName, old('permission', [])) ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label" for="perm_{{ \Illuminate\Support\Str::slug($permissionName, '_') }}">
                                            {{ $permissionLabel }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if ($errors->has('permission'))
                            <em class="invalid-feedback">
                                {{ $errors->first('permission') }}
                            </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.role.fields.permissions_helper') }}
                        </p>
                    </div>
                    <div>
                        <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                    </div>
                </form>


            </div>
        </div>
    </div>
</x-backend-layout>
