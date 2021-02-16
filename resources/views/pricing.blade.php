@include('templates.header')
<style type="text/css">
@media (max-width: 999px) {
#newDiv { 
  background-color: red;
  width: 100%;
  padding-right: 50px;
   margin-right: 0px;
}
.hidden-xs {
  display: none;
  }
}
.text-white{
    color:white;
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
                            <h5 class="title-pager text-uppercase mb-0"> PRICES </h5>
                            <p class="mb-0 text-white" > Prices of items for Dry cleaning or laundry services </p>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container--> 
        </div>
    </div>
</section>
<!-- HOME END--> 

<!-- Faq Start -->
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 col-md-12 mt-sm-30">
                <div class="faq-content">
                    <div class="accordion" id="accordionExample">
                        @php
                            $i=0;
                        @endphp
                        @foreach($data as $key => $value)
                        <div class="card border mb-2">
                            <a data-toggle="collapse" href="#collapse{{ $i }}" class="faq position-relative collapsed" aria-expanded="false" aria-controls="collapse{{ $i }}">
                                <div class="card-header p-3" id="headingthree">
                                    <h4 class="title mb-0 faq-question">{{ $key }}</h4>
                                </div>
                            </a>
                            <div id="collapse{{ $i }}" class="collapse" aria-labelledby="headingthree" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="desktop_view">
                                    @foreach($value as $value1)
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4 col-xs-6">
                                                <h5>{{ $value1->product_name }}</h5>
                                            </div>
                                            <div class="col-md-6 hidden-xs" style="margin-top: 20px;">
                                                <div style="border-bottom: 2px dotted #d70030;"></div>
                                            </div>
                                            <div class="col-md-2 col-xs-6">
                                                <h5>{{ $currency }}{{ $value1->price }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    </div>
                                    <div class="mobile_view">
                                    @foreach($value as $value1)
                                    <div class="row">
                                        <div style="width: 70%;">
                                            <h6>{{ $value1->product_name }}</h6>
                                        </div>
                                        <div style="width: 30%;">
                                            <h5>{{ $currency }}{{ $value1->price }}</h5>
                                        </div>
                                    </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- Faq End -->
@include('templates.footer')
<script>
    if($(window).width() < 999){
        $(".desktop_view").hide();
        $(".mobile_view").show();
    }else{
        $(".mobile_view").hide();
        $(".desktop_view").show();
    }
</script>