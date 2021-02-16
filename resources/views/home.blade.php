
@include('templates.header')

<style>
    @media (min-width: 1000px) {
        #newDiv {
          background-color: blue;
      }
      .col-xs-3 {
          display: block;
      } 
  }

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
</style>
<section class="section bg-blue header-bg" >
    <div class="container ">
        <div class="row">
            <div class="col-md-7 col-sm-12 col-xs-12" style="margin-top:10%;">
                <center><h2 lass="title top-left" style="color:white;">QUALITY DRY CLEANING & LAUNDRY DELIVERY AT YOU DOOR</h2>
                </center>
                <center><a href="/login" style="width:30%;margin-top: 20px;margin-left: 10px;" class="btn btn-custom rounded-0 mb-2 mr-2">Order Now</a><a href="https://play.google.com/store/apps/details?id=com.menpani.rith_laundry&hl=en_IN" ><img style="margin-top: 15px;" src="{{ asset('web/web_images/play_store.png') }}" alt="missing_logo" height="40"></a></center>
            </div>
                <!-- <div class="col-md-5 hidden-xs">
                    <img src="{{ asset('web/images/user.png') }}" style="width:700px;height: 300px;position: absolute;" class="img-fluid mt-sm-30" alt="img">
                </div> -->
            </div>
        </div>
    </section>


    <!-- Features Start -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="section-title text-center ">
                        <h3 class="title">Hello Laundry  <span> is teamed up with the expert launderettes and dry cleaners</span></h3>
                    </div> <!-- section title -->
                    <p class="text">Save your valuable time & efforts and get ready to have the best hassel free laundry delivery and pickup services near by your areas</p>
                </div>
                
            </div> <!-- row -->
            
            
        </div><!--end container-->
    </section><!--end section-->
    <!-- FEATURES END -->


    <!-- Features Start -->
    <section class="bg-dark ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title text-center pt-lg-5" >
                        <h3 class="title white-text" >HOW IT WORKS</h3>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row align-items-center  mb-lg-5 ">
                <div class="col-md-4 text-center">
                    <div class="features-box ">
                        <img src="{{ asset('web/web_images/step-1.png') }}"  class="img-fluid mt-sm-30" alt="img">
                        <h4><b class="white-text">01.</b><b class="red-text"> Schedule a Collection </b></h4>
                        <p class="white-text mb-lg-5">You can schedule your cloths pickup and delivery date & time. </p>
                    </div>
                </div><!--end col-->
                <div class="col-md-4 text-center">
                   <div class="features-box">
                    <img src="{{ asset('web/web_images/step-2.png') }}"  class="img-fluid mt-sm-30" alt="img">
                    <h4><b class="white-text">02.</b><b class="red-text">  A Deliveryboy Arrives</b> </h4>
                    <p class="white-text mb-lg-5">Our Deliveryboy will pickup and provide your cleaned cloths at right time. </p>
                </div>
            </div><!--end col-->
            <div class="col-md-4 text-center">
               <div class="features-box">
                <img src="{{ asset('web/web_images/step-3.png') }}" class="img-fluid mt-sm-30" alt="img">
                <h4><b class="white-text">03.</b><b class="red-text">  Get Clean Laundry</b></h4>
                <p class="white-text mb-lg-5">We give quality service to our valueable customers. So, you can get clean cloths without failure.</p>
            </div>
        </div><!--end col-->
    </div>
</div><!--end container-->
</section><!--end section-->
<!-- FEATURES END -->

<section id="features" class="services-area pt-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-title text-center pb-40">
                    <h3 class="title">SERVICES</h3>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->
        <div class="row justify-content-center">
            @foreach($data as $key => $value)
            @php
            {{ $image = env('IMG_URL').$value->image; }}
            @endphp
            <a href="#" >
                <div class="col-lg-4 col-md-7 col-sm-8">
                    <div class="single-services text-center" data-wow-duration="1s" data-wow-delay="0.2s">
                        <div class="services-icon">
                            <img class="shape-1" src="{{ $image }}" alt="shape" style="width:50%">
                            <i class="lni-baloon"></i>
                        </div>
                        <div class="services-content mb-lg-5">
                            <h4 class="services-title"><a href="#">{{ $value->service_name }}</a></h4>
                            <p class="text">{{ $value->description }}</p>
                            <a class="more" href="#"><img class="shape-1" src="{{ asset('web/web_images/load_more_one.png') }}" alt="shape"></i></a>
                        </div>
                    </div> <!-- single services -->
                </div>
            </a>
            @endforeach
        </div> <!-- row -->
    </div> <!-- container -->
</section>


