@include('templates.header')
<!-- HOME START-->
<section class="bg-pages" data-jarallax='{"speed": 0.5}' style="background-image:url({{ asset('web/images/cover_image.jpg') }})">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container page-next-level">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="text-sm-left">
                            <h5 class="title-pager mb-0"> Login Or SignUp </h5>
                            <p class="mb-0 text-white" > Prices of items for Dry cleaning or laundry services </p>
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
         <h5 class="title-pager mb-0 " style="margin-left:25px"> Login to order items for cleaning delivered to your door </h5>
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-8 mt-sm-30">
                <div class="login_page bg-white rounded p-4">
                    @if(@$message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @endif
                    <form class="login-form" method="post" action="login" >
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Email address <span class="text-danger">*</span></label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>$errors->first('email')</strong>
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
                                            <strong>$errors->first('password')</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-lg-12 mb-0">
                                <button type="submit" class="btn btn-custom w-100">Sign in</button>
                            </div>
                            <div class="col-12 text-center">
                                <p class="mb-0 mt-3"><a href="/forgot_password" class="text-dark font-weight-bold">Forgot your password ?</a></p>
                                <p class="mb-0"><small class="text-dark mr-2">Don't have an account ?</small> <a href="/register" class="text-dark font-weight-bold">Sign Up</a></p>
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