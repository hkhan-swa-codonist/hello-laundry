@include('templates.header') 

<style type="text/css">
  /* Style the tab */
.card {
    z-index: 0;
    background-color: #fff;
    padding: 20px;
    margin-top: 90px;
    margin-bottom: 90px;
    border-radius: 10px
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

  .tab {
    float: left;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
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

  /* Style the buttons inside the tab */
  .tab button {
    display: block;
    background-color: inherit;
    color: black;
    padding: 22px 16px;
    width: 100%;
    border: none;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
    font-size: 17px;
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ddd;
  }

  /* Create an active/current "tab button" class */
  .tab button.active {
    background-color: #ccc;
  }

  #profile_preview {
    border-radius: 50%;
  }
  .text-black{
    color:#000000;
  }
</style>
<style>
    .StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
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
              @if($page == 'profile')
              <h5 class="title-pager text-uppercase mb-0">  <span> Profile </span></h5>
              @endif
              @if($page == 'orders')
              <h5 class="title-pager text-uppercase mb-0">  <span> Orders</span></h5>
              @endif
              @if($page == 'pending_orders')
              <h5 class="title-pager text-uppercase mb-0"> <span> Pending Orders</span></h5>
              @endif
              @if($page == 'address')
              <h5 class="title-pager text-uppercase mb-0"> <span> Address</span></h5>
              @endif
            </div>
          </div><!--end col-->

          <div class="col-sm-6">  
            <div class="text-sm-right">
              <!--<ul class="page-two page-next mb-0"><li><a>Home</a></li><li><span>Profile</span> </li></ul>-->
            </div>  
          </div><!--end col-->
        </div><!--end row-->
      </div><!--end container--> 
    </div>
  </div>
</section>
<!-- HOME END--> 

<section class="section">
  <div class="container">
    <!-- <h3 class="text-black"><b>Welcome {{ $profile->customer_name }}</b></h3> -->
    <div class="row" style="margin-top:0px!important">
              <div class="col-md-10 order-1 order-md-2">
                
                
                @if($page == 'profile')
                <div class="tabcontent">
                  <?php
                  if($profile->profile_picture != '' || $profile->profile_picture !== null){
                   $profile_image = env('APP_URL').'/uploads/'.$profile->profile_picture; 
                 }else{
                   $profile_image = env('APP_URL').'/uploads/images/avatar.png'; 
                 }
                 ?>
                  @csrf
                  <center>
                    <div>
                      <img style="width:100px;height:100px;" id="profile_preview" src="{{ $profile_image }}" alt="Avatar">
                    </div>
                    <form method="POST" id="uploadimage" action="/profile">
                      <div style="margin-top:10px;margin-bottom:10px;">
                        <a href="javascript:void(0)" onclick="open_picker();" class="btn btn-sm btn-custom mb-2 mr-2">Change </a>
                        <input style="display: none;" onchange="update_picture(this.value);" type="file" name="profile_picture" id="profile_picture" accept="image/*">
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" id="id" value="{{ $profile->id }}" />
                        
                      </div>
                    </form>
                  </center>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Username<span class="text-danger">*</span></label>
                        <input id="customer_name" type="text" class="form-control{{ $errors->has('customer_name') ? ' is-invalid' : '' }}" name="customer_name" value="{{ $profile->customer_name }}" placeholder="Username" required >
                        
                        @error('customer_name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Phone <span class="text-danger">*</span></label>
                        <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $profile->phone_number }}" placeholder="Phone" required autocomplete="email">
                        
                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Email<span class="text-danger">*</span></label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ $profile->email }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" autocomplete="new-password">

                      </div>
                    </div>

                    <div class="col-lg-6 mb-0">
                      <button type="button" onclick="profile_update();" style="width:250px;" class="btn btn-custom">Update</button>
                    </div>
                  </div>
                
              </div>
              @endif
              @if($page == 'orders')
              <div class="col-lg-12 col-md-12 mt-sm-30">
                <!-- <h3 class="text-theme mb-3"><b>ACTIVE ORDERS LIST</b></h3> -->
                <!-- </div> -->
                @foreach($my_orders as $value)

                <article class="card" style="margin-top:40px!important; margin-bottom:40px!important">
                <header class="card-header"> Order ID: #{{$value->order_id}}</header>
                <div class="card-body">
                <div class="row" style="margin-top:0px!important">
                    <!-- <div class="col-4"> <strong>Estimated Delivery time:</strong> <br>29 nov 2019 </div> -->
                    <div class="col-5"> <strong>Ordered date</strong> <br> {{ date('d M-Y h:i A', strtotime($value->created_at))}}</div>
                    <div class="col-4"> <strong>Status:</strong> <br> {{ $value->label_name }}</div>
                    <div class="col-3">
                    <button  onclick="window.location='{{ url("/order_detail/$value->id") }}'" style="float: right;" class="btn btn-custom" data-abc="true"> View Detail</button>
                    </div>
                    </div>
                </div>
            </article>
                @endforeach
                @if(!count($my_orders))
            <div class="row" style="margin-top:10px">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
            <h2 class="display-3 text-black">No Orders Yet!</h2>
            <p class="lead">Click the below button to place order and get the valuable services</p>
            <p><a href="/services" class="btn btn-md height-auto px-4 py-3 btn-custom">Order Laundry</a></p>
          </div>
        </div>
            @endif
              </div>
                @endif
                @if($page == 'my_cards')
              <div class="col-lg-12 col-md-6 mt-sm-30">
                <!-- <h3 class="text-theme mb-3"><b>ACTIVE ORDERS LIST</b></h3> -->
                <!-- </div> -->
                @foreach($my_cards as $value)
                <div class="list-group mb-3">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1 text-theme">XXXX-XXXX-XXXX-{{$value->last_four}}</h5>
                      
                      <button type="button" onclick="window.location='{{ url("/delete_card/$value->id") }}'" class="btn btn-custom" >Delete</button>
                    </div>
                </div>
                @endforeach
                @if(!count($my_cards))
                    <h5 class="mb-1 text-theme">Please add your card</h5>
                    
                    <button type="button" class="btn btn-custom" >Add Your Card</button>
                @endif
              </div>
                @endif
                 @if($page == 'address')
                <div class="tabcontent">
                  <div class="row">
                    <div class="col-md-9">
                      <h4>Address</h4>
                    </div>
                    <div class="col-md-3">
                      <right><a data-toggle="modal" style="color:white;" data-target="#add_address_model" data-dismiss="modal"class="btn btn-custom rounded-0 mb-2 mr-2">Add Address</a></right>
                    </div>
                  </div>
                  <input type="hidden" name="id" id="id" value="{{ $profile->id }}" />
                  <input type="hidden" name="address_id" id="address_id" />
                  <div class="row">
                    @foreach($addresses as $value)
                      <div class="col-lg-6 col-md-6 col-12 mb-4 pb-2" id="address_{{ $value->id }}">
                          <article class="post bg-white shadow rounded">
                              <div class="post-content bg-white rounded">
                                  <a class="post-title">{{ $value->address }}</a>
                                  <div style="margin:10px;"></div>
                                  <div class="post-footer border-top">
                                      <ul class="post-meta list-unstyled list-inline mb-0">
                                          <li class="list-inline-item float-right"><i class="fas fa-trash mr-2"></i><a onclick="delete_address({{ $value->id }});" >Delete</a></li>
                                          <li class="list-inline-item"><i class="fa fa-edit mr-2"></i><a onclick="edit_address('{{ $value->id }}', '{{ $value->address }}','{{ $value->unique_id }}','{{ $value->city }}','{{ $value->country }}','{{ $value->postcode }}','{{ $value->manual_address }}','{{ $value->type }}');" data-toggle="modal" data-target="#add_address_model"> Edit </a></li>
                                      </ul>
                                  </div>
                              </div>
                          </article>
                      </div>
                    @endforeach
                  </div>
                </div>
                @endif
            </div>
          </div>
          </div>
          <input type="hidden" name="current_id" id="current_id" value="0" />
        </section>