<section id="facts" class="video-counter pt-lg-5">
    <div class="container">
       <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="section-title text-center pb-40">
                <h3 class="title">EASY & QUICK</h3>
            </div> <!-- section title -->
        </div>
    </div> <!-- row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="video-content mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="video-wrapper">
                    <div class="video-image">
                        <img  src="{{ asset('web/web_images/easy_quick_one.png') }}" alt="video">
                    </div>
                </div> <!-- video wrapper -->
            </div> <!-- video content -->
        </div>
        <div class="col-lg-6">
            <div class="counter-wrapper" data-wow-delay="0.8s">
                <div class="counter-content">
                    <div class="section-title">
                        <div class="line"></div>
                        <h3 class="title">Download <span> our free mobile app</span></h3>
                    </div> <!-- section title -->
                    <ul class="list-ul">
                      <li>Free same day colection </li>
                      <li>Delivery in less than 24 hours</li>
                  </ul>
              </div> <!-- counter content -->
              <div class="row">
                <div class="col-lg-6">
                    <img  src="{{ asset('web/web_images/play_store.png') }}" alt="video" style="width:100%">
                </div>
                <div class="col-lg-6">
                    <img  src="{{ asset('web/web_images/app_store.png') }}" alt="video" style="width:100%">
                </div>
            </div>
            
        </div> <!-- counter wrapper -->
    </div>
</div> <!-- row -->
</div> <!-- container -->
</section>


<!-- Features Start -->
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-center pt-lg-5" >
                    <h3 class="title" >CUSTOMER REVIEWS</h3>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->
        <div class="row align-items-center  mb-lg-5 ">
            <div class="col-md-3 text-center">
                <div class="features-box ">
                    <img src="{{ asset('web/web_images/blog-1.png') }}"  class="img-fluid mt-sm-30" alt="img">
                    <h6><b >Robert A Thomsan</b></h6>
                    <div class="star text-center">
                        <ul class="p-lg-0">
                            <li><i class="lni-star-filled"></i></li>
                            <li><i class="lni-star-filled"></i></li>
                            <li><i class="lni-star-filled"></i></li>
                            <li><i class="lni-star-filled"></i></li>
                            <li><i class="lni-star-filled"></i></li>
                        </ul>
                    </div>
                    <p class="font-13 mb-lg-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor </p>
                </div>
            </div><!--end col-->
            <div class="col-md-3 text-center">
               <div class="features-box">
                <img src="{{ asset('web/web_images/blog-2.png') }}"  class="img-fluid mt-sm-30" alt="img">
                <h6><b >Joe B. Ayer</b> </h6>
                <div class="star text-center">
                    <ul class="p-lg-0">
                        <li><i class="lni-star-filled"></i></li>
                        <li><i class="lni-star-filled"></i></li>
                        <li><i class="lni-star-filled"></i></li>
                        <li><i class="lni-star-filled"></i></li>
                        <li><i class="lni-star-filled"></i></li>
                    </ul>
                </div>
                <p class="font-13 mb-lg-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor </p>
            </div>
        </div><!--end col-->
        <div class="col-md-3 text-center">
           <div class="features-box">
            <img src="{{ asset('web/web_images/blog-3.png') }}" class="img-fluid mt-sm-30" alt="img">
            <h6><b >Thomas B. Lefevre</b></h6>
            <div class="star text-center">
                <ul class="p-lg-0">
                    <li><i class="lni-star-filled"></i></li>
                    <li><i class="lni-star-filled"></i></li>
                    <li><i class="lni-star-filled"></i></li>
                    <li><i class="lni-star-filled"></i></li>
                    <li><i class="lni-star-filled"></i></li>
                </ul>
            </div>
            <p class="font-13 mb-lg-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
        </div>
    </div><!--end col-->
    <div class="col-md-3 text-center">
       <div class="features-box">
        <img src="{{ asset('web/web_images/blog-4.png') }}" class="img-fluid mt-sm-30" alt="img">
        <h6><b>Ryan B. Wright</b></h6>
        <div class="star text-center">
            <ul class="p-lg-0">
                <li><i class="lni-star-filled"></i></li>
                <li><i class="lni-star-filled"></i></li>
                <li><i class="lni-star-filled"></i></li>
                <li><i class="lni-star-filled"></i></li>
                <li><i class="lni-star-filled"></i></li>
            </ul>
        </div>
        <p class="font-13 mb-lg-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
    </div>
</div><!--end col-->

</div>
</div><!--end container-->
</section><!--end section-->



 <style>

    .list-ul {
      list-style-image: url('../../web/web_images/load_more_one.png');
      padding-bottom:10px;
  }
  .video-counter{

    background-image: linear-gradient(bottom, #094fa3 50%, #ffffff 50%);
    background-image: -o-linear-gradient(bottom, #094fa3 50%, #ffffff 50%);
    background-image: -moz-linear-gradient(bottom, #094fa3 50%, #ffffff 50%);
    background-image: -webkit-linear-gradient(bottom, #094fa3 50%, #ffffff 50%);
    background-image: -ms-linear-gradient(bottom, #094fa3 50%, #ffffff 50%);
}
.white-text{
    color:white!important;
}
.font-13{
    font-size: 13px!important;
}
</style>
@include('templates.footer')
