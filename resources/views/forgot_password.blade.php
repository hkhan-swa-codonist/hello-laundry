@include('templates.header')
<!-- HOME START-->
<section class="bg-pages" data-jarallax='{"speed": 0.5}' style="background-image:url({{ asset('web/images/cover_image.jpg') }})">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container page-next-level">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="text-sm-left">
                            <h5 class="title-pager text-uppercase mb-0"> FORGOT PASSWORD </h5>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container--> 
        </div>
    </div>
</section> 
<!-- HOME END--> 
<!-- FORGET PASSWORD START -->    
<section class="section">
    <div class="container">
        <div class="row align-items-center">
                    <div class="col-lg-8 col-md-8">
                        <div class="login_page bg-white rounded p-4">
                            <div class="text-center">
                                <a href="index.html"><img src="images/logo.png" height="20" alt=""></a>
                                <h6 class="text-uppercase mt-3 mb-4">Recover Account</h6>  
                            </div>
                            <form class="login-form" method="post" action="/forgot_password">
                                 @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="text-muted">Please enter your Email. You will receive One time Password.</p>
                                        <div class="form-group">
                                             <label>Email <span class="text-danger">*</span></label>
                                             <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email">
                                             @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-custom w-100">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
</section><!--end section-->
        <!-- FORGET PASSWORD END -->
@include('templates.footer')

