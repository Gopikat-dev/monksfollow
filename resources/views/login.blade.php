<x-layout>

    <!-- START -->
    <div class="account-pages">
        <div class="container">
            <div class="row g-0 bg-white align-items-center">

                <div class="col-lg-6">
                    <div class="bg-login">
                        <img src="/images/bg-login-1.png" class="img-fluid" alt="">
                        <div class="auth-contain">
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="0" class="active" aria-current="true"
                                        aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="text-center text-white my-4 p-4">
                                            <h3>Monks Follow</h3>
                                            <p class="text-white-50 f-20 mt-3">Best Billing Software in the Industry</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="text-center text-white my-4 p-4">
                                            <h3>Monks Follow</h3>
                                            <p class="text-white-50 f-20 mt-3">No matter what experience you have.We
                                                will help you start
                                                in minutes.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="text-center text-white my-4 p-4">
                                            <h3>Monks Follow</h3>
                                            <p class="text-white-50 f-20 mt-3">No matter what experience you have.We
                                                will help you start
                                                in minutes.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- end -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-lg-6">
                    <div class="auth-box">
                        <div class="mb-4 mb-md-5 text-center">
                            <a href="javascript:void(0);" class="auth-logo">
                                <img src="/images/logo.jpeg" height="75" alt="">
                            </a>
                        </div>

                        <div class="auth-content">
                            <div class="mb-3 pb-3 text-center">
                                <h4 class="fw-normal">Welcome to <span class="fw-bold">Monks Follow</span></h4>
                                <p class="text-muted mb-0">Sign in to continue to Monks Follow.</p>
                            </div>
                            <form action="/register" method="POST">
                                @csrf
                                <div class="form-floating form-floating-custom mb-3">
                                    <input type="text" name="email" class="form-control" id="input-username"
                                        placeholder="Enter Email">
                                    <label for="email">Email/Phone Number</label>
                                </div>
                                <div class="form-floating form-floating-custom mb-3">
                                    <input type="text" name="email" class="form-control" id="input-username"
                                        placeholder="Enter Email">
                                    <label for="email">Test</label>
                                </div>
                      
                                <div class="mt-3">
                                    <button class="btn btn-dark shadow-none w-100" type="submit">Send OTP</button>
                                </div>
                                <hr>
                               
                            </form><!-- end form -->
                            
                        </div><!-- auth content -->
                    </div>
                    <!-- end authbox -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- END -->

    </x-layout>