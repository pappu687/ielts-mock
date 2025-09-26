<x-admin-layout>
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
                    <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                        <label for="permission">{{ trans('cruds.role.fields.permissions') }}*
                            <span class="btn btn-info btn-sm select-all">{{ trans('global.select_all') }}</span>
                            <span
                                class="btn btn-info btn-sm deselect-all">{{ trans('global.deselect_all') }}</span></label>
                        <select name="permission[]" id="permission" class="mt-2 form-select select2" multiple="multiple"
                            required>
                            @foreach ($permissions as $id => $permissions)
                                <option value="{{ $id }}"
                                    {{ in_array($id, old('permission', [])) || (isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>
                                    {{ $permissions }}</option>
                            @endforeach
                        </select>
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
</x-admin-layout>
