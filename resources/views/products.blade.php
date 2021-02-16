@include('templates.header')
<!-- HOME START-->
<section class="bg-pages" data-jarallax='{"speed": 0.5}' style="background-image:url({{ asset('web/images/cover_image.jpg') }})">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container page-next-level">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="text-sm-left">
                            <h5 class="title-pager text-uppercase mb-0"> Products </h5>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container--> 
        </div>
    </div>
</section>
<!-- HOME END--> 

<section class="section bg-white">
    <div class="container"> 

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <ul class="col container-filter portfolioFilter list-unstyled mb-0 text-center" id="filter" data-aos="fade-up">
                        <li class="list-inline-item mb-2"><a class="categories rounded-pill pl-3 pr-3 active" data-filter="*">All</a></li>

                     @foreach($data as $key => $value)
                            <li class="list-inline-item mb-2" id="cat_{{ $key }}"><a class="categories rounded-pill pl-3 pr-3" data-filter=".{{$value->category_name}}">{{ $value->category_name}}</a></li>
                    @endforeach
                </ul>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->

    <div class="container mt-5">
        <div class="port portfolio-masonry">
            <div class="portfolioContainer row" data-aos="fade-up">
                @php
                    $cart_data = Session::get('cart', []);
                @endphp
                @foreach($data as $key => $value)
                    
                    @foreach($value['product'] as $key1 => $product)
                    <?php
                        if(@$cart_data[$service_id.'-'.$product->id]){
                            $qty_count = $cart_data[$service_id.'-'.$product->id]['qty'];
                        }else{
                            $qty_count = 0;
                        }
                    ?>
                    @php
                        {{ $image = env('IMG_URL').$product->image; }}
                    @endphp
                    <div class="col-md-6 {{$value->category_name}} ">
                        <div class="portfolio-box p-2">
                            <div class="thumb float-left mr-4">
                                <img src="{{ $image }}" class="img-fluid img-thumbnail rounded" alt="img">
                            </div>
                            <div class="menu-content">
                                <h4 class="mb-1 pb-2 border-bottom text-capitalize"><a href="#" class="text-dark">{{ $product->product_name }}</a> <span>{{ $currency }}{{ $product->price }}</span></h4>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="quant[{{ $product->id }}]">
                                      <i class="fa fa-minus fa-400px"></i>
                                    </button>
                                    </span>
                                    <input type="text" onchange="add_to_cart({{$product->id}},{{$service_id}},{{$product->price}} );" name="quant[{{ $product->id }}]" id="quant_{{ $product->id }}" style="width: 60px;height:30px;text-align: center;margin-top: 5px;" class="input-number" value="{{ $qty_count }}" min="0" max="100">
                                    <span class="input-group-btn">
                                  <button type="button"  class="btn btn-default btn-number" data-type="plus" data-field="quant[{{ $product->id }}]">
                                      <i class="fa fa-plus fa-400px"></i>
                                    </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->
                    @endforeach
                @endforeach
            </div><!--end row-->
            <!-- end portfoliocontainer-->
        </div>
    </div><!--end container-->
    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
</section><!--end section-->
<!-- MENU END -->

<section class="section bg-white">
    <div class="container"> 
        <div class="row">
           <div class="col-lg-6"></div>
           <div class="col-lg-6 text-right">
                <a href="/cart" class="btn btn-custom">View Cart</a>
            </div><!--end col-->
        </div>
    </div>
</section>


@include('templates.footer')

<script>
$(document).ready(function() { 
    var posts = $(".initial")
    posts.hide();
});

function add_to_cart(product_id,service_id,price){

    var qty = $("#quant_"+product_id).val();
    $.ajax({
        url: '/add_to_cart',
        type: 'POST',
        data: {_token: $("#csrf-token").val(), qty:qty, product_id:product_id, service_id:service_id, price:price},
        dataType: 'JSON',
        success: function (data) { 
            $("#cart_count").text(data);
        }
    }); 
}
</script>

<script>

$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>