<nav class="navbar navbar-expand-lg bg-white sticky-top shadow">
    <div class="container-fluid">
        <div class="only-mob d-lg-none">
            <a href="#navbarResponsive" data-toggle="collapse" class="logo1">
                <img src="{{ Vite::asset('resources/images/ic_menu_white.png') }}" alt="">
                {{-- <img src="{{ Vite::image('ic_menu_white.png') }}" alt="Laravel Logo"> --}}
            </a>
            <a href="#" class="logo2">
                <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="">
            </a>
            <a class="btn btn-primary" href="https://pages.razorpay.com/pl_G0F4TpbOwyRL46/view" target="_blank">
                <i class="fa fa-inr" aria-hidden="true"></i> Pay Now
            </a>
            <a class="btn btn-success" href="tel:+91 1111111111">
                <i class="fa fa-whatsapp" aria-hidden="true"></i>
            </a>
        </div>
        <a class="navbar-brand d-none d-lg-block" href="{{route('home')}}">
            <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="">
        </a>
        <button class="navbar-toggler d-none d-lg-block" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <a href="#navbarResponsive" class="closebtn" data-toggle="collapse">&times;</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" wire:navigate href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" wire:navigate href="{{ route('about') }}">About Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Courses</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" wire:navigate href="{{route('campus-admission')}}">On Campus Admission</a></li>
                        <li><a class="dropdown-item" wire:navigate href="{{route('online-courses')}}">Online Courses</a></li>
                        <li><a class="dropdown-item" wire:navigate href="{{route('distance-learning')}}">Distance Learning</a></li>
                        <li><a class="dropdown-item" wire:navigate href="{{route('phd-admission')}}">PH.D Admission</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" wire:navigate href="{{ route('career') }}">Career</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"wire:navigate href="{{ route('contact') }}">Contact Us</a>
                </li>
                <li class="nav-item mob-none d-none">
                    <a class="btn btn-success" href="tel:+91 1111111111">
                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="nav-item mob-none">
                    <a class="btn btn-primary" target="_blank" href="https://pages.razorpay.com/pl_G0F4TpbOwyRL46/view">
                        <i class="fa fa-inr" aria-hidden="true"></i> Pay Now
                    </a>
                </li>
                <div class="call-now-button">
                    <div>
                        <a href="tel:1111111111" title="Call Now">
                            <p class="call-text">+91 1111111111</p>
                            <div class="quick-alo-ph-circle active"></div>
                            <div class="quick-alo-ph-circle-fill active"></div>
                            <div class="quick-alo-phone-img-circle shake"></div>
                        </a>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</nav>
