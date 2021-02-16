@include('templates.header')
<link rel="stylesheet" href="{{ asset('web/css/order_detail_style.css') }}">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<!-- HOME START--> 
<style>
  </style>
<section class="bg-pages" data-jarallax='{"speed": 0.5}' style="background-image:url({{ asset('web/images/cover_image.jpg') }})">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container page-next-level">
                <div class="row align-items-center">
                    <div class="col-sm-6"> 
                        <div class="text-sm-left">
                            <h5 class="title-pager text-uppercase mb-0">  Order details #{{$my_orders->order_id}} </h5>
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
<div class="container">
    <article class="card" style="margin-top:90px!important; margin-bottom:90px!important;padding:0px!important">
        <header class="card-header"> My Orders / Tracking </header>
        <div class="card-body">
            <h6>Order ID: #{{$my_orders->order_id}}</h6>
    </div>
    <div class="site-section" style="padding-top: 20px">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                <h6 class="text-black text-uppercase"><b>Address</b></h6>
                  <p class="detail-head">{{ $my_orders->address }}</p>
                </div>
                <div class="col-md-6">
                  <h6 class="text-black text-uppercase"><b>Status</b></h6>
                  @if($my_orders->status == '1')
                      <p class="placed-bg detail-head">{{ $my_orders->label_name }}</p>
                      @endif
                       @if($my_orders->status == '2')
                      <p class="accepted-bg detail-head"> {{ $my_orders->label_name }}</p>
                      @endif
                       @if($my_orders->status == '3')
                      <p class="processing-bg detail-head"> {{ $my_orders->label_name }}</p>
                      @endif
                       @if($my_orders->status == '4')
                      <p class="delivery-boy-assigned-bg detail-head"> {{ $my_orders->label_name }}</p>
                      @endif
                       @if($my_orders->status == '5')
                      <p class="on-the-way-bg detail-head">{{ $my_orders->label_name }}</p>
                      @endif
                       @if($my_orders->status == '6')
                      <p class="completed-bg detail-head"> {{ $my_orders->label_name }}</p>
                      @endif
                       @if($my_orders->status == '7')
                      <p class="completed-bg detail-head">{{ $my_orders->label_name }}</p>
                      @endif
                       @if($my_orders->status == '8')
                      <p class="rejected-bg detail-head"> {{ $my_orders->label_name }}</p>
                      @endif
                        @if($my_orders->status == '9')
                      <p class="completed-bg detail-head"> {{ $my_orders->label_name }}</p>
                      @endif
                      
                </div>
                 
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                <h6 class="text-black text-uppercase"><b>Pickup Date</b></h6>
                  <p class="detail-head">{{ date('d M-Y',strtotime($my_orders->pickup_date)) }}</p>
                </div>
                <div class="col-md-6">
                <h6 class="text-black text-uppercase"><b>Pickup Time</b></h6>
                  <p class="detail-head">{{ $my_orders->pickup_time }}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                <h6 class="text-black text-uppercase"><b>Delivery Date</b></h6>
                  <p class="detail-head">{{ date('d M-Y',strtotime($my_orders->delivery_date)) }}</p>
                </div>
                <div class="col-md-6">
                <h6 class="text-black text-uppercase"><b>Delivery Time</b></h6>
                  <p class="detail-head">{{ $my_orders->delivery_time }}</p>
                </div>
              </div>
              <hr>
               <div class="row">
                <div class="col-md-6">
                <h6 class="text-black text-uppercase"><b>Delivery instructions</b></h6>
                  <p class="detail-head">{{ $my_orders->delivery_instructions }}</p>
                </div>
                <div class="col-md-6">
                <h6 class="text-black text-uppercase"><b>Collection instruction</b></h6>
                  <p class="detail-head">{{ $my_orders->collection_instructions }}</p>
                </div>
              </div>
              <hr>
               <div class="row">
                <div class="col-md-6">
                  <h6 class="text-black text-uppercase"><b>Other Request</b></h6>
                  <p class="detail-head">{{ $my_orders->other_requests }}</p>
                </div>
              </div>
              <hr>
                <h6 class=" text-black text-uppercase"><b>Service name & Category name</b></h6>

                @foreach($order_services as $val)
              <div class="row">
                <div class="col-md-6">
                  <p class="detail-head">{{ $val->service_name }}</p>
                </div>
                <div class="col-md-6">
                  <p class="detail-head">{{ $val->category_name }}</p>
                </div>
              </div>
              <hr>
              @endforeach
              
          </div>
          </div>
          <div class="col-md-12 text-right">
          <a href="/profile/orders" class="btn rounded-0 mb-2 mr-2 text-white  btn-custom">Back to orders list</a>
        </div>
        </div>
      </div>
    </div>


        </div>
    </article>
</div>
<!-- HOME END--> 
    
<!-- Modal -->
<div class="modal fade" id="payment_mode_model" role="dialog" style="overflow: scroll;overflow-y: scroll;overflow-x:hidden">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
              <p><b>Note:Please select the payment mode to place order</b></p>
            </div>
             <div class="col-md-12  border-bottom mb-5">
            <ul class="list-unstyled">
              <li class="mb-2 mr-2">
                <div class="custom-control custom-radio">
                  <input type="radio" checked class="custom-control-input" name="payment" id="payment_1" value="1">
                  <label class="custom-control-label" for="payment_1">Creadit Card</label>
                </div>
              </li>
              <li class="mb-2 mr-2">
                <div class="custom-control custom-radio">
                  <input type="radio" class="custom-control-input" name="payment" id="payment_2" value="2">
                  <label class="custom-control-label" for="payment_2">PayPal</label>
                </div>
              </li>
            </ul>
          </div><!--end col-->
              </div><!--end row-->
            <input type="hidden" name="order_id" id="order_id" value="" />
            </div>
            <div class="modal-footer">
              <button type="button" onclick="payment_submit();" class="btn btn-info" >Submit</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>

<script>

function reject_update(id){
  var prescription_id = id;
  $.ajax({
      url: '/reject_update',
      type: 'POST',
      data: {
          _token: "{{ csrf_token() }}", 
          prescription_id:prescription_id ,
      },
      success: function (data) { 
        if(data == 1){
          alert('Prescription rejected successfully');
            window.location = "/profile/prescriptions";
        }else{
          alert('Something went wrong');
        }
      }
  });
}

function payment_submit(){
   
    var payment_method = $('input[name=payment]:checked').val();
    var order_id = $('#order_id').val();
       if(payment_method == ""){
        alert('Pleace Select payment mode');
        return false;
      }else{
        $.ajax({
          url: '/payment_checkout',
          type: 'POST',
          data: {
            _token: "{{ csrf_token() }}", 
            payment_mode:payment_method ,
            order_id:order_id ,
          },
          success: function (data) { 
            if(data == 1){
              window.location.href = "/payment";
            }else if(data == 2){
              window.location.href = "/pay_paypal";
            }else{
               alert("something went wrong");
            }
          }
        });
      }
    } 

   $(document).on("click", ".payment_mode_class", function () {
       var myorder_id = $(this).data('id');
       $(".modal-body #order_id").val( myorder_id );
    });
</script>
