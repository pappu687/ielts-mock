<x-backend-layout>
    <div class="container-fluid">        
        <div class="card custom-card mt-3 rounded-3">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Edit User Role
                </div>
                    <a class="btn btn-md btn-outline-primary rounded-3" href="{{ route('admin.roles.index') }}">
                    All Roles
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.roles.update', [$role->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3 {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Role Name*</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ old('name', isset($role) ? $role->name : '') }}" required>
                        @if ($errors->has('name'))
                            <em class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </em>
                        @endif                        
                    </div>
                    <div class="form-group mb-3 {{ $errors->has('permission') ? 'has-error' : '' }}">
                        <label>Permissions*</label>
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
                                            {{ in_array($permissionName, old('permission', [])) || (isset($role) && $role->hasPermissionTo($permissionName)) ? 'checked' : '' }}
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
                        
                    </div>
                    <div>
                        <input class="btn btn-success rounded-3" type="submit" value="Save">
                    </div>
                </form>


            </div>
        </div>
    </div>
</x-backend-layout>