<!-- Modal -->
<div class="modal fade" id="add_address_model" role="dialog">
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
                      <div id="values_display" style="display:none; border-style: solid; border-color:rgb(222, 226, 230);margin-bottom:10px">
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
                    <div class="row p-10" style="padding-left: 10px;padding-bottom: 10px;padding-right: 10px;">
                    <select class="selectpicker" id="address_type" style="width: 100%;height: 38px;">
                      <option selected>Please select address type</option>
                      <option value="1">Home</option>
                      <option value="2">Work</option>
                      <option value="3">Other</option>
                    </select>
                    </div>
                      <div class="row p-10 " style="padding-left: 10px;padding-right: 10px;margin-top: 15px;">
                        <div class="form-group">
                          <label for="exampleFormControlTextarea2">Manual Address</label>
                          <textarea class="form-control rounded-0" id="manual_address" name="manual_address" rows="3" placeholder="Enter Manual Address here"></textarea>
                        </div>
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

      @include('templates.footer')
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
                 
      })
      })
      </script>

      <script>

    $("#uploadimage").on('submit',(function(e) {
    e.preventDefault();
    $.ajax({
    url: "/profile_image", 
    type: "POST",             // Type of request to be send, called as method
    data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
    contentType: false,       // The content type used when sending data to the server.
    cache: false,             // To unable request pages to be cached
    processData:false,        // To send DOMDocument or non processed data file it is set to false
    success: function(data)   // A function to be called if request succeeds
    {
    //alert(data);  
    }
    });
    }));

 function edit_address(id,address,unique_id,city,country,postcode,manual_address,type){
  $("#address_id").val(id);
  //$("#customer_address").val(customer_address);
  $("#selected_address").val(address);
  $("#edit_current_address").text(address);
  $("#unique_id").val(unique_id);
  document.getElementById("values_display").style.display = "block"; 
  $("#text_city").text(city);
  $("#text_country").text(country);
  $("#text_postcode").text(postcode);
   $("#city").val(city);
  $("#country").val(country);
  $("#postcode").val(postcode);
  $("#manual_address").val(manual_address);
  $("#search_address").val(address);
//   if(type==1){
//     var address_type = "Home";
//   }else if(type==2){
//     var address_type = "Work";
//   }
//   else if(type==3){
//     var address_type = "Other";
//   }
// $("#address_type").val("Home");
document.getElementById( 
              "address_type").selectedIndex = type; 
}

