@include('templates.header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>

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
                    <div class="col-sm-6">
                        <div class="text-sm-left">
                            <h5 class="title-pager text-uppercase mb-0"> Cart </h5>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container--> 
        </div>
    </div>
</section>
<!-- HOME END--> 

@if(count(Session::get('cart', [])) > 0)
<!-- CART PRODUCT START -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table cart">
                        <thead>
                            <tr>
                                <th class="cart-product-thumbnail">&nbsp;</th>
                                <th class="cart-product-name">Qty</th>
                                <th class="cart-product-price">Product</th>
                                <th class="cart-product-subtotal">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(Session::get('cart', []) as $value)
                            <tr class="cart_item">
                                <td class="cart-product-thumbnail">
                                    <a href="#"><img src="{{ env('IMG_URL').$value['image'] }}" class="d-block img-fluid" alt=""></a>
                                </td>
                                <td class="cart-product-name">
                                    <a href="#" class="text-dark font-weight-bold">{{ $value['qty'] }}</a>
                                </td>
                                <td class="cart-product-price">
                                    <span class="amount">{{ $value['product_name'] }} ( {{ $value['service_name'] }} )</span>
                                </td>
                                <td class="cart-product-subtotal">
                                    <span class="amount">{{ $currency }} {{ $value['price'] }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!--end table-->
            </div><!--end col-->
        </div><!--end row-->
    </div>
</section>
<!-- CART PRODUCT START -->
<section class="section" style="padding-top: 0px!important;">
    <div class="container">
        <div class="tab">
          <button class="tablinks" id="tab_title_address" onclick="selectTab(event, 'tab_address')">Address</button>
          <button class="tablinks" id="tab_title_pickup_date" onclick="selectTab(event, 'tab_pickup_date')">Pickup date & Time</button>
          <button class="tablinks" id="tab_title_delivery_date" onclick="selectTab(event, 'tab_delivery_date')">Delivery date & Time</button>
          <button class="tablinks" id="tab_title_total" onclick="selectTab(event, 'tab_total')">Order Total</button>
          <button class="tablinks" id="tab_title_payment" onclick="selectTab(event, 'tab_payment')">Payment</button>
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
<div class="row" style="padding:10px;">
    <div style="color:white;" class="col-md-12 text-right">
        <a id="address_next" onclick="date_delivery_next();" class="btn btn-custom">Next</a>
    </div>
</div>
</div>
<div id="tab_total" class="tabcontent">
  <div class="row" style="padding:10px;">
    <div class="col-md-6">
        <div class="col-lg-12">
            <div class="section-title mb-5">
                <h4 class="title ele-title text-uppercase mb-4">Cart Totals</h4>
            </div>
            <div class="table-responsive">
                <table class="table cart">
                    <tbody>
                        <tr class="cart_item">
                            <td class="cart-product-name">
                                <strong>Subtotal</strong>
                            </td>
                            <td class="cart-product-name">
                                <span class="amount" id="sub_total_text">{{ $currency }}{{ $sub_total }}</span>
                            </td>
                        </tr>
                        <tr class="cart_item">
                            <td class="cart-product-name">
                                <strong>Discount</strong>
                            </td>
                            <td class="cart-product-name">
                                <span class="amount" id="discount_text">{{ $currency }}{{ $promo_amount }}</span>
                            </td>
                        </tr>
                        <tr class="cart_item">
                            <td class="cart-product-name">
                                <strong>Total</strong>
                            </td>
                            <td class="cart-product-name">
                                <span class="text-custom"><strong id="total_text">{{ $currency }}{{ $total }}</strong></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="col-lg-12">
            <div class="section-title mb-5">
                <h4 class="title ele-title text-uppercase mb-4">Apply Coupon</h4>
            </div>
            <div class="table-responsive">
                <div class="form-group">
                    <input name="promo_code" id="promo_code" type="text" value="{{ $promo }}" class="form-control" placeholder="Coupon code :">
                </div> 
                
                <p><center><a id="remove_promo_text" @if($promo != '') style="color:red;" @else style="color:red;display:none;" @endif  onclick="remove_promo();"><i class="fa fa-minus-circle"></i> Remove promo code</a></center></p>
                
                <input type="button" id="apply_promo" onclick="apply_promo();" class="submitBnt btn btn-custom w-100" value="Apply Code">
                <p><center><a data-toggle="modal" data-target="#coupon_model">View coupon codes</a></center></p>
                @if($error != '')
                <p><center style="color:red;" >{{ $error }}</center></p>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row" style="padding:10px;">
    <div style="color:white;" class="col-md-12 text-right">
        <a id="address_next" onclick="total_next();" class="btn btn-custom">Next</a>
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
            <a id="address_next" onclick="check_order_count();" class="btn btn-custom">Complete Order</a>
        </div>
    </div>
</div>
<input type="hidden" name="total" id="total" value="{{ $total }}" />
<input type="hidden" name="promo_amount" id="promo_amount" value="{{ $promo_amount }}" />
<input type="hidden" name="sub_total" id="sub_total" value="{{ $sub_total }}" />
<input type="hidden" name="promo_id" id="promo_id" value="{{ $promo_id }}" />
</div><!--end row-->
</div><!--end container-->
<!--<button type="button" class="btn btn-default" onclick="open_success();">Open</button>-->
<input type="hidden" id="success_hidden" data-toggle="modal" data-target="#success" />

</section><!--end section-->
@else
<!-- CART PRODUCT START -->
<section class="section">
    <div class="container">
        <center>
            <h4 class="title ele-title text-uppercase mb-4">Your cart is empty</h4>
        </center>
    </div><!--end container-->
</section><!--end section-->
@endif

<!-- Modal -->
<div class="modal fade" id="coupon_model" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        @foreach($promo_codes as $value)
        <div class="row">
            <div class="col-md-4">
                <center><p style="color:green;margin-top:2px;border:1px solid green;" >{{ $value->promo_code }}</p></center>
            </div>
            <div class="col-md-4 "></div>
            <div class="col-md-4 ">
                <center><button type="button" class="btn btn-default" data-dismiss="modal" onclick="choose_promo('{{$value->promo_code}}');">SELECT</button></center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h6 style="color:black;" >{{ $value->promo_name }}</h6>
            </div>
            <div class="col-md-12 ">
                <p style="font-size: 14px;">{{ $value->description }}</p>
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
                        <input class="form-control map-input" placeholder="Search by pincode or area" id="search" name="search" list="address_description" autocomplete="off" type="text" />
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
                      </div>
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

@include('templates.footer')
 <script>
     $(document).ready(function() {
      $("#search").on("input", function(e) {
      var val = $(this).val();
      if(val === "") return;
      console.log(val);
      var opt = ($("#address_description option[value='" + $('#search').val() + "']").attr('id'));
      // console.log(opt);
            if(opt === '' || opt === undefined){
                $.get("https://api.addressy.com/Capture/Interactive/Find/v1.10/json3.ws?key=MU79-HJ65-XJ39-RT95&text="+val, function(res) {
                var datalist = $("#address_description");   
                datalist.empty();
                console.log(res.Items);
                if(res.Items.length) {
                for(var i=0, len=res.Items.length; i<len; i++) {
                var option = $('<option></option>',{"value": res.Items[i]['Text']+'  '+res.Items[i]['Description'], "id": res.Items[i]['Type']+','+res.Items[i]['Id']+','+res.Items[i]['Text']+','+res.Items[i]['Description']});
                datalist.append(option);
                }
                } 
                });
              }else if(opt != ''){
                var optArray = opt.split(',');
                var type = optArray[0];
                var container = optArray[1];
                var text = optArray[2];
                var description = optArray[3];
                if(type == "Postcode"){
                console.log("postcode");

                document.getElementById("sub_input").style.display = "block"; 
                $.get("https://api.addressy.com/Capture/Interactive/Find/v1.10/json3.ws?key=MU79-HJ65-XJ39-RT95&text="+val+"&container="+container, function(res1) {
                  var datalist = $("#address_description1");
                  datalist.empty();
                  if(res1.Items.length) {
                  for(var i=0, len=res1.Items.length; i<len; i++) {
                  var option = $('<option></option>',{"value": res1.Items[i]['Text']+'  '+res1.Items[i]['Description'],"id": res1.Items[i]['Type']+','+res1.Items[i]['Id']+','+res1.Items[i]['Text']+','+res1.Items[i]['Description']});
                  datalist.append(option);
                  }
                  }
                  });
              }else{
                var val = document.getElementById("search").value;
                $.get("https://services.postcodeanywhere.co.uk/Capture/Interactive/Retrieve/v1.00/json3.ws?Key=MU79-HJ65-XJ39-RT95&ID="+container, function(res2) {
                   $("#city").val(res2.Items[0]['City']);
                   $("#country").val(res2.Items[0]['CountryIso2']);
                   $("#postcode").val(res2.Items[0]['PostalCode']);

                  });
                   $("#select_address_text").val(text);
                    $("#selected_address").val(val);
                    $("#select_address_description").val(description);
                    $("#unique_id").val(container);
              }
            }
      });
      $("#search1").on("input", function(e) {
      var details = ($("#address_description1 option[value='" + $('#search1').val() + "']").attr('id'));
      console.log(details);
          var optArray = details.split(',');
          console.log(optArray);
                var type = optArray[0];
                var container = optArray[1];  
                var text = optArray[2];
                var description = optArray[3];
                var val = document.getElementById("search1").value;
                console.log(val);
                $.get("https://services.postcodeanywhere.co.uk/Capture/Interactive/Retrieve/v1.00/json3.ws?Key=MU79-HJ65-XJ39-RT95&ID="+container, function(res3) {
                   $("#city").val(res3.Items[0]['City']);
                   $("#country").val(res3.Items[0]['CountryIso2']);
                   $("#postcode").val(res3.Items[0]['PostalCode']);

                  });
                   $("#select_address_text").val(text);
                    $("#selected_address").val(val);
                    $("#select_address_description").val(description);
                    $("#unique_id").val(container);
                 
      })
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
    $('#pickup_date_div').on('changeDate', function() {
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

    $('#delivery_date_div').on('changeDate', function() {
        $('#delivery_date').val(
            $('#delivery_date_div').datepicker('getFormattedDate')
            );
        
        if($('#pickup_date').val() > $('#delivery_date').val()){
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
        $("#tab_title_total").click();
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


function address_submit(){
  var customer_id = '{{ Auth::id() }}';
  var address = $("#selected_address").val();
  var unique_id = $("#unique_id").val();
  var address_id = $("#address_id").val();
var city = $("#city").val();
  var country = $("#country").val();
  var postcode = $("#postcode").val();
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
          },
          success: function (data) { 
            $('#new_address_model').modal('hide');
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
          },
          success: function (data) { 
          $('#new_address_model').modal('hide');
           $('#selected_address').val('');
            $('#select_address_description').val('');
            $('#select_address_text').val('');
            $('#unique_id').val('');
            $('#city').val('');
            $('#country').val('');
            $('#postcode').val('');
          window.location = "/profile/address";
        }
      });
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
    
    function check_card_availability(){
        $.ajax({
            url: '/check_card_availability',
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                amount:$("#total").val(),
                address_id:$("#address").val()
            },
            success: function (data) { 
                //var obj = JSON.parse(data);
                
                if(data == 1){
                    checkout();
                }else{
                    alert('Sorry no cards found')
                    window.location = "/my_cards";
                }
            }
        });
    }
    
    function checkout(){
       var address = $("#address").val();
       var delivery_date = $("#delivery_date").val();
       var delivery_time = $("#delivery_time").val();
       var pickup_date = $("#pickup_date").val();
       var pickup_time = $("#pickup_time").val();
       var customer_id = '{{ Auth::id() }}';
       var payment_method = $('input[name=payment]:checked').val();
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
                total:$("#total").val(),
                discount:$("#promo_amount").val(),
                sub_total:$("#sub_total").val(),
                promo_id:$("#promo_id").val(),
                payment_mode:payment_method ,
            },
            success: function (data) { 
                if(data == 1){
                    window.location = "/thankyou";
                }
            }
        });
    }
}

function choose_promo(promo_name){
    $("#promo_code").val(promo_name);
}

function choose_address(id,address){
    $("#address").val(id);
    $("#address_text").text(address);
        /*document.getElementById("address_btn").style.display = "none";
        document.getElementById("checkout_btn").style.display = "block";*/
    }

    function apply_promo(){
        var promo_code = $("#promo_code").val();
        $.ajax({
            url: '/apply_promo',
            type: 'POST',
            data: {_token: "{{ csrf_token() }}", promo_code:promo_code },
            success: function (data) { 
                var obj = JSON.parse(data);
                if(obj.error == 0){
                    $("#sub_total_text").text(obj.currency+obj.sub_total);
                    $("#total_text").text(obj.currency+obj.total);
                    $("#discount_text").text(obj.currency+obj.promo_amount);
                    $("#total").val(obj.total);
                    $("#promo_amount").val(obj.promo_amount);
                    $("#sub_total").val(obj.sub_total);
                    $("#promo_id").val(obj.promo_id);
                    document.getElementById('remove_promo_text').style.display='block';
                }else{
                    alert('Sorry something went wrong !')
                }
                //alert(JSON.stringify(data));
                //location.reload();
            }
        }); 
    }

    function remove_promo(){
        var promo_code = $("#promo_code").val();
        $.ajax({
            url: '/remove_promo',
            type: 'POST',
            data: {_token: "{{ csrf_token() }}", promo_code:promo_code },
            success: function (data) { 
               var obj = JSON.parse(data);
               if(obj.error == 0){
                $("#sub_total_text").text(obj.currency+obj.sub_total);
                $("#total_text").text(obj.currency+obj.total);
                $("#discount_text").text(obj.currency+obj.promo_amount);
                $("#total").val(obj.total);
                $("#promo_amount").val(obj.promo_amount);
                $("#sub_total").val(obj.sub_total);
                $("#promo_id").val(obj.promo_id);
                $("#promo_code").val('');
                document.getElementById('remove_promo_text').style.display='none';
            }else{
                alert('Sorry something went wrong !')
            }
                //location.reload();
            }
        }); 
    }
    
</script>
