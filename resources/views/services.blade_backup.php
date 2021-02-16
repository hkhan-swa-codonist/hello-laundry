@include('templates.header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
     input.largerCheckbox { 
            width: 30px; 
            height: 30px; 
        } 
    .active-date-time{
        color:white !important; 
        margin:5px !important;
    }

    .inactive-date-time{
        color:#115e7a !important;
        background-color:white !important;
        border-color:#115e7a !important;
        margin:5px !important;
        font-weight: bold !important;
    }

    .parent {
      position: relative;
  }

  .child {
      position: absolute;
      left: 50%;
      top: 50%;
      margin-left: -60px;
      margin-top: -60px;
  }

  /* Style the tab */
  .tab {
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
  }

  /* Style the buttons inside the tab */
  .tab button {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
      font-size: 17px;
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
      background-color: #ddd;
  }

  /* Create an active/current tablink class */
  .tab button.active {
      background-color: #ccc;
  }

  /* Style the tab content */
  .tabcontent {
      display: none;
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-top: none;
  }
</style>
<!-- HOME START-->
<section class="bg-pages" data-jarallax='{"speed": 0.5}' style="background-image:url({{ asset('web/images/cover_image.jpg') }})">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container page-next-level">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="text-sm-left">
                            <h5 class="title-pager text-uppercase mb-0"> Ordering </h5>
                            <!-- <p class="mb-0 text-white" > Select items to Dry cleaning or laundry services </p> -->
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container--> 
        </div>
    </div>
</section>
<!-- HOME END--> 
<style>
    .services .service-four {
    padding: 1%;
    height: 235px;
    border-radius: 10px;
}
.list-group-item {
   
     border:none; 
}
.p-10{
    padding:10px!important;
}
</style>
<!-- Services Start -->
<section class="section pb-less-30 services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 mb-4 pb-2">
            <div class="card shadow p-3 bg-white rounded" style="border-radius:10px!important;">
  <div class="card-body">
    <p>
   Please select the service you  need. We will weigh or count the items you give us. We will prepare the invoice after we receive your items, you can check our price list or use our price estimator anytime. our minimum order is $20.00</p>
  </div>
</div>
</div>
        </div>
        <div class="row">
             @php
                    $cart_data = Session::get('cart', []);
                @endphp
            @foreach($data as $key => $value)
            @php
                {{ $image = env('IMG_URL').$value->image; }}
            @endphp
            <?php
                if($value['is_category'] == 1){
                    $function_call = "check_category($value->id);";
                }else{
                    $function_call = "add_to_cart($value->id);";
                   
                }
            ?>
            <div class="col-lg-6 col-md-6 col-12 mb-4 pb-2">
                <div class="service-four text-center shadow">
                    <div class="icon-interior mb-4">
                        <img src="{{ $image }}" class="img-fluid mx-auto d-block" alt="">
                    </div>
                    <div class="content">
                        <h4 class="title text-uppercase">{{ $value->service_name }}</h4>
                        <p class="text-muted">{{ $value->description }}</p>
                      @if($value->is_category == 1)
                          @if(@$cart_data[$value->id])
                            <a style="color:#FF0000" id="bt_{{$value->id}}"  onclick="check_category({{$value->id}})"> Remove From Cart</i></a>
                        @else
                            <a style="color:#064ea3" id="bt_{{$value->id}}"  onclick="check_category({{$value->id}})"> Add To Cart</i></a>
                        @endif
                        @else
                         @if(@$cart_data[$value->id])
                            <a style="color:#FF0000" id="bt_{{$value->id}}" onclick="{{$function_call}}"> Remove From Cart</i></a>
                        @else
                            <a style="color:#064ea3" id="bt_{{$value->id}}" onclick="{{$function_call}}"> Add To Cart</i></a>
                        @endif
                        @endif
                    </div>
                </div>
            </div><!--end col-->
             @endforeach
        </div><!--end row-->
       
        <div class="row p-10">
            <div class="form-group">
              <label for="exampleFormControlTextarea2">Any Other Request?</label>
               <div id="modal_detail">
        </div>
              <textarea class="form-control rounded-0" id="any_other_request" name="any_other_request" rows="3" placeholder="Type your request here"></textarea>
            </div>
        </div>
       

        <div class="tab">
          <button class="tablinks" id="tab_title_address" onclick="selectTab(event, 'tab_address')">Address</button>
          <button class="tablinks" id="tab_title_pickup_date" onclick="selectTab(event, 'tab_pickup_date')">Pickup date & Time</button>
          <button class="tablinks" id="tab_title_delivery_date" onclick="selectTab(event, 'tab_delivery_date')">Delivery date & Time</button>
          <!-- <button class="tablinks" id="tab_title_payment" onclick="selectTab(event, 'tab_payment')">Payment</button> -->
      </div>

      <div id="tab_address" class="tabcontent">
        <div class="row" style="padding:10px;">
            <div class="col-md-4">
                <a style="color:white;" id="pickup_address_btn" class="btn btn-custom" data-toggle="modal" onclick="current_address('address');"  data-target="#address_model">Select Address</a>
                <input type="hidden" name="address" id="address" value="" />
                <div style="height:10px;"></div>
                <p id="address_text"></p>
            </div>
            <div class="col-md-4">
                <input type="hidden" name="current_address" id="current_address" value="" />
                <input type="hidden" name="amount" id="amount" value="20" />
            </div>
        </div>
        <div class="row" style="padding:10px;">
            <div style="color:white;" class="col-md-12 text-right">
                <a id="address_next" onclick="address_next();" class="btn btn-custom">Next</a>
            </div>
        </div>
    </div>
    <div id="tab_pickup_date" class="tabcontent">
     <div class="row" style="padding:10px;">
      <div class="col-md-3">
        <div id="pickup_date_div" data-date=""></div>
        <input type="hidden" id="pickup_date">
    </div>
    <div class="col-md-5">
        <div id="pick_time">
        </div>
        <input type="hidden" name="pickup_time" id="pickup_time" >
    </div>
    <div class="col-md-4">
       <div class="row">
        <div class="col-md-6">
            <h6 style="color:black;" >Pickup date:</h6>
        </div>
        <div class="col-md-6">
            <h6 style="color:black;" id="pickup_date_text" ></h6>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h6 style="color:black;" >Pickup time</h6>
        </div>
        <div class="col-md-6">
            <h6 style="color:black;" id="pickup_time_text" ></h6>
        </div>
    </div>
</div>
</div>
  <div class="row" style="padding:20px!important;">
            <div class="form-group">
              <label for="exampleFormControlTextarea2" style="padding-left:5px;">Any Collection Instructions?</label>
              <textarea class="form-control rounded-0" id="any_collection_instruction" name="any_collection_instruction" rows="3" placeholder="Type your instructions here"></textarea>
            </div>
        </div>
<div class="row" style="padding:10px;">
    <div style="color:white;" class="col-md-12 text-right">
        <a id="address_next" onclick="date_pickup_next();" class="btn btn-custom">Next</a>
    </div>
</div>
</div>


<div id="tab_delivery_date" class="tabcontent">
  <div class="row" style="padding:10px;">
    <div class="col-md-3">
        <div id="delivery_date_div" data-date=""></div>
        <input type="hidden" id="delivery_date">
    </div>
    <div class="col-md-5">
        <div  id="deliver_time">
        </div>
        <input type="hidden" name="delivery_time" id="delivery_time" >
    </div>
    <div class="col-md-4">
       <div class="row">
        <div class="col-md-6">
            <h6 style="color:black;" >Delivery date:</h6>
        </div>
        <div class="col-md-6">
            <h6 style="color:black;" id="delivery_date_text" ></h6>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h6 style="color:black;" >Delivery time</h6>
        </div>
        <div class="col-md-6">
            <h6 style="color:black;" id="delivery_time_text" ></h6>
        </div>
    </div>
</div>
</div>
<div class="row" style="padding:20px!important;">
            <div class="form-group">
              <label for="exampleFormControlTextarea2" style="padding-left:5px!important;">Any Delivery Instructions?</label>
              <textarea class="form-control rounded-0" id="any_delivery_instruction" name="any_delivery_instruction" rows="3" placeholder="Type your instructions here"></textarea>
            </div>
        </div>
<div class="row" style="padding:10px;">
    <div style="color:white;" class="col-md-12 text-right">
        <a id="address_next" onclick="checkout();" class="btn btn-custom">Proceed to pay</a>
    </div>
</div>
</div>

<div id="tab_payment" class="tabcontent">
    <div class="row" style="padding:10px;">
        <div class="col-md-6">
            <div class="col-lg-12">
                <div class="section-title mb-5">
                    <h4 class="title ele-title text-uppercase mb-4">Payment Mode</h4>
                </div>
                <div class="table-responsive">
                    <div class="col-md-12">
                        <ul class="list-unstyled">
                            @foreach($payment_modes as $key => $value)
                            <?php
                            $checked = '';
                            if($key == 0){
                                $checked='checked';
                            }else{
                                $checked=''; 
                            }
                            ?>
                            <li class="mb-2 mr-2">
                                <div class="custom-control custom-radio">
                                    <input type="radio" {{$checked}} class="custom-control-input" name="payment" id="payment_{{$value->id}}" value="{{$value->id}}">
                                    <label class="custom-control-label" for="payment_{{$value->id}}">{{ $value->payment_mode }}</label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <!-- Radio END -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            
        </div>
    </div>
    <div class="row" style="padding:10px;">
        <div style="color:white;" class="col-md-12 text-right">
            <a id="address_next" onclick="checkout();" class="btn btn-custom">Complete Order</a>
        </div>
    </div>
</div>
</div><!--end row-->
</div><!--end container-->
<!--<button type="button" class="btn btn-default" onclick="open_success();">Open</button>-->
<input type="hidden" id="success_hidden" data-toggle="modal" data-target="#success" />

</section><!--end section-->

<!-- Modal -->
<div class="modal fade" id="address_model" role="dialog" style="overflow: scroll;overflow-y: scroll;overflow-x:hidden"> 
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn btn-custom" data-dismiss="modal" data-toggle="modal" data-target="#new_address_model">Add Address</button>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="address_list">
            @foreach($addresses as $value)
            <div class="row">
                <div class="col-md-8 ">
                    <h6>{{ $value->address }}</h6>
                </div>
                <div class="col-md-2">
                    <center><button type="button" class="btn btn-default" data-dismiss="modal" onclick="choose_address('{{$value->id}}','{{$value->address}}');">Select</button></center>
                </div>
            </div>
            <hr>
            @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="new_address_model" role="dialog" style="overflow: scroll;overflow-y: scroll;overflow-x:hidden">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="row">
                 <div class="col-md-12">
                  <div class="search-container" style="margin:20px;">
                      <div class="form-group">
                          <label for="exampleFormControlTextarea2">Enter Pincode to Search Address</label>
                        <input class="form-control map-input" placeholder="Search by pincode" id="search_address" name="search_address" list="address_description" autocomplete="off" type="text" />
                        <datalist id="address_description">
                        </datalist>
                            <input type="hidden" name="selected_address" id="selected_address" value="" />
                            <input type="hidden" name="select_address_text" id="select_address_text" value="" />
                            <input type="hidden" name="select_address_description" id="select_address_description" value="" />
                            <input type="hidden" name="unique_id" id="unique_id" value="" />
                            <input type="hidden" name="city" id="city" value="" />
                            <input type="hidden" name="country" id="country" value="" />
                            <input type="hidden" name="postcode" id="postcode" value="" />
                      </div>
                       
                        <div class="form-group"  id="sub_input" style="display:none;">
                        <input class="form-control map-input" id="search1" name="search1" list="address_description1" autocomplete="off" type="text" />
                        <datalist id="address_description1">
                        </datalist>
                      </div>
                      <div id="values_display" style="display:none; border-style: solid; border-color:rgb(222, 226, 230);padding-bottom:10px">
                      <div class="row" style="padding-top:10px; padding-left:10px">
                        <div class="col-2">
                          <label for="exampleFormControlTextarea2" >City: </label>
                        </div>
                         <div class="col-8">
                          <label for="exampleFormControlTextarea2" id="text_city"></label>
                        </div>
                    </div>
                    <div class="row " style="padding-left:10px">
                        <div class="col-2">
                          <label for="exampleFormControlTextarea2" >Country: </label>
                        </div>
                         <div class="col-8">
                          <label for="exampleFormControlTextarea2" id="text_country"></label>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:10px; padding-left:10px">
                        <div class="col-2">
                          <label for="exampleFormControlTextarea2" >Postcode: </label>
                        </div>
                         <div class="col-8">
                          <label for="exampleFormControlTextarea2" id="text_postcode"></label>
                        </div>
                    </div>
                  </div>
                  <div class="row" style="padding-left:10px!important;">
                          <label for="exampleFormControlTextarea2" >Address Type: </label>

                    </div>
                    <div class="row p-10">
                    <select class="selectpicker" id="address_type" style="width: 100%;height: 38px;">
                      <option selected>Please select address type</option>
                      <option value="1">Home</option>
                      <option value="2">Work</option>
                      <option value="3">Other</option>
                    </select>
                    </div>
                      <div class="row p-10">
                        <div class="form-group">
                          <label for="exampleFormControlTextarea2">Manual Address</label>
                          <textarea class="form-control rounded-0" id="manual_address" name="manual_address" rows="3" placeholder="Enter Manual Address here"></textarea>
                        </div>
                    </div>
                      </div>
                 <!--  <div class="search-container" style="margin:20px;">
                      <div class="form-group">
                          <label for="exampleFormControlTextarea2">Enter Pincode to Search Address</label>
                        <input class="form-control map-input" placeholder="Search by pincode" id="search_address" name="search_address" list="address_description" autocomplete="off" type="text" />
                        <datalist id="address_description">
                        </datalist>
                            <input type="hidden" name="selected_address" id="selected_address" value="" />
                            <input type="hidden" name="select_address_text" id="select_address_text" value="" />
                            <input type="hidden" name="select_address_description" id="select_address_description" value="" />
                            <input type="hidden" name="unique_id" id="unique_id" value="" />
                            <input type="hidden" name="city" id="city" value="" />
                            <input type="hidden" name="country" id="country" value="" />
                            <input type="hidden" name="postcode" id="postcode" value="" />
                      </div>
                       
                          <label for="exampleFormControlTextarea2">Address Type</label>
                      <div class="row p-10">
                      <select class="form-select" id="address_type">
                      <option selected>Please Select Address Type</option>
                      <option value="1">Home</option>
                      <option value="2">Work</option>
                      <option value="3">Other</option>
                      </select>
                    </div>
                      <div class="row p-10">
                        <div class="form-group">
                          <label for="exampleFormControlTextarea2">Manual Address</label>
                          <textarea class="form-control rounded-0" id="manual_address" name="manual_address" rows="3" placeholder="Enter Manual Address here"></textarea>
                        </div>
                    </div>
                      </div> -->
                  </div>
               
            </div><!--end row-->
        </div>
        <div class="modal-footer">
          <button type="button" onclick="address_submit();" class="btn btn-info" >Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>


<!-- Modal -->
<div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="success" role="dialog" style="overflow: scroll;overflow-y: scroll;overflow-x:hidden">
    <div class="modal-dialog modal-md">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <center>
            <h4 class="text-info" ><b>ORDER COMPLETE!</b></h4>
            <h5>Your order is now being processed.</h5>
            <h5> THANK YOU FOR USING </h5>
            <img style="margin-top: 15px;" src="{{ asset('web/images/logo.png') }}" alt="missing_logo" height="40">
        </center>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>
</div>
</div>
    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />


<!-- Services End -->
@include('templates.footer')
<script>
    function view_cart(){
       window.location = "/cart";
    }
    
    </script>

  <script>
     $(document).ready(function() {
      var search_address =  $('#search_address').val(); 
      $("#search_address").on("input", function(e) {
        var val = $(this).val();
      if(val === "") return;
      console.log(val);
      var opt = ($("#address_description option[value='" + $('#search_address').val() + "']").attr('id'));
      if(opt === '' || opt === undefined){
                $.get("https://api.getaddress.io/find/"+val+"?expand=true&api-key=BDlwYLXECkKRiarfDRiKSw29967", function(res) {
                  var datalist = $("#address_description");   
                datalist.empty();
                console.log(res.addresses);
                if(res.addresses.length) {
                for(var i=0, len=res.addresses.length; i<len; i++) {
                var option = $('<option></option>',{"value": res.addresses[i]['formatted_address']+' '+res['postcode'].split(" ").join(""), "id": res.addresses[i]['town_or_city']+','+res.addresses[i]['country']+','+res['postcode']+','+res.addresses[i]['formatted_address']});
                datalist.append(option);
                }
                } 
                  });
              }else if(opt != ''){
                var optArray = opt.split(',');
                var city = optArray[0];
                var country = optArray[1];
                var postcode = optArray[2];
                var formatted_address = optArray[3];
                document.getElementById("values_display").style.display = "block"; 
                 $("#city").val(city);
                 $("#text_city").text(city);
                   $("#country").val(country);
                   $("#text_country").text(country);
                   $("#postcode").val(postcode);
                   $("#text_postcode").text(postcode);
                    $("#select_address_text").val(formatted_address);
                    $("#selected_address").val(formatted_address);
                    $("#select_address_description").val(formatted_address);
                    $("#unique_id").val(postcode);
              }
                 
      });

      $('.userinfo').click(function(){
   
   var userid = $(this).data('id');

   // AJAX request
   $.ajax({
    url: 'ajaxfile.php',
    type: 'post',
    data: {userid: userid},
    success: function(response){ 
      // Add response in Modal body
      $('.modal-body').html(response);

      // Display Modal
      $('#empModal').modal('show'); 
    }
  });
 });
      })
      </script>

<script type="text/javascript">

    $('#success').on('hidden.bs.modal', function () {
        window.location.href = "/profile/orders";
    });

    $('#pickup_date_div').datepicker({  
     format: 'dd-mm-yyyy',
     startDate: 'today',
     endDate: '+30d'
 })
    $('#pickup_date_div').on('changeDate', function(e) {
        $('#pickup_date').val(
            $('#pickup_date_div').datepicker('getFormattedDate')
            );
        $('#pickup_date_text').text(
         $('#pickup_date').val()
         );
        pickup_time_slot();

    });

    $('#delivery_date_div').datepicker({  
     format: 'dd-mm-yyyy',
     startDate: 'today',
     endDate: '+30d'
 });

    $('#delivery_date_div').on('changeDate', function(e) {
        $('#delivery_date').val(
            $('#delivery_date_div').datepicker('getFormattedDate')
            );
        
        if(Date.parse($('#pickup_date_div').datepicker('getFormattedDate')) >= Date.parse($('#delivery_date_div').datepicker('getFormattedDate'))){
            $('#delivery_date').val('');
            $('#delivery_date_text').text('');
            $('#deliver_time').html('');
            $('#delivery_time').val('');
            alert("please select some other date");
        }else{
            $('#delivery_date_text').text(
             $('#delivery_date').val()
             );
            delivery_time_slot();

        }
    });

    $('#pickup_time').timepicker();

    $('.pickup_date').datepicker({  
     format: 'mm-dd-yyyy',
     startDate: 'today',
 });  

    $('.delivery_date').datepicker({  
     format: 'mm-dd-yyyy',
     startDate: '+2d',
 });  


    function open_success(){
        $("#success_hidden").click();
    }


    function selectTab(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

$("#tab_title_address").click();

function current_address(address){
    $("#current_address").val(address);
}

function address_next(){
    if($("#address").val() != ''){
        $("#tab_title_pickup_date").click();
    }else{
        alert('Please select address');
    }
}

function date_pickup_next(){
    // if($("#pickup_date").val() != '' && ("#pickup_time").val() != ''){
        $("#tab_title_delivery_date").click();
    // }else{
        // alert('Please select date and time');
    // }
}
function date_delivery_next(){
    // if($("#delivery_date").val() != '' && ("#delivery_time").val() != ''){
        $("#tab_title_payment").click();
    // }else{
        // alert('Please select delivery date and time');
    // }
}

function pickup_time_slot(){
 var pickupdate = $("#pickup_date").val();
 
 if(pickupdate != ''){
    // alert(pickupdate);
    $.ajax({
      url: '/get_pickup_time_slot',
      type: 'POST',
      data: {
          _token: "{{ csrf_token() }}", 
          date:pickupdate 
      },
      success: function (html_data) { 
          $('#pick_time').html(html_data);
      }
  });
}else{
    // alert("none");
}
}

function delivery_time_slot(){
 var deliverydate = $("#delivery_date").val();
 if(deliverydate != ''){
    // alert(deliverydate);
    $.ajax({
      url: '/get_delivery_time_slot',
      type: 'POST',
      data: {
          _token: "{{ csrf_token() }}", 
          date:deliverydate 
      },
      success: function (html_data) { 
          $('#deliver_time').html(html_data);

      }
  });
}else{
    // alert("none");
}
}

function add_pickup_time(time){
   $("#pickup_time").val(time);
   $("#pickup_time_text").text(time);
}

function add_delivery_time(time){
    $("#delivery_time").val(time);
    $("#delivery_time_text").text(time);

}

function total_next(){
    $("#tab_title_payment").click();
}



</script>
<script>
    var dt= new Date();
    var yyyy = dt.getFullYear().toString();
    var mm = (dt.getMonth()+1).toString(); // getMonth() is zero-based
    var dd  = dt.getDate().toString();
    var min = yyyy +'-'+ (mm[1]?mm:"0"+mm[0]) +'-'+ (dd[1]?dd:"0"+dd[0]); // padding
    $('#delivery_date').prop('min',min);


    $( function() {
        $( "#datepicker" ).datepicker();
    } );
    
    function add_to_cart(service_id){
        $.ajax({
            url: '/add_to_cart',
            type: 'POST',
            data: {_token: $("#csrf-token").val(), service_id : service_id},
            dataType: 'JSON',
            success: function (data) { 
                if(data == 1){
                    $("#bt_"+service_id).text('Remove From Cart');
                    $("#bt_"+service_id).css({'color':'#FF0000'}); 
                }else{
                    $("#bt_"+service_id).text('Add To Cart');
                    $("#bt_"+service_id).css({'color':'#064ea3'});
                }
            }
        }); 
    }
   
    function check_category(service_id){
        window.location = "/category/"+service_id;
         // $("#exampleModalCenter").modal();
        //   $.ajax({
        //     url: '/check_category',
        //     type: 'POST',
        //     data: {_token: $("#csrf-token").val(), service_id : service_id},
        //     dataType: 'JSON',
        //     success: function (html_data) { 
        //       $('#modal_detail').html(html_data);//selector are not valid you are missing to add # at the beginning 
        //     $('#exampleModalCenter').modal("show");  

        //     }
        // }); 
    }
   

    function payment_submit(){
      window.location = "/payment";
               
    }

</script>
   
<script type="text/javascript">

    $('#success').on('hidden.bs.modal', function () {
        window.location.href = "/profile/orders";
    });

 

function address_submit(){
  var customer_id = '{{ Auth::id() }}';
  var address = $("#selected_address").val();
  var unique_id = $("#unique_id").val();
  var address_id = $("#address_id").val();
  var city = $("#city").val();
  var country = $("#country").val();
  var postcode = $("#postcode").val();
  var manual_address = $("#manual_address").val();
  var address_type = document.querySelector('#address_type').value;
  if(manual_address == ""){
            alert('Please enter manual address');
            return false;
        }else if(address == ""){
            alert('Please choose address');
            return false;
        }else if(address_type == ""){
            alert('Please choose address type');
            return false;
        }else{
    if(address_id == '' || address_id == undefined){
      $.ajax({
          url: '/save_address',
          type: 'POST',
          data: {
              _token: "{{ csrf_token() }}", 
              customer_id:customer_id,
              unique_id:unique_id ,
              address:address ,
              city:city ,
              country:country ,
              postcode:postcode ,
              manual_address:manual_address ,
              type:address_type ,
          },
          success: function (data) { 
            $('#new_address_model').modal('hide');
            document.getElementById("values_display").style.display = "none"; 
            document.getElementById("sub_input").style.display = "none"; 
            $('#search').val('');
            $('#search1').val('');
            $('#selected_address').val('');
            $('#select_address_description').val('');
            $('#select_address_text').val('');
            $('#unique_id').val('');
            $('#city').val('');
            $('#country').val('');
            $('#postcode').val('');
            $('#manual_address').val('');
            var obj = JSON.parse(data);
            $("#address_list").append('<div class="row"><div class="col-md-8 "><h6>'+obj.address+'</h6></div><div class="col-md-2"><center><button type="button" class="btn btn-default" data-dismiss="modal" onclick="choose_address('+"'"+obj.id+"'"+','+"'"+obj.address+"'"+');">Select</button></center></div></div><hr>');
            $('#address_model').modal('show');
            //window.location = "/profile/address";
          }
      });
    }else{
      $.ajax({
          url: '/edit_address',
          type: 'POST',
          data: {
              _token: "{{ csrf_token() }}", 
              customer_id:customer_id ,
              customer_address:$("#customer_address").val(),
              address_id:address_id ,
              unique_id:unique_id ,
              address:address ,
              city:city ,
              country:country ,
              postcode:postcode ,
              manual_address:manual_address ,
              type:address_type
          },
          success: function (data) { 
          $('#new_address_model').modal('hide');
            document.getElementById("values_display").style.display = "none"; 
           $('#selected_address').val('');
            $('#select_address_description').val('');
            $('#select_address_text').val('');
            $('#unique_id').val('');
            $('#city').val('');
            $('#country').val('');
            $('#postcode').val('');
            $('#manual_address').val('');
          window.location = "/profile/address";
        }
      });
    }
}
}


</script>
<script>
    var dt= new Date();
    var yyyy = dt.getFullYear().toString();
    var mm = (dt.getMonth()+1).toString(); // getMonth() is zero-based
    var dd  = dt.getDate().toString();
    var min = yyyy +'-'+ (mm[1]?mm:"0"+mm[0]) +'-'+ (dd[1]?dd:"0"+dd[0]); // padding
    $('#delivery_date').prop('min',min);


    $( function() {
        $( "#datepicker" ).datepicker();
    } );
    
    function check_order_count(){
        var address = $("#address").val();
       var delivery_date = $("#delivery_date").val();
       var delivery_time = $("#delivery_time").val();
       var pickup_date = $("#pickup_date").val();
       var pickup_time = $("#pickup_time").val();
       var delivery_date = $("#delivery_date").val();
       if(address == ""){
            alert('Please choose address');
            return false;
        }else if(pickup_date == ""){
            alert('Please choose  pickup date');
            return false;
        }else if(pickup_time == ""){
            alert('Please choose  pickup time');
            return false;
        }else if(delivery_date == ""){
            alert('Please choose delivery date');
            return false;
        }else if(delivery_time == ""){
            alert('Please choose  delivery time');
            return false;
        }else{
            $.ajax({
            url: '/check_order_count',
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}", 
                pickup_date:pickup_date,
                pickup_time:pickup_time,
                delivery_date:delivery_date,
                delivery_time:delivery_time,
            },
            success: function (data) { 
                var obj = JSON.parse(data);
                if(obj.status == 1){
                    check_payment();
                }else{
                    alert(obj.message);
                }
            }
        });
        }
    }
    
    function check_payment(){
        var payment_method = $('input[name=payment]:checked').val();
        if(payment_method == 1){
            checkout();
        }else{
            check_card_availability();
        }
    }
    
    
    function checkout(){
       var address = $("#address").val();
       var delivery_date = $("#delivery_date").val();
       var delivery_time = $("#delivery_time").val();
       var pickup_date = $("#pickup_date").val();
       var pickup_time = $("#pickup_time").val();
       var any_collection_instruction = $("#any_collection_instruction").val();
       var any_delivery_instruction = $("#any_delivery_instruction").val();
       var any_other_request = $("#any_other_request").val();
       var customer_id = '{{ Auth::id() }}';
       var payment_method
        = $('input[name=payment]:checked').val();
    if(address == ""){
        alert('Please choose address');
        return false;
    }else if(pickup_date == ""){
        alert('Please choose  pickup date');
        return false;
    }else if(pickup_time == ""){
        alert('Please choose  pickup time');
        return false;
    }else if(delivery_date == ""){
        alert('Please choose  delivery date');
        return false;
    }else if(delivery_time == ""){
        alert('Please choose  pickup time');
        return false;
    }else{
        $.ajax({
            url: '/checkout',
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}", 
                customer_id:customer_id ,
                address_id:address,
                pickup_date:pickup_date,
                pickup_time:$("#pickup_time").val(),
                delivery_date:delivery_date,
                delivery_time:$("#delivery_time").val(),
                payment_mode:payment_method ,
                other_requests:any_other_request,
                collection_instructions:any_collection_instruction,
                delivery_instructions:any_delivery_instruction,
            },
            success: function (data) { 
                if(data == 1){
                window.location = "/payment";
                    // window.location = "/thankyou";
                }
            }
        });
    }
}

function choose_address(id,address){
    $("#address").val(id);
    $("#address_text").text(address);
        /*document.getElementById("address_btn").style.display = "none";
        document.getElementById("checkout_btn").style.display = "block";*/
}
</script>
