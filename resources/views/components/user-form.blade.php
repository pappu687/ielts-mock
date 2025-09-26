@props(['user' => null, 'isEdit' => false])

@php
    $formId = $isEdit ? 'updateUserForm' : 'createUserForm';
    $formAction = $isEdit ? route('admin.users.update', $user->id) : route('admin.users.store');
    $formMethod = $isEdit ? 'POST' : 'POST';
    $submitText = $isEdit ? 'Update User' : 'Create User';
    $pageTitle = $isEdit ? 'Edit User' : 'Add New User';
    $breadcrumbText = $isEdit ? 'Edit User' : 'Add User';

    // Get values - use old() for validation errors, otherwise use user data or empty
    $firstName = old('first_name', $user->first_name ?? '');
    $lastName = old('last_name', $user->last_name ?? '');
    $email = old('email', $user->email ?? '');
    $phone = old('phone', $user->phone ?? '');
    $sendActivationEmail = old('send_activation_email', false);
    $role = old('role', $user ? $user->roles->first()->name ?? '' : '');
@endphp

<div class="container">
    <div class="page-header-breadcrumb mb-3">
        <div class="d-flex align-center justify-content-between flex-wrap">
            <h1 class="page-title fw-bold fs-18 mb-0">{{ $pageTitle }}</h1>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumbText }}</li>
            </ol>
        </div>
    </div>

    <form id="{{ $formId }}" method="{{ $formMethod }}" action="{{ $formAction }}">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">First Name <span class="text-danger">*</span></label>
                <input autofocus type="text" name="first_name"
                    class="form-control @error('first_name') is-invalid @enderror" placeholder="First name"
                    aria-label="First name" value="{{ $firstName }}">
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                    placeholder="Last name" aria-label="Last name" value="{{ $lastName }}">
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                    placeholder="Phone number" aria-label="Phone number" value="{{ $phone }}">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">

                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email" aria-label="email" value="{{ $email }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Role <span class="text-danger">*</span></label>
                <select name="role" class="form-select @error('role') is-invalid @enderror">
                    <option value="" disabled {{ $role ? '' : 'selected' }}>Select a role</option>
                    <option value="admin" {{ $role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="super-admin" {{ $role === 'super-admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="staff" {{ $role === 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="customer" {{ $role === 'customer' ? 'selected' : '' }}>Customer</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if (!$isEdit)
                <div class="col-md-12">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="send_activation_email" value="1"
                            id="gridCheck" {{ $sendActivationEmail ? 'checked' : '' }}>
                        <label class="form-check-label" for="gridCheck">
                            Send Activation Email
                        </label>
                    </div>
                </div>
            @endif
            <div class="col-md-12">
                <button type="submit" class="btn btn-md btn-primary">{{ $submitText }}</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-md btn-outline-secondary ms-2">Cancel</a>
            </div>
        </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
    integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    (function($) {
        'use strict';

        // Initialize jQuery Validate
        $('#{{ $formId }}').validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                last_name: {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                email: {
                    required: false,
                    email: true,
                    maxlength: 255
                },
                phone: {
                    required: true,
                    minlength: 11,
                    maxlength: 20
                },
                role: {
                    required: true
                }
            },
            messages: {
                first_name: {
                    required: "First name is required",
                    minlength: "First name must be at least 2 characters",
                    maxlength: "First name cannot exceed 255 characters"
                },
                last_name: {
                    required: "Last name is required",
                    minlength: "Last name must be at least 2 characters",
                    maxlength: "Last name cannot exceed 255 characters"
                },
                email: {
                    required: false,
                    email: "Please enter a valid email address",
                    maxlength: "Email cannot exceed 255 characters"
                },
                phone: {
                    required: 'Phone number is required',
                    minlength: "Phone number must be at least 10 characters",
                    maxlength: "Phone number cannot exceed 20 characters",
                    pattern: "Please enter a valid phone number"
                },
                role: {
                    required: 'Role is required'
                }
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.addClass('is-invalid');
                error.insertAfter(element);
            },
            success: function(label, element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
                label.remove();
            },
            highlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-valid').addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            submitHandler: function(form) {
                // Remove any existing validation classes before submission
                $('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
                form.submit();
            }
        });

        // Add custom validation method for phone numbers
        $.validator.addMethod("pattern", function(value, element, param) {
            if (this.optional(element)) {
                return true;
            }
            if (typeof param === "string") {
                param = new RegExp(param);
            }
            return param.test(value);
        }, "Invalid format.");

    }(jQuery));
</script>
