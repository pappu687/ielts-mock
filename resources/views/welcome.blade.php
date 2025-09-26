<x-frontend-layout>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 my-auto">
                <div
                    class="d-inline-flex align-items-center gap-2 text-default badge bg-white border fs-13 rounded-pill">

                </div>
                <h1 class="fw-semibold mt-3 landing-banner-heading">Welcome to <br> IELTS Prep Mock</span>
                    <div class="btn-list banner-buttons mt-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg rounded-pill btn-w-lg">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded-pill btn-w-lg">Login</a>
                    @endauth
                        <a class="btn btn-lg btn-light border rounded-pill btn-w-lg" href="javascript:void(0);">Visit
                            Tests</a>
                    </div>
            </div>
            <div class="col-xl-6">
                <div class="banner-main-img text-end d-xl-block d-none">
                    <img src="../assets/images/media/backgrounds/7.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>