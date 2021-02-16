@include('templates.header')
<section class="bg-pages" data-jarallax='{"speed": 0.5}' style="background-image:url({{ asset('web/images/cover_image.jpg') }})">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container page-next-level">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="text-sm-left">
                            <h5 class="title-pager text-uppercase mb-0">  </h5>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container--> 
        </div>
    </div>
</section>
    <section>
      <div class="container">
        <div class="row" style="margin-top:10%; margin-bottom:10%">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
            <p class="lead text-left" >Enter the Postcode to check the service available in your location</p>
             <div class="form-group">
            <input class="form-control map-input" id="pin_code" name="pin_code" autocomplete="off" type="text" placeholder="Postcode" />
             </div>
              <div class="row" style="padding:10px;">
        <div style="color:white;" class="col-md-12 text-right">
            <a id="address_next" onclick="check_pincode();" class="btn btn-custom">Check Postcode</a>
        </div>
        </div>
          </div>
        </div>
      </div>
    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    </section>
@include('templates.footer')
<script>
    function check_pincode(){
 var pin_code = $("#pin_code").val();
 
 if(pin_code != ''){
    // alert(pickupdate);
    $.ajax({
      url: '/check_pincode',
      type: 'POST',
      data: {
          _token: "{{ csrf_token() }}", 
          pin_code:pin_code 
      },
      success: function (data) { 
        if(data == 1){
            window.location ="/profile/address";
        }else{
            alert('Service not available in this location')
        }
      }
  });
}else{
    alert("Please enter postcode");
}
}
</script>
