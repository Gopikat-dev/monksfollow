
<x-layout>
<!-- START -->
    <div class="account-pages">
        <div class="container">
            <div class="row g-0 bg-white align-items-center">
<div class="col-lg-6 mx-auto align-items-center justify-content-center">
                    <div class="auth-box">
                        <div class="mb-4 mb-md-5 text-center">
                            <a href="javascript:void(0);" class="auth-logo">
                                <img src="images/logo.jpeg" height="75" alt="">
                            </a>
                        </div>

                        <!-- otp response -->

<p class="alert text-center" id="otp-response-message">
</p>
<!-- otp resent message -->
                         @if(isset($resentMessage))
    <p class="alert alert-success text-center" id="resentMessage">{{ $resentMessage }}</p>
@endif

                        <div class="auth-content">
                             <form id="otpForm">
                              @csrf
                            <div class="text-center mb-4">
                                <h4>Verify Your Email/Phone Number</h4>
                               <p class="text-muted">Please enter the 4 digit OTP sent to 
    <span class="fw-semibold">
        {{ session('email') ?? session('mobile_number') }}
    </span>
</p>




                                
                            </div>
                            {{-- @if($errors->any())
    <div class="alert alert-danger text-center" >
        {{ $errors->first('otp') }}
    </div>
@endif --}}



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
    <p  id="timerContainer" class="mb-0 text-muted">Resend OTP in <span class="fw-bold" id="time"></span></p>
    <form method="POST" action="/register">
        @csrf        
        <button id="resendButton" class="btn fw-bold text-decoration-underline ms-1" type="submit" name="resend" hidden >Resend OTP</button>
     
    </form>
</div>
</div><!-- auth content -->
</div><!-- end authbox -->
</div><!-- end col -->
</div><!-- end row -->
</div><!-- end container -->
</div><!-- END -->
</x-layout>
