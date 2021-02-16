@include('templates.header')
<!-- FORGET PASSWORD START -->  
<style>
    input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type="number"] {
    -moz-appearance: textfield;
}
</style>  
<section class="bg-home bg-userpage" data-jarallax='{"speed": 0.5}' style="background-image:url('images/home/login.jpg')">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7">
                        <div class="login_page bg-white rounded p-4">
                            <div class="text-center">
                                <a href="index.html"><img src="images/logo.png" height="20" alt=""></a>
                                <h6 class="text-uppercase mt-3 mb-4">Reset Password</h6>  
                            </div>
                            <form class="login-form" name="reset_form" method="post" action="/reset_password">
                                 @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="text-muted">Please enter your new password.</p>
                                        <div class="form-group">
                                             <label>New Password <span class="text-danger">*</span></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                                     <label>Confirm New Password <span class="text-danger">*</span></label>
                                    <input id="con_password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="con_password" required autocomplete="new-password">
                                    <input id="customer_id" name="customer_id"  type="hidden" value="{{$id}}">
                                    


                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-custom w-100" onclick="show_alert()">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section><!--end section-->
        <!-- FORGET PASSWORD END -->
        

@include('templates.footer')
<script>
    function show_alert() {
        
        var np = $('#password').val();
        var cp = $('#con_password').val();

        //alert(num)
        if(np == cp){
            
            $('#otp_form').submit()
        }
        else{
            alert("fail")
        }
    }
</script>





