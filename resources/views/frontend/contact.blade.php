<x-guest-layout>
    @section('title', 'Contact Us')
    @include('frontend/header')
    <section class="inner-header flw">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="col-lg-9">
                        <h1>Contact Us</h1>
                        <p>Submit your details for more information</p>

                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="flw page-section contact-page home-contact bg-white  section90">
        <div class="container">


            <div class="row mt-4">


                <div class="col-lg-5">
                    @livewire('frontend.form')
                </div>
                <div class="col-lg-7">
                    <div class="map-responsive">

                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d58648.194614861466!2d77.5189002!3d23.2608328!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x397c402f8f35c133%3A0x5658f19741264f8f!2sSAM%20GLOBAL%20UNIVERSITY%20%7C%20Best%20University%20in%20Bhopal%20%7C%20Top%20University%20in%20Bhopal%20%7C%20MP!5e0!3m2!1sen!2sin!4v1696843259217!5m2!1sen!2sin"
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                    <div class="row text-center">
                        <div class="col-md-4">
                            <a class="accent-1"><i class="fa fa-map-marker"></i></a>
                            <p>SamUBSUniversity </p>

                        </div>

                        <div class="col-md-4">
                            <a class="accent-1"><i class="fa fa-phone"></i></a>
                            <p>+ 91 1111111111</p>

                        </div>

                        <div class="col-md-4">
                            <a class="accent-1"><i class="fa fa-envelope-o"></i></a>
                            <p>info@SamUniversityedu.com</p>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @include('frontend/footer')

</x-guest-layout>
