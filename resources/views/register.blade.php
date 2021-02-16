@include('templates.header')
<!-- HOME START-->
<section class="bg-pages" data-jarallax='{"speed": 0.5}' style="background-image:url({{ asset('web/images/cover_image.jpg') }})">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container page-next-level">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="text-sm-left">
                            <h5 class="title-pager text-uppercase mb-0"> REGISTER </h5>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container--> 
        </div>
    </div>
</section> 
<!-- HOME END--> 

<!-- Faq Start -->
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-8 mt-sm-30">
                <div class="login_page bg-white rounded p-4">
                     <form method="POST" action="/register">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Username<span class="text-danger">*</span></label>
                                     <input id="customer_name" type="text" class="form-control{{ $errors->has('customer_name') ? ' is-invalid' : '' }}" name="customer_name" value="{{ old('customer_name') }}" placeholder="Username" required autofocus>

                                    @error('customer_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone" required autocomplete="email">
                                    
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Email<span class="text-danger">*</span></label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-lg-12 mb-0">
                                <button type="submit" class="btn btn-custom w-100">Register</button>
                            </div>
                            <div class="col-12 text-center">
                                <p class="mb-0"><small class="text-dark mr-2">Already have an account ?</small> <a href="/login" class="text-dark font-weight-bold">Login</a></p>
                            </div>
                        </div>
                    </form>
                </div><!---->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- Faq End -->
@include('templates.footer')