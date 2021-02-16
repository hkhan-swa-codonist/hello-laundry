@include('templates.header')
<!-- HOME START-->
<section class="bg-pages" data-jarallax='{"speed": 0.5}' style="background-image:url({{ asset('web/images/cover_image.jpg') }})">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container page-next-level">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="text-sm-left">
                            <h5 class="title-pager text-uppercase mb-0"> FAQ </h5>
                        </div>
                    </div><!--end col-->

                    <div class="col-sm-6">  
                        <div class="text-sm-right">
                            <ul class="page-two page-next mb-0"><li><a href="/home">Home</a></li><li><span>FAQ</span> </li> </ul>
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
            <div class="col-lg-6 col-md-6">
                <img src="{{ asset('web/images/faq.jpg') }}" class="img-fluid mx-auto d-block" alt="">
            </div><!--end col-->

            <div class="col-lg-6 col-md-6 mt-sm-30">
                <div class="faq-content">
                    <div class="accordion" id="accordionExample">
                        @foreach($data as $value)
                        <div class="card border mb-2">
                            <a data-toggle="collapse" href="#collapse{{$value->id}}" class="faq position-relative collapsed" aria-expanded="false" aria-controls="collapse{{$value->id}}">
                                <div class="card-header p-3" id="headingthree">
                                    <h4 class="title mb-0 faq-question">{{$value->question}}</h4>
                                </div>
                            </a>
                            <div id="collapse{{$value->id}}" class="collapse" aria-labelledby="headingthree" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p class="text-muted mb-0 faq-ans">{{$value->answer}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- Faq End -->
@include('templates.footer')