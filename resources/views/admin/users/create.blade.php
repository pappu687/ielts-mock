<x-backend-layout>
    <div class="container p-3">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-bold fs-18 mb-0">Add New User</h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add User</li>
                </ol>
            </div>
        </div>
        
        <!-- Flash Messages -->
       
        
        <form id="createUserForm" method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">First Name <span class="text-danger">*</span></label>
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" 
                       placeholder="First name" aria-label="First name" value="{{ old('first_name') }}" required>
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" 
                       placeholder="Last name" aria-label="Last name" value="{{ old('last_name') }}" required>
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="row">
                    <div class="col-xl-12 mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                               placeholder="Email" aria-label="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-12 mb-3">
                        <label class="form-label">D.O.B</label>
                        <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" 
                               aria-label="dateofbirth" value="{{ old('date_of_birth') }}">
                        @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-12">
                        <label class="form-label">Contact Number</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                               placeholder="Phone number" aria-label="Phone number" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Address</label>
                <div class="row">
                    <div class="col-xl-12 mb-3">
                        <input type="text" name="street" class="form-control @error('street') is-invalid @enderror" 
                               placeholder="Street" aria-label="Street" value="{{ old('street') }}">
                        @error('street')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-12 mb-3">
                        <input type="text" name="landmark" class="form-control @error('landmark') is-invalid @enderror" 
                               placeholder="Landmark" aria-label="Landmark" value="{{ old('landmark') }}">
                        @error('landmark')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-3">
                        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" 
                               placeholder="City" aria-label="City" value="{{ old('city') }}">
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-3">
                        <select name="state" id="inputState1" class="form-select @error('state') is-invalid @enderror">
                            <option value="">State/Province</option>
                            <option value="California" {{ old('state') == 'California' ? 'selected' : '' }}>California</option>
                            <option value="New York" {{ old('state') == 'New York' ? 'selected' : '' }}>New York</option>
                            <option value="Texas" {{ old('state') == 'Texas' ? 'selected' : '' }}>Texas</option>
                            <option value="Florida" {{ old('state') == 'Florida' ? 'selected' : '' }}>Florida</option>
                        </select>
                        @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-3">
                        <input type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" 
                               placeholder="Postal/Zip code" aria-label="Postal/Zip code" value="{{ old('postal_code') }}">
                        @error('postal_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-3">
                        <select name="country" id="inputCountry" class="form-select @error('country') is-invalid @enderror">
                            <option value="">Country</option>
                            <option value="United States" {{ old('country') == 'United States' ? 'selected' : '' }}>United States</option>
                            <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                            <option value="United Kingdom" {{ old('country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                            <option value="Australia" {{ old('country') == 'Australia' ? 'selected' : '' }}>Australia</option>
                        </select>
                        @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>            
            <div class="col-md-12">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="send_activation_email" value="1" 
                           id="gridCheck" {{ old('send_activation_email') ? 'checked' : '' }}>
                    <label class="form-check-label" for="gridCheck">
                        Send Activation Email
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-md btn-primary">Create User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-md btn-outline-secondary ms-2">Cancel</a>
            </div>
        </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    (function($){
        'use strict';
        
        // Initialize jQuery Validate
        $('#createUserForm').validate({
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
                    required: true,
                    email: true,
                    maxlength: 255
                },
                date_of_birth: {
                    date: true,
                    max: new Date().toISOString().split('T')[0] // Must be before today
                },
                phone: {
                    minlength: 10,
                    maxlength: 20,
                    pattern: /^[\+]?[1-9][\d\s\-\(\)]{9,19}$/
                },
                street: {
                    maxlength: 255
                },
                landmark: {
                    maxlength: 255
                },
                city: {
                    maxlength: 255
                },
                state: {
                    maxlength: 255
                },
                postal_code: {
                    maxlength: 20
                },
                country: {
                    maxlength: 255
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
                    required: "Email is required",
                    email: "Please enter a valid email address",
                    maxlength: "Email cannot exceed 255 characters"
                },
                date_of_birth: {
                    date: "Please enter a valid date",
                    max: "Date of birth must be before today"
                },
                phone: {
                    minlength: "Phone number must be at least 10 characters",
                    maxlength: "Phone number cannot exceed 20 characters",
                    pattern: "Please enter a valid phone number"
                },
                street: {
                    maxlength: "Street address cannot exceed 255 characters"
                },
                landmark: {
                    maxlength: "Landmark cannot exceed 255 characters"
                },
                city: {
                    maxlength: "City cannot exceed 255 characters"
                },
                state: {
                    maxlength: "State cannot exceed 255 characters"
                },
                postal_code: {
                    maxlength: "Postal code cannot exceed 20 characters"
                },
                country: {
                    maxlength: "Country cannot exceed 255 characters"
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
        
        // Add custom validation method for date (must be before today)
        $.validator.addMethod("max", function(value, element, param) {
            if (this.optional(element)) {
                return true;
            }
            var date = new Date(value);
            var maxDate = new Date(param);
            return date <= maxDate;
        }, "Date must be before today.");
        
    }(jQuery));
    </script>
</x-backend-layout>
