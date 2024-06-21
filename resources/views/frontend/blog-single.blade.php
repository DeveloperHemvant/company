<x-guest-layout>
    @section('title', 'Single Blog')
    @include('frontend/header')
    <section class="inner-header flw">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-9">
                        <h1>Panel Discussion</h1>
                        <p>Dr Saroj Kumar Dutta- The Director General of Accurate</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="flw single-post-content section90">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="single-post">
                        <div class="post-meta">
                            <span class="date">Accurate Group </span>
                            <span class="mx-1">•</span>
                            <span>March 22, 2018 </span>
                        </div>
                        <h1 class="mb-5">13 Amazing Poems from Shel Silverstein with Valuable Life Lessons</h1>
                        <p><span class="firstcharacter">L</span>orem ipsum dolor sit, amet consectetur adipisicing elit.
                            Ratione officia sed, suscipit distinctio, numquam omnis quo fuga ipsam quis inventore
                            voluptatum recusandae culpa, unde doloribus saepe labore alias voluptate expedita? Dicta
                            delectus beatae explicabo odio voluptatibus quas, saepe qui aperiam autem obcaecati, illo
                            et! Incidunt voluptas culpa neque repellat sint, accusamus beatae, cumque autem tempore
                            quisquam quam eligendi harum debitis.</p>
                            <figure class="my-4">
                                <img src="https://www.jagranjosh.com/imported/images/E/Articles/Shekar-suman-Jagranjosh-Event-Body-Image.jpg"
                                    alt="" class="img-fluid">
                                <figcaption>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo, odit?
                                </figcaption>
                            </figure>
                        <p>Sunt reprehenderit, hic vel optio odit est dolore, distinctio iure itaque enim pariatur
                            ducimus. Rerum soluta, perspiciatis voluptatum cupiditate praesentium repellendus quas
                            expedita exercitationem tempora aliquam quaerat in eligendi adipisci harum non omnis
                            reprehenderit quidem beatae modi. Ea fugiat enim libero, ipsam dicta explicabo nihil,
                            tempore, nulla repellendus eos necessitatibus eligendi corporis cum? Eaque harum, eligendi
                            itaque numquam aliquam soluta.</p>
                        <p>Explicabo perspiciatis, laborum provident voluptates illum in nulla consectetur atque quaerat
                            excepturi quisquam, veniam velit ex pariatur quos consequuntur? Excepturi reiciendis
                            perferendis, cupiditate dolorem eos illum amet. Beatae voluptates nemo esse ratione
                            voluptate, nesciunt fugit magnam veritatis voluptas dignissimos doloribus maiores? Aliquam,
                            dolores natus exercitationem corrupti blanditiis, consequuntur nihil nobis sed voluptatibus
                            maiores sunt, illo provident aliquid laborum. Vitae, ut.</p>
                    </div>

                    <div class="comments">
                        <h5 class="comment-title py-4">2 Comments</h5>
                        <!-- Comments section (omitted for brevity) -->
                    </div>

                    <div class="row justify-content-center mt-5">
                        <div class="col-lg-12">
                            <h5 class="comment-title">Leave a Comment</h5>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="comment-name">Name</label>
                                    <input type="text" class="form-control" id="comment-name" placeholder="Enter your name">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="comment-email">Email</label>
                                    <input type="text" class="form-control" id="comment-email" placeholder="Enter your email">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="comment-message">Message</label>
                                    <textarea class="form-control" id="comment-message" placeholder="Enter your message" cols="30" rows="10"></textarea>
                                </div>
                                <div class="col-12">
                                    <input type="submit" class="btn btn-primary" value="Post comment">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <!-- Sidebar content (omitted for brevity) -->
                    <div class="aside-block">
                        <h3 class="aside-title">Quick Links</h3>
                        <ul class="aside-links list-unstyled">
                            <li><a href="category.html"><i class="fa fa-chevron-right"></i> Business</a></li>
                            <li><a href="category.html"><i class="fa fa-chevron-right"></i> Culture</a></li>
                            <li><a href="category.html"><i class="fa fa-chevron-right"></i> Sport</a></li>
                            <li><a href="category.html"><i class="fa fa-chevron-right"></i> Food</a></li>
                            <li><a href="category.html"><i class="fa fa-chevron-right"></i> Politics</a></li>
                            <li><a href="category.html"><i class="fa fa-chevron-right"></i> Celebrity</a></li>
                            <li><a href="category.html"><i class="fa fa-chevron-right"></i> Startups</a></li>
                            <li><a href="category.html"><i class="fa fa-chevron-right"></i> Travel</a></li>
                        </ul>
                    </div>
                    <!-- Other sidebar blocks (omitted for brevity) -->
                </div>
            </div>

            <div class="album py-5">
                <div class="container">
                    <h1 class="mb-5 d-none">Recent View</h1>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="{{ Vite::asset('resources/images/post-landscape-6.jpg') }}" alt="" class="img-fluid">
                                <div class="card-body">
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. This content is a little bit longer.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        </div>
                                        <small class="text-muted">9 mins</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="{{ Vite::asset('resources/images/post-landscape-3.jpg') }}" alt="" class="img-fluid">
                                <div class="card-body">
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. This content is a little bit longer.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        </div>
                                        <small class="text-muted">9 mins</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="{{ Vite::asset('resources/images/post-landscape-5.jpg') }}" alt="" class="img-fluid">
                                <div class="card-body">
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. This content is a little bit longer.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        </div>
                                        <small class="text-muted">9 mins</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend/footer')
</x-guest-layout>
