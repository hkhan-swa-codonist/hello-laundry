@include('templates.header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- HOME START-->
<style>
    .services .service-four {
    padding: 1%;
    height: 130;
    border-radius: 10px;
}
.list-group-item {
   
     border:none; 
}
.p-10{
    padding:10px!important;
}
.btn-red{
    background-color: red;
}
</style>
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

<!-- Services Start -->
<section class="section pb-less-30 services">
    <div class="container">
        <div class="row" style="padding:10px;">
                     @php
                    $cart_data = Session::get('cart', []);
                @endphp
                  
                    <div class="col-12  col-md-12">
                        <ul class=" list-unstyled">
                            @foreach($data as $key => $value)
                              <?php
                            $checked = '';
                            if(count($cart_data) > 0){
                            if(In_array($value->id, $cart_data[$value->service_id]['category'])){
                                $checked='checked';
                            }else{
                                $checked=''; 
                            }
                        }
                            ?>
                            <li class="mb-2 mr-2 ">
                                <div class="col-lg-12 col-md-12 col-12 mb-4 pb-2">
                                <div class="service-four text-center shadow">
                                    <div class="icon-interior mb-4">
                                    </div>
                                    <div class="content">
                                         <div class="custom-control custom-radio">
                                    <input type="radio" {{$checked}} class="custom-control-input" name="category" id="category_{{$value->id}}" value="{{$value->id}}" onchange="add_to_cart_category({{$value->service_id}});">
                                    <label class="custom-control-label" for="category_{{$value->id}}">{{ $value->category_name }}</label>
                                </div>
                                        <p class="text-muted">{{ $value->description }}</p>

                                    </div>
                                    <div class="col-md-12 text-center" >
                                    
                                </div>
                                </div>
                            </div>
                               
                            </li>
                            @endforeach
                        </ul>
                        <!-- Radio END -->
                </div>
                  <div class="col-md-12 text-right">
            <a onclick="remove_from_cart_category()" class="btn rounded-0 mb-2 mr-2 text-white  btn-red">Remove from cart</a>
            <a href="/services" class="btn rounded-0 mb-2 mr-2 text-white  btn-custom">Back</a>
            
        </div>
               
    </div>

</div><!--end row-->
</div><!--end container-->

</section><!--end section-->

    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />


<!-- Services End -->
@include('templates.footer')
<script>
  function add_to_cart_category(service_id){
        var selected_category = $('input[name=category]:checked').val();
        if(selected_category == undefined){
          alert("please select category");
          return false;  
        }else{
        $.ajax({
            url: '/add_to_cart_category',
            type: 'POST',
            data: {_token: $("#csrf-token").val(), service_id : service_id, category_id:selected_category},
            dataType: 'JSON',
            success: function (data) { 
                if(data == 1){
                    alert("Successfully added");
                    $("#bt_"+category_id).text('Remove From Cart');
                    $("#bt_"+category_id).css({'color':'#FF0000'}); 
                }else{
                    $("#bt_"+category_id).text('Add To Cart');
                    $("#bt_"+category_id).css({'color':'#064ea3'});
                }
            }
        }); 
    }
    }

    function remove_from_cart_category(){
        var selected_category = $('input[name=category]:checked').val();
        var service_id = 1;
        $.ajax({
            url: '/remove_from_cart_category',
            type: 'POST',
            data: {_token: $("#csrf-token").val(), service_id : service_id, category_id:selected_category},
            dataType: 'JSON',
            success: function (data) { 
                if(data == 0 ){
                  alert("Successfully removed");
       window.location = "/services";
                }
            }
        }); 
    }
</script>
