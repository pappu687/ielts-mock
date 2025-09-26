<x-backend-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between p-3">
                        <div class="card-title">
                            <h5 class="fw-semibold mb-0">Edit Customer</h5>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-light">View</a>
                            <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                                <i class="ri-arrow-left-line align-middle me-1"></i>Back to Customers
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST" id="user-form">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Link User (optional) -->
                                <div class="col-md-6 mb-3">
                                    <label for="user_id" class="form-label">Link User (optional)</label>
                                    <select class="form-select @error('user_id') is-invalid @enderror" id="user_id"
                                        name="user_id">
                                        <option value="">Select a user</option>
                                        @foreach ($users as $u)
                                            <option value="{{ $u->id }}"
                                                {{ old('user_id', $customer->user_id) == $u->id ? 'selected' : '' }}>
                                                {{ $u->first_name }} {{ $u->last_name }} — {{ $u->email }}
                                                {{ $u->phone ? '(' . $u->phone . ')' : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- DOB -->
                                <div class="col-md-6 mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                        id="dob" name="dob"
                                        value="{{ old('dob', optional($customer->dob)->format('Y-m-d')) }}">
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="col-12 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" value="{{ old('address', $customer->address) }}"
                                        placeholder="Street address">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror"
                                        id="city" name="city" value="{{ old('city', $customer->city) }}">
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="district" class="form-label">District</label>
                                    <input type="text" class="form-control @error('district') is-invalid @enderror"
                                        id="district" name="district"
                                        value="{{ old('district', $customer->district) }}">
                                    @error('district')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="zip" class="form-label">ZIP</label>
                                    <input type="text" class="form-control @error('zip') is-invalid @enderror"
                                        id="zip" name="zip" value="{{ old('zip', $customer->zip) }}">
                                    @error('zip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-light">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-save-line align-middle me-1"></i>Update Customer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-backend-layout>
