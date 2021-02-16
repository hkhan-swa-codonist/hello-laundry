@include('templates.header')
<!-- HOME START-->
<section class="bg-pages" data-jarallax='{"speed": 0.5}' style="background-image:url({{ asset('web/images/cover_image.jpg') }})">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container page-next-level">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="text-sm-left">
                            <h5 class="title-pager text-uppercase mb-0"> Pending Order details #{{$my_orders->id}} </h5>
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
    <div class="site-section">
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
                  @if($my_orders->status == '7')
                  <p class="pending-bg detail-head">{{ $my_orders->status_name }}</p>
                  @endif
                   @if($my_orders->status == '8')
                  <p class="completed-bg detail-head"> {{ $my_orders->status_name }}</p>
                  @endif
                   @if($my_orders->status == '9')
                  <p class="rejected-bg detail-head "> {{ $my_orders->status_name }}</p>
                  @endif
                </div>
              </div>
              <hr>
              <h6 class="text-black text-uppercase"><b> Items</b></h6>
              @foreach($my_orders->items as $item)
              <div class="row">
                <div class="col-md-2">
                  <p class="detail-head">{{ $item->qty }}X</p>
                </div>
                <div class="col-md-8">
                  <p class="detail-head">{{ $item->product_name }}</p>
                </div>
              </div>
              @endforeach
              <hr>
              <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-4">
                  <p class="detail-content"><b>Total</b></p>
                </div>
                <div class="col-md-2">
                  <p class="detail-content"><b> {{$currency}}{{ $my_orders->total }}</b></p>
                </div>
              </div>
          </div>
          </div>
          <div class="col-md-12 text-right">
             @if($my_orders->status == 7)
            <!-- <a style="color:white;" href="/prescription_cart/{{ $my_orders->id }}" class="payment_mode_class btn btn-theme rounded-0 mb-2 mr-2 success-bg text-white">ACCEPT</a> -->
            <a data-toggle="modal" style="color:white;" data-id="{{ $my_orders->id}}" data-target="#payment_mode_model" class="payment_mode_class btn btn-theme rounded-0 mb-2 mr-2 success-bg text-white">ACCEPT & Pay</a>
            @endif
          <a href="/profile/pending_orders" class="btn rounded-0 mb-2 mr-2 text-white  btn-theme">Back to Pending orders list</a>
        </div>
        </div>
      </div>
    </div>
@include('templates.footer')


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
                  <label class="custom-control-label" for="payment_1">Cash</label>
                </div>
              </li>
              <li class="mb-2 mr-2">
                <div class="custom-control custom-radio">
                  <input type="radio" class="custom-control-input" name="payment" id="payment_2" value="2">
                  <label class="custom-control-label" for="payment_2">Online</label>
                </div>
              </li>
            </ul>
          </div><!--end col-->
              </div><!--end row-->
            <input type="hidden" name="prescription_id" id="prescription_id" value="" />
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
    var prescription_id = $('#prescription_id').val();
       if(payment_method == ""){
        alert('Pleace Select payment mode');
        return false;
      }else{
        $.ajax({
          url: '/prescription_checkout',
          type: 'POST',
          data: {
            _token: "{{ csrf_token() }}", 
            payment_mode:payment_method ,
            prescription_id:prescription_id ,
          },
          success: function (data) { 
            if(data == 1){
              window.location.href = "/thankyou";
            }else{
               window.location = "/prescription_payment";
            }
          }
        });
      }
    }

   $(document).on("click", ".payment_mode_class", function () {
       var myprescription_id = $(this).data('id');
       $(".modal-body #prescription_id").val( myprescription_id );
    });
</script>
