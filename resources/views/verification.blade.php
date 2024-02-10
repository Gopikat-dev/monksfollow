@guest
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
                                <img src="images/logo.jpeg" height="75" alt="">
                            </a>
                        </div>

                        <div class="auth-content">
                             <form id="otpForm">
                              @csrf
                            <div class="text-center mb-4">
                                <h4>Verify Your Email</h4>
                                <p class="text-muted">Please enter the 4 digit code sent to <span class="fw-semibold">{{ session('email') }}</span></p>
                                
                            </div>
                            {{-- @if($errors->any())
    <div class="alert alert-danger text-center" >
        {{ $errors->first('otp') }}
    </div>
@endif --}}

<p class="alert text-center" id="otp-response-message">

</p>

                            <div class="form">
                                <div class="row">
    <div class="col-3">
        <div class="mb-3">
            <label for="digit1-input" class="visually-hidden">Digit 1</label>
            <input type="text" name="digit1" class="form-control form-control-lg text-center otp-input"
                onkeyup="moveToNext(this, 1)" maxlength="1" id="digit1-input" autofocus required>
        </div>
    </div><!-- end col -->

    <div class="col-3">
        <div class="mb-3">
            <label for="digit2-input" class="visually-hidden">Digit 2</label> 
            <input type="text" name="digit2" class="form-control form-control-lg text-center otp-input"
                onkeyup="moveToNext(this, 2)" maxlength="1" id="digit2-input" required>
        </div>
    </div><!-- end col -->

    <div class="col-3">
        <div class="mb-3">
            <label for="digit3-input" class="visually-hidden">Digit 3</label>
            <input type="text" name="digit3" class="form-control form-control-lg text-center otp-input"
                onkeyup="moveToNext(this, 3)" maxlength="1" id="digit3-input" required>
        </div>
    </div><!-- end col -->

    <div class="col-3">
        <div class="mb-3">
            <label for="digit4-input" class="visually-hidden">Digit 4</label>
            <input type="text" name="digit4" class="form-control form-control-lg text-center otp-input"
                onkeyup="moveToNext(this, 4)" maxlength="1" id="digit4-input" required>
        </div>
    </div><!-- end col -->
</div><!-- end row -->
<div id="otp-spinner-container" class="text-center">
    <div class="spinner-border text-success" role="status">
        <span class="sr-only"></span>
    </div>
</div>



                                {{-- <div class="mt-3">
                                    <button class="btn btn-dark shadow-none w-100" type="submit">Confirm</button>
                                </div> --}}
                                <hr>          
                            
                            </div><!-- end form -->    
                            </form>
                             <div class="mt-3 text-center">
    <p  id="timerContainer" class="mb-0 text-muted">Didn't receive a code? Resend in <span class="fw-bold" id="time"></span></p>
    <form method="POST" action="/register">
        @csrf
        <button id="resendButton" class="btn fw-bold text-decoration-underline ms-1" type="submit" hidden >Resend</button>
    </form>
</div>
</div><!-- auth content -->
</div><!-- end authbox -->
</div><!-- end col -->
</div><!-- end row -->
</div><!-- end container -->
</div><!-- END -->
</x-layout>
@endguest