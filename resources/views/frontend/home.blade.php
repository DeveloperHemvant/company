<x-guest-layout >
    @section('title', 'Home')

    @include('frontend/header')
    <section class="hero-banner flw">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ Vite::asset('resources/images/img01.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption">
                        <h1>PhD Admission
                            for Working Professionals
                            is Effortless with SamUniversity Institute</h1>
                        <p class="text-center">With over 14 years of expertise in the field, SamUniversity Institute
                            offers invaluable assistance, seamlessly guiding you from PhD admission to successfully
                            completing your doctorate while managing work commitments.
                        </p>
                        <p class="text-center">
                            <a href="{{route('phd-admission')}}" wire:navigate class="btn btn-danger mr-4">Explore courses</a>
                            <a href="tel:1111111111" class="btn btn-danger active"><i class="fa fa-whatsapp" aria-hidden="true"></i> Get Info</a>
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ Vite::asset('resources/images/img02.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption">
                        <h1>PhD Admission 2024
                            for Working Professionals
                            is Effortless with SamUniversity</h1>
                        <p class="text-center">With over 14 years of expertise in the field, SamUniversity offers
                            invaluable assistance, seamlessly guiding you from PhD admission 2024 to successfully
                            completing your doctorate while managing work commitments.
                        </p>
                        <p class="text-center">
                            <a href="phd-admission.html" class="btn btn-danger mr-4">Explore courses</a>
                            <a href="tel:1111111111" class="btn btn-danger active"><i class="fa fa-whatsapp" aria-hidden="true"></i> Get Info</a>
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ Vite::asset('resources/images/img03.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption">
                        <h1>PhD Admission 2024
                            for Working Professionals
                            is Effortless with SamUniversity</h1>
                        <p class="text-center">With over 14 years of expertise in the field, SamUniversity offers
                            invaluable assistance, seamlessly guiding you from PhD admission 2024 to successfully
                            completing your doctorate while managing work commitments.
                        </p>
                        <p class="text-center">
                            <a href="phd-admission.html" class="btn btn-danger mr-4">Explore courses</a>
                            <a href="tel:1111111111" class="btn btn-danger active"><i class="fa fa-whatsapp" aria-hidden="true"></i> Get Info</a>
                        </p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
        </div>
        


    </section>
    <section class="benefits flw">
        <div class="container">
            <div class="box-benefit">
                <h2>Why to choose SamUniversity Institute for your PhD Admission?</h2>
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/abot-img.png') }}" />
                        <a href="#exampleModal" data-toggle="modal" class="btn btn-outline-danger">Get Complete Details</a>
                    </div>
                    <div class="col-lg-6">
                        <ul>
                            <li>
                                <img class="img-fluid" src="{{ Vite::asset('resources/images/icon01.png') }}" />
                                <h5> UGC Approved Reputed Universities</h5>
                                <p>We offer consultancy for UGC-approved reputed universities with a reasonable fee </p>
                            </li>
                            <li>
                                <img class="img-fluid" src="{{ Vite::asset('resources/images/icon02.png') }}" />
                                <h5> PhD Admission available in all major streams</h5>
                                <p>All Major streams and Subjects Available</p>
                            </li>
                            <li>
                                <img class="img-fluid" src="{{ Vite::asset('resources/images/icon03.png') }}" />
                                <h5> Timely Completion Of PhD is Guaranteed</h5>
                                <p>One of the most rated feature is timely completion of your course</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <section class="our-courses flw"  id="our-courses">
        <div class="container">
            <h2>Our Courses</h2>
            <div class="row">
                <div class="col-lg-4">
                    <div class="box-content bg-green">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/c-icon-01.png') }}" />
                        <h5>Doctor of Philosophy</h5>
                        <p>Beginner level course with focus on basics and introduction to different scenarios in the programming world. Assignments and projects to have a better understanding of the concepts.</p>
                        <a href="phd-admission.html" class="btn btn-light">Read More</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box-content bg-yellow">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/c-icon-02.png') }}" />
                        <h5>Bachelor of Legislative Law</h5>
                        <p>Intermediate level course with more detailed study of concepts and real time assignments to help master the concepts</p>
                        <a href="llb.html" class="btn btn-light">Read More</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box-content bg-red">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/c-icon-03.png') }}" />
                        <h5>Diploma in Pharmacy</h5>
                        <p>Advanced level course with a detailed study of all the concepts, with professional and industry standard assignments and projects.</p>
                        <a href="pharmacy.html" class="btn btn-light">Read More</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box-content bg-yellow">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/phd.png') }}" />
                        <h5>Ph.D. Admission Process</h5>
                        <p>A Doctor of Philosophy (Ph.D.) is a doctorate degree conferred by Government and Private Universities in strict compliance with UGC norms, an apex body in India for regulating higher education.</p>
                        <a href="phd-admission.html" class="btn btn-light">Read More</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box-content bg-green">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/online-icon.png') }}" />
                        <h5>Online Courses</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Scelerisque mauris pellentesque pulvinar pellentesque habitant.</p>
                        <a href="online-courses.html" class="btn btn-light">Read More</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box-content bg-red">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/d-l.png') }}" />
                        <h5>Distance Learning</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Scelerisque mauris pellentesque pulvinar pellentesque habitant.</p>
                        <a href="distance-learning.html" class="btn btn-light">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <section class="kidslearn flw">
        <div class="container">
            <h2>Features and Services for PhD Admission</h2>
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <ul class="text-right">
                        <li>Entrance Exam Support <img class="img-fluid" src="{{ Vite::asset('resources/images/Group-2240.png') }}" /></li>
                        <li>Synopsis and Topic <img class="img-fluid" src="{{ Vite::asset('resources/images/Group-2241.png') }}" /></li>
                        <li>Assignment <img class="img-fluid" src="{{ Vite::asset('resources/images/Group-2242.png') }}" /></li>
                        <li>Thesis preparation <img class="img-fluid" src="{{ Vite::asset('resources/images/Group-2243.png') }}" /></li>
                    </ul>
                </div>
                <div class="col-lg-4 text-center">
                    <img class="img-fluid st-img" src="{{ Vite::asset('resources/images/1.png') }}" />
                </div>
                <div class="col-lg-4">
                    <ul class="text-left">
                        <li><img class="img-fluid" src="{{ Vite::asset('resources/images/Group-2244.png') }}" /> VIVA Preprations</li>
                        <li><img class="img-fluid" src="{{ Vite::asset('resources/images/Group-2245.png') }}" /> Guide Selection</li>
                        <li><img class="img-fluid" src="{{ Vite::asset('resources/images/Group-2246.png') }}" /> Coursework Preprations</li>
                        <li><img class="img-fluid" src="{{ Vite::asset('resources/images/Group-2247.png') }}" /> 6 Monthly Report</li>
                    </ul>
                </div>
                <div class="col-lg-12 text-center mt-4">
                    <a href="#" class="btn btn-outline-danger">Book free Video Session with Expert</a>
                </div>
            </div>
        </div>
        
    </section>
    <section class="juniorcode flw">
        <div class="container">
            <h2>Why Choose SamUniversity Institute</h2>
            <p class="text-center">At SamUniversity Institute, we pride ourselves on being the preferred choice for students seeking guidance in their academic pursuits.<br> Here are compelling reasons why you should choose us:</p>
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="junior-box">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/Group-2251.png') }}" />
                        <h5>Proven Expertise</h5>
                        <p>With over a decade of experience in education counselling, SamUniversity Institute stands as a symbol of reliability and trustworthiness. Our track record speaks volumes, showcasing our proficiency in assisting students in their journey towards prestigious universities.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="junior-box lr-bor">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/Group-2252.png') }}" />
                        <h5>High Success Rate</h5>
                        <p>We are rated as one of India's top education consultancies, with an impressive success rate in student admissions. Our systematic approach and personalized guidance have helped numerous students secure placements in renowned institutions, setting them on the path to success.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="junior-box">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/Group-2253.png') }}" />
                        <h5>Experienced Counsellors</h5>
                        <p>Our team comprises experienced and friendly counsellors who are dedicated to providing comprehensive support throughout the admission process. With their expertise and guidance, we ensure that each student receives personalized attention and assistance tailored to their unique needs and aspirations.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="junior-box">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/Group-2254.png') }}" />
                        <h5>Student-Centered Approach</h5>
                        <p>At SamUniversity Institute, we prioritize the needs and aspirations of our students above all else. Our student-centered approach ensures that every individual receives personalized guidance and support, empowering them to make informed decisions about their academic future.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="junior-box lr-bor">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/Group-2255.png') }}" />
                        <h5>Wide Range of Options</h5>
                        <p>We offer a diverse range of educational options, providing students with numerous choices to explore and pursue their academic interests. Whether it's selecting the right course or identifying the most suitable institution, we offer comprehensive assistance to help students make the best choices for their future.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="junior-box">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/Group-2256.png') }}" />
                        <h5>Trusted Partner</h5>
                        <p>SamUniversity Institute is a trusted partner for students who rely on our expertise and guidance to navigate the complexities of the education system. Our commitment to excellence and dedication to student success make us the ideal choice for those seeking reliable and effective educational counseling services.</p>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <section class="meetour flw">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-right">
                    <img class="img-fluid" src="{{ Vite::asset('resources/images/Group-2082.png') }}" />
                </div>
                <div class="col-lg-6">
                    <h3>Meet our SamUniversity Institute<span class="line"></span></h3>
                    <p>SamUniversity Institute is an educational consultancy dedicated to guiding students towards finding the most suitable courses and institutions. Our primary objective is to ensure that every individual receives quality education and becomes well-qualified. Renowned for our commitment to excellence, we offer a wide range of educational options to ambitious students, empowering them to pursue their academic goals effectively.</p>
                    <p><a href="#" class="btn btn-outline-danger mt-2">Enroll Now</a></p>
                </div>
            </div>
        </div>
        
    </section>
    <!-- start count stats -->

    <section id="counter-stats" class="flw">
        <div class="container wow fadeInRight" data-wow-duration="1.4s">
            <div class="row">
                <div class="col-lg-3 stats">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <div class="counting" data-count="90">0</div>
                    <h5>Teachers</h5>
                </div>
                <div class="col-lg-3 stats">
                    <i class="fa fa-building" aria-hidden="true"></i>
                    <div class="counting" data-count="70">0</div>
                    <h5>Universities</h5>
                </div>
                <div class="col-lg-3 stats">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <div class="counting" data-count="240">0</div>
                    <h5>Students</h5>
                </div>
                <div class="col-lg-3 stats">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <div class="counting" data-count="25">0 year</div>
                    <h5>SUCCESSFUL CAREERS</h5>
                </div>
            </div>
            <!-- end row -->
        </div>
        
        <!-- end container -->

    </section>

    <!-- end cont stats -->


    <section class="contactus  flw">
        <div class="container">
            <h2>FAQ’s on PhD SamUniversity Institute</h2>
            <div class="box">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cliente1">
                            <div class="accordion custom-accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Is Master's Compulsory for PhD Admission?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            Yes. A master’s degree with 50% marks is to be completed with the intention of
                                            pursuing a PhD. However, it is highly recommended that you have a master’s degree
                                            before applying for a PhD (Doctor of Philosophy) because it will give you an edge
                                            over other applicants. <a href="{{route('blogsingle')}}">Read more</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo">
                                                What to do in Master's if further goal is PhD?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            Some placeholder content for the second accordion panel. This panel is hidden by
                                            default. <a href="{{route('blogsingle')}}">Read more</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                                aria-controls="collapseThree">
                                                How to apply for PhD Admission?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            And lastly, the placeholder content for the third and final accordion panel. This
                                            panel is hidden by default. <a href="{{route('blogsingle')}}">Read more</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add more accordion items as needed -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    @include('frontend/footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.counting');
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-count');
                const count = +counter.innerText;
                const speed = 200; // Adjust the speed of counting
    
                const increment = target / speed;
    
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 1);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    });
    </script>
    
    
</x-guest-layout>
