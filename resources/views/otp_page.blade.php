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
                                <h6 class="text-uppercase mt-3 mb-4">Enter OTP</h6>  
                            </div>
                            <form class="login-form" id="otp_form" method="post" action="/reset">
                                 @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="text-muted">Please enter received One time Password.</p>
                                        <div class="form-group">
                                             <label>OTP <span class="text-danger">*</span></label>
                                                <input id="otp" type="numeric" maxlength="4" class="form-control" name="otp_no"  placeholder="OTP">
                                                <input id="otp_id" type="hidden" value={{$otp}}>
                                                <input id="customer_id" name="customer_id"  type="hidden" value={{$id}}>

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="button" class="btn btn-custom w-100" onclick="show_alert()">Send</button>
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
        
        var num = $('#otp').val();
        var data = $('#otp_id').val();

        //alert(num)
        if(num == data){
           // alert("success")
            $('#otp_form').submit()
        }
        else{
            alert("Invalid OTP")
        }
    }
</script>