function delete_address(id){
  if(confirm("Are you sure to delete this address?")){
    $.ajax({
      url: '/address_delete',
      type: 'POST',
      data: {
        _token: "{{ csrf_token() }}", 
        address_id:id
      },
      success: function (data) { 
        if(data == 1){
          alert('successfully deleted');
          $("#address_"+id).hide()
        }
      }
    });
    
  }
}

function profile_update(){
  var customer_name = $("#customer_name").val();
  var id = $("#id").val();
  var email = $("#email").val();
  var phone_number = $("#phone_number").val();
  var password = $("#password").val();
  $.ajax({
    url: '/profile_update',
    type: 'POST',
    data: {
      _token: "{{ csrf_token() }}", 
      customer_id:id ,
      customer_name:customer_name ,
      email:email ,
      phone_number:phone_number ,
      password:password 
    },
    success: function (data) { 
      if(data == 1){
        alert('Profile successfully updated');
        $("#password").val('');
      }else{
        alert('Something went wrong');
        $("#password").val('');
      }
    }
  });
}

function open_picker(){
  $("#profile_picture").click();
}

function update_picture(val){
  var input = document.getElementById("profile_picture");
  var fReader = new FileReader();
  fReader.readAsDataURL(input.files[0]);
  fReader.onloadend = function(event){
    var img = document.getElementById("profile_preview");
    img.src = event.target.result;
    $( "#uploadimage" ).submit();
  }
}


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
            window.location = "/profile/address";
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


function change_date(value){
  var old_date = $("#delivery_date").val();
  $('#date_btn_'+old_date).removeClass('active-date-time');
  $('#date_btn_'+old_date).addClass('inactive-date-time');
  $('#date_btn_'+value).removeClass('inactive-date-time');
  $('#date_btn_'+value).addClass('active-date-time');
  $("#delivery_date").val(value);
}

function change_time(key,value){
  $('.time-cl').removeClass('active-date-time');
  $('.time-cl').removeClass('inactive-date-time');
  $('.time-cl').addClass('inactive-date-time');
  $('#time_btn_'+key).removeClass('inactive-date-time');
  $('#time_btn_'+key).addClass('active-date-time');
  $("#delivery_time").val(value);
}

function update_delivery_date(){
  $.ajax({
    url: '/update_delivery_date',
    type: 'POST',
    data: {
      _token: "{{ csrf_token() }}", 
      delivery_date:$("#delivery_date").val() ,
      delivery_time:$("#delivery_time").val(),
      order_id:$("#current_id").val()
    },
    success: function (data) { 
      if(data == 1){
        alert('Successfully updated');
        location.reload();
      }else{
        alert('Sorry something went wrong');
      }
    }
  });
}

function open_model(id){
  $("#current_id").val(id);
}
</script>




