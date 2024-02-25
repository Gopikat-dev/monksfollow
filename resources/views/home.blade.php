
<x-layout>

    <!-- START -->
    <div class="account-pages">
        <div class="container">
            <div class="row g-0 bg-white align-items-center">
                <div class="col-lg-6 mx-auto align-items-center justify-content-center">
                    <div class="auth-box">
                        <div class="mb-4 mb-md-5 text-center">
                            <a href="javascript:void(0);" class="auth-logo">
                                <img src="/images/logo.jpeg" height="75" alt="">
                            </a>
                        </div>

                        <div class="auth-content">
                            <div class="mb-3 pb-3 text-center">
                                <h4 class="fw-normal">Welcome to <span class="fw-bold">Monks Follow lastest</span></h4>
                                <p class="text-muted mb-0">Enter your Email/Phone Number to receive Sign in OTP</p>
                            </div>
                            <form action="/register" method="POST">
                                @csrf
                               <div class="form-floating form-floating-custom mb-3">
    <input type="text" name="identifier" class="form-control" id="input-username" placeholder="Enter Email/Phone Number" required>
    @error('identifier') <!-- Use 'identifier' instead of 'email' -->
    <p class="m-0 small alert alert-danger shadow-sm">{{$message}} </p>
    @enderror
    <label for="email">Email/Phone Number</label> <!-- Consider changing 'for' attribute value to match the input id -->
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
    