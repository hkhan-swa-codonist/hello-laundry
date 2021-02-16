  <div class="container">
    <div class="col-lg-6">
        <div class="table-responsive">          
          <table class="table">
            <tbody>
              <tr>
                <th>Order Id</th>
                <td>{{$order_id}}</td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
    <div class="col-md-2 col-md-offset-2">
        <a href='/admin/orders' class='btn btn-info pull-right' style='margin-right:20px;'>Back</a>
    </div>
     
     <div class="col-lg-12">
        <div class="table-responsive">          
          <table class="table">
            <tbody>
              <tr>
                <th>Item Weight</th>
                <td>
                  <input  type="text" class="form-control weight" placeholder="Item weight in KG" required="required" name="weight" id="weight" autofocus="autofocus">
                </td>
              </tr>
              <tr>
                <td>
                  <div style="color:white;" class="col-md-12 text-right">
                <a id="address_next" onclick="price_calculation();"  class='btn btn-info pull-right' class="btn btn-custom">Calculate Price</a>
            </div>
                </td>
              </tr>

            </tbody>
             
          </table>
        </div>
    </div>
<input type="hidden" value={{$id}} id="order_id">
<input type="hidden" value={{$promo_id}} id="promo_id">
<div id="quantity"  style="display: none;">
    <div class="col-lg-12" >
      <table class="table">
            <tbody>
              <tr>
                <th>Order Id</th>
                <td>{{$order_id}}</td>
              </tr>
              <tr>
                <th>Customer Name</th>
                <td>{{$customer_name}}</td>
              </tr>
              <tr>
                <th>Address</th>
                <td>{{$address}}</td>
              </tr>
              <tr>
                <th>Expected Delivery Date</th>
                <td>{{$expected_delivery_date}}</td>
              </tr>
              <tr>
                <th>Delivered By</th>
                <td>{{$delivered_by}}</td>
              </tr>
              <tr>
                <th>Status</th>
                <td>{{$status}}</td>
              </tr>
            </tbody>
          </table>
        <h3>Items</h3>
        <table class="table table-hover">
            <thead>
              <tr>
                <th>Service</th>
                <th>Product</th>
                <th>Qty</th>
              </tr>
            </thead>
            <tbody>
            @foreach($order_items as $value)
              <tr>
                <td>{{ $value->service_name }}</td>
                <td>{{ $value->product_name }}</td>
                <td>{{ $value->qty }}</td>
              </tr>
            @endforeach
            </tbody>
        </table>
    </div>
      <div class="col-md-7">
        <div class="row">
          <div class="col-md-12  border-bottom mb-5">
            <h3>Amount</h3>
          </div>
        </div>
        <div class="row" style="margin-bottom:10px">
          <div class="col-md-2">
            <strong class="text-black" >Subtotal</strong>
          </div>
          <div class="col-md-4 text-right">
            <span class="text-black" id="sub_total_text"></span>
          </div>
          <div class="col-md-6">
          </div>
        </div>
        <div class="row mb-3" style="margin-bottom:10px">
          <div class="col-md-2">
            <strong class="text-black">Discount</strong>
          </div>
          <div class="col-md-4 text-right">
            <span class="text-black" id="discount_text"></span>
          </div>
          <div class="col-md-6">
          </div>
        </div>
        <div class="row mb-5" style="margin-bottom:10px">
          <div class="col-md-2">
            <strong class="text-black">Total</strong>
          </div>
          <div class="col-md-4 text-right">
            <span class="text-black" id="total_text"></span>
          </div>
          <div class="col-md-6">
          </div>
        </div>
    </div>
<input type="hidden" value="" name="sub_total" id="sub_total">
<input type="hidden" value="" name="total" id="total">
<input type="hidden" value="" name="discount" id="discount">

    <div style="color:white;" class="col-md-12 text-right">
                <a id="address_next" onclick="send_invoice();"  class='btn btn-info' class="btn btn-custom">Send Invoice</a>
            </div>
</div>
 </div>

<script type="text/javascript">
  function price_calculation(){
     var weight = $("#weight").val();
     var order_id = $("#order_id").val();
     if($("#promo_id").val() != null)
     {
     var promo_id = $("#promo_id").val();
   }else{
    var promo_id = '';
   }
     var base_url = 'http://127.0.0.1:8000/api';
     // var base_url = 'http://eazy-laundry.com/api';
    if(weight == ""){
        alert('Please enter weight');
        return false;
    }else{
        $.ajax({
            url: base_url+'/calculate_price_ajax',
            type: 'POST',
            data: {
              order_id: order_id,
                weight:weight,
                promo_id:promo_id
            },
            success: function (data) { 
              if(data == "null"){
                $('#quantity').hide();
                  alert('Price not defiend for this weight');
                }else{
              $('#quantity').show();
              var obj = JSON.parse(data);
              $("#sub_total_text").text('$'+obj.sub_total);
                $("#total_text").text('$'+obj.total);
                $("#discount_text").text('$'+obj.promo_amount);
                $("#sub_total").val(obj.sub_total);
                $("#total").val(obj.total);
                $("#discount").val(obj.promo_amount);

              }
            }
        });
    }
}

function send_invoice(){
     var weight = $("#weight").val();
     var order_id = $("#order_id").val();
     var total = $("#total").val();
     var sub_total = $("#sub_total").val();
     var discount = $("#discount").val();
     var base_url = 'http://127.0.0.1:8000/api';
     // var base_url = 'http://eazy-laundry.com/api';
  
        $.ajax({
            url: base_url+'/send_invoice_ajax',
            type: 'POST',
            data: {
              order_id: order_id,
                weight:weight,
                sub_total:sub_total,
                total:total,
                discount:discount,
            },
            success: function (data) { 
              if(data == 1){
            alert("Invoice sent successfully");
            window.location = "/admin/orders";
            }else{
            alert("Something went wrong")

            }
        }
      });
}

</script>