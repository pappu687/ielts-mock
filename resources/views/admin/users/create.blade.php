<x-backend-layout>
    <div class="page-header-breadcrumb mb-3">
        <div class="d-flex align-center justify-content-between flex-wrap">
            <h1 class="page-title fw-medium fs-18 mb-0">Add New User</h1>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add User</li>
            </ol>
        </div>
    </div>
    <div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">First Name</label>
        <input type="text" class="form-control" placeholder="First name"
            aria-label="First name">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Last Name</label>
        <input type="text" class="form-control" placeholder="Last name"
            aria-label="Last name">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Address</label>
        <div class="row">
            <div class="col-xl-12 mb-3">
                <input type="text" class="form-control" placeholder="Street"
                aria-label="Street">
            </div>
            <div class="col-xl-12 mb-3">
                <input type="text" class="form-control" placeholder="Landmark"
                aria-label="Landmark">
            </div>
            <div class="col-xl-6 mb-3">
                <input type="text" class="form-control" placeholder="City"
                aria-label="City">
            </div>
            <div class="col-xl-6 mb-3">
                <select id="inputState1" class="form-select">
                    <option selected>State/Province</option>
                    <option>...</option>
                </select>
            </div>
            <div class="col-xl-6 mb-3">
                <input type="text" class="form-control" placeholder="Postal/Zip code"
                aria-label="Postal/Zip code">
            </div>
            <div class="col-xl-6 mb-3">
                <select id="inputCountry" class="form-select">
                    <option selected>Country</option>
                    <option>...</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="row">
            <div class="col-xl-12 mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Email"
                aria-label="email">
            </div>
            <div class="col-xl-12 mb-3">
                <label class="form-label">D.O.B</label>
                <input type="date" class="form-control"
                aria-label="dateofbirth">
            </div>
            <div class="col-xl-12 mb-3">
                <div class="row">
                    <label class="form-label mb-1">Maritial Status</label>
                    <div class="col-xl-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="status-married" required="">
                            <label class="form-check-label" for="status-married">
                                Married
                            </label>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="status-unmarried" required="">
                            <label class="form-check-label" for="status-unmarried">
                                Single
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">

            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Contact Number</label>
        <input type="number" class="form-control" placeholder="Phone number"
            aria-label="Phone number">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Alternative Contact</label>
        <input type="number" class="form-control" placeholder="Phone number"
            aria-label="Phone number">
    </div>
    <div class="col-md-12">
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
                Check me out
            </label>
        </div>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Sign in</button>
    </div>
</div> 
</x-backend-layout>
