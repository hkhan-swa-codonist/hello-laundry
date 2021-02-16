@include('templates.header')
<!-- HOME START-->
<section class="bg-pages" data-jarallax='{"speed": 0.5}' style="background-image:url({{ asset('web/images/cover_image.jpg') }})">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container page-next-level">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="text-sm-left">
                            <h5 class="title-pager text-uppercase mb-0"> PRIVACY POLICY </h5>
                        </div>
                    </div><!--end col-->

                    <div class="col-sm-6">  
                        <div class="text-sm-right">
                            <ul class="page-two page-next mb-0"><li><a href="/home">Home</a></li><li><span>PRIVACY POLICY</span> </li> </ul>
                        </div>  
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container--> 
        </div>
    </div>
</section>
<!-- HOME END--> 

<!-- Faq Start -->
<section class="g-bg-gray-gradient-opacity-v1">
      <div class="container g-py-100">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <!-- Heading -->
            <div class="text-center g-mb-60">
              <div class="d-inline-block g-width-35 g-height-1 g-bg-primary mb-2"></div>
              <h2 class="g-color-black g-font-weight-600 mb-2">Privacy Policies</h2>
              <p class="lead g-width-60x--md mx-auto">We aim high at being focused on building relationships with our clients and community.</p>
            </div>

                    <div class="accordion" id="accordionExample">
                        @foreach($data as $value)
                        <div class="card border mb-2">
                            <a data-toggle="collapse" href="#collapse{{$value->id}}" class="faq position-relative collapsed" aria-expanded="false" aria-controls="collapse{{$value->id}}">
                                <div class="card-header p-3" id="headingthree">
                                    <h4 class="title mb-0 faq-question">{{$value->title}}</h4>
                                </div>
                            </a>
                            <div id="collapse{{$value->id}}" class="collapse" aria-labelledby="headingthree" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p class="text-muted mb-0 faq-ans">{{$value->description}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- Faq End -->
@include('templates.footer')