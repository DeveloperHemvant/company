<footer class="flw footer-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="ab-fot">
                    <a href="index.html">
                        <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="">
                        </a>

                    <ul class="socialIcon">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
                        <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a> </li>
                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a> </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3">
                <h4>Research Work Assistance </h4>
                <ul class="f-m">
                    <li><a wire:navigate href="{{route('thesis-writing')}}">Thesis Writing</a></li>
                    <li><a wire:navigate href="{{route('proof-reading')}}">Proof Reading & Editing</a></li>
                    <li><a wire:navigate href="{{route('plagrim')}}">Plagiarism Check & Removal </a></li>
                    <li><a wire:navigate href="{{route('journal')}}">Journal Paper Writing</a></li>

                </ul>
            </div>
            <div class="col-lg-3">
                <h4>Quick Links</h4>
                <ul class="f-m">
                    <li><a wire:navigate  href="{{route('about')}}">About Us</a></li>
                    <li><a  wire:navigate href="{{route('blog')}}">Blog</a></li>
                    <li><a wire:navigate  href="{{route('terms')}}">Terms and Conditions</a></li>                                                                                                                                  
                    <li><a  wire:navigate href="{{route('privacypolicy')}}">Privacy Policy</a></li>
                    <li><a  wire:navigate href="{{route('refund')}}">Refund Policy</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h4>Get In Touch</h4>
                <ul class="f-m">
                    <li>SamUBSUniversity</li>
                    <li><a href="tel:1111111111">+ 91 1111111111</a></li>
                    <li><a href="mailto:info@SamUniversityedu.com">info@SamUniversityedu.com</a></li>

                </ul>
            </div>
        </div>

    </div>
    <section class="foot_bottombg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p> Copyright © 2024-2025 SamUniversity Institute - Education Consultancy
                    </p>
                </div>
            </div>
        </div>
    </section>
</footer>

<nav class="social">
    <ul>
        <li><a href="https://wa.me/+911111111111" target="_blank"><i class="fa fa-whatsapp"></i>whatsapp </a>
        </li>
        <li><a href="tel:+911111111111"> <i class="fa fa-phone"></i>Call Now</a></li>

    </ul>
</nav>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Book Demo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @livewire('frontend.form')
            </div>
        </div>
    </div>
</div>