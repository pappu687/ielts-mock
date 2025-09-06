<x-guest-layout>
    <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-6 col-sm-8 col-12">
            <div class="card custom-card border-0 my-4">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <a href="{{ url('index') }}">
                            <img src="{{ asset('build/assets/images/brand-logos/toggle-logo.png') }}" alt="logo"
                                class="desktop-dark">
                        </a>
                    </div>
                    <p class="h4 mb-2 fw-semibold">Forgot Password?</p>                                        
                    <div class="row gy-3">
                        <div class="col-xl-12 mb-2">
                            <label for="lockscreen-password" class="form-label text-default">Enter your email</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" id="lockscreen-password"
                                    placeholder="Email">
                                
                            </div>
                        </div>
                        <div class="col-xl-12 d-grid mt-2">
                            <a href="index.html" class="btn btn-lg btn-primary">Send Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
