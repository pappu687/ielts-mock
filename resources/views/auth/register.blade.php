<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="row authentication authentication-cover-main mx-0">
            <div class="col-xxl-9 col-xl-9">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-6 col-sm-8 col-12">
                        <div class="card custom-card border-0  shadow-none my-4">
                            <div class="card-body p-5">
                                <div>
                                    <h4 class="mb-1 fw-semibold">Create your account</h4>
                                    <p class="mb-4 text-muted fw-normal">Please enter valid credentials</p>
                                </div>
                                <div class="row gy-3">
                                    <div class="col-xl-12">
                                        <label for="signup-username" class="form-label text-default">User Name</label>
                                        <input type="text" class="form-control" id="signup-username" name="name"    
                                            placeholder="Enter User Name" value="">
                                        </div>
                                    <div class="col-xl-12">
                                        <label for="signin-email" class="form-label text-default">Email</label>
                                        <input type="text" class="form-control" id="signin-email" name="email"
                                            placeholder="Enter Email" value="">
                                    </div>
                                    <div class="col-xl-12 mb-2">
                                        <label for="signin-password"
                                            class="form-label text-default d-block">Password</label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control" id="signin-password" name="password"
                                                placeholder="Enter Password" value="12345678">
                                                        <a href="javascript:void(0);" class="show-password-button text-muted"
                                                onclick="createpassword('signin-password',this)"><i
                                                    class="ri-eye-off-line align-middle"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid mt-3">
                                    <a href="{{route('login')}}" class="btn btn-primary">Sign In</a>
                                </div>
                                <div class="text-center my-3 authentication-barrier">
                                    <span class="op-4 fs-13">OR</span>
                                </div>
                                                                <div class="d-flex mb-3">
                                    <button
                                        class="btn btn-white border d-flex align-items-center justify-content-center flex-fill">
                                        <span class="avatar avatar-xs">
                                            <img src="{{ asset('build/assets/images/media/apps/google.png') }}"
                                                alt="">
                                        </span>
                                        <span class="lh-1 ms-2 fs-13 text-default fw-medium">Google</span>
                                    </button>
                                    <div class="vr ms-3 me-2"></div>
                                    <button
                                        class="btn btn-white border ms-2 d-flex align-items-center justify-content-center">
                                        <span class="avatar avatar-xs">
                                            <img src="{{ asset('build/assets/images/media/apps/facebook.png') }}"
                                                alt=""></span>
                                        <span class="lh-1 ms-2 fs-13 text-default fw-medium">Facebook</span>
                                    </button>
                                </div>

                                <div class="text-center mt-3 fw-medium">
                                    Already have a account? <a href="{{route('login')}}" class="text-primary">Login
                                        Here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-12 d-xl-block d-none px-0">
                <div class="authentication-cover overflow-hidden">
                    <div class="authentication-cover-logo">
                        <a href="{{url('index')}}">
                            <img src="{{asset('build/assets/images/brand-logos/toggle-logo.png')}}" alt="logo" class="desktop-dark">
                        </a>
                    </div>
                    <div class="authentication-cover-background">
                        <img src="{{asset('build/assets/images/media/backgrounds/9.png')}}" alt="">
                    </div>
                   <div class="authentication-cover-content">
                        <div class="p-5">
                            <h3 class="fw-semibold lh-base">Welcome to IELTS Mocks</h3>
                            <p class="mb-0 text-muted fw-medium">Your IELTS Mock Test Platform.</p>
                        </div>
                        <div>
                            <img src="{{asset('build/assets/images/media/media-72.png')}}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>
