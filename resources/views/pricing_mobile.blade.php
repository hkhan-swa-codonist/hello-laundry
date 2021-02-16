
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>IWash</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Premium Bootstrap 4 Landing Page Template" />
        <meta name="keywords" content="bootstrap 4, premium, marketing, multipurpose" />
        <meta content="Shreethemes" name="author" />
        <!-- favicon -->
        <link rel="shortcut icon" href="images/favicon.ico">
        <!-- BOOTSTRAP -->
        <link href="{{ asset('web/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Magnific -->
        <link href="{{ asset('web/css/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
        <!-- ICONS -->
        <link href="{{ asset('web/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('web/css/fontawesome.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('web/css/pe-icon-7-stroke.css') }}" rel="stylesheet" type="text/css" />          
        <!-- SLICK SLIDER -->
        <link rel="stylesheet" href="{{ asset('web/css/owl.carousel.min.css') }}"/> 
        <link rel="stylesheet" href="{{ asset('web/css/owl.theme.css') }}"/> 
        <link rel="stylesheet" href="{{ asset('web/css/owl.transitions.css') }}"/> 
        <!-- Animate -->
        <link href="{{ asset('web/css/aos.css') }}" rel="stylesheet">
        <!-- CSS -->
        <link href="{{ asset('web/css/style.css') }}" rel="stylesheet" type="text/css" />

        <style type="text/css">
         a:hover {
          cursor:pointer;
         }
        </style>

    </head>

    <body>
        <!-- Loader -->
        <!--<div id="preloader">
            <div id="status">
                <div class="sk-cube-grid">
                    <div class="sk-cube sk-cube1"></div>
                    <div class="sk-cube sk-cube2"></div>
                    <div class="sk-cube sk-cube3"></div>
                    <div class="sk-cube sk-cube4"></div>
                    <div class="sk-cube sk-cube5"></div>
                    <div class="sk-cube sk-cube6"></div>
                    <div class="sk-cube sk-cube7"></div>
                    <div class="sk-cube sk-cube8"></div>
                    <div class="sk-cube sk-cube9"></div>
                </div>
            </div>
        </div>-->
        
        <!-- Navigation Bar-->
        
        <!-- End Navigation Bar-->
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
</style>
<!-- Faq Start -->
<section class="section">
    <div class="container">
        <!--<div class="row">
            <div class="col-md-12" style="text-align:center;">
                <h1 style="color:#115e7a;" >Pricing.</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="text-align:center;">
                <h1 style="color:#115e7a;" >You'll love it.</h1>
            </div>
        </div>-->
        <div style="margin-top: -20px;"></div>
        @foreach($data as $key => $value)
        <div style="margin:20px;"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center mt-sm-30">
                    <h3 class="title text-uppercase mb-5">{{ $key }}</h3>
                </div>
            </div><!--end col-->
        </div><!--end row-->
        <div class="desktop_view">
        @foreach($value as $value1)
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 col-xs-6">
                    <h5 style="margin-left: 10px;">{{ $value1->product_name }}</h5>
                </div>
                <div class="col-md-6 hidden-xs" style="margin-top: 20px;">
                    <div style="border-bottom: 2px dotted #115e7a;"></div>
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
            <div style="width: 80%;">
                <h6 style="margin-left: 10px;">{{ $value1->product_name }}</h6>
            </div>
            <div style="width: 20%;">
                <h5>{{ $currency }}{{ $value1->price }}</h5>
            </div>
        </div>
        @endforeach
        </div>
        @endforeach
    </div><!--end container-->
</section><!--end section-->
<!-- Faq End -->
        <!-- Back to top -->    
        <a href="#" class="back-to-top" id="back-to-top"> 
            <i class="mdi mdi-chevron-up"> </i> 
        </a>
        <!-- Back to top -->
        
        <!-- javascript -->
        <script src="{{ asset('web/js/jquery.min.js') }}"></script>
        <script src="{{ asset('web/js/bootstrap.bundle.min.js') }}"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <!-- easing -->
        <script src="{{ asset('web/js/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('web/js/scrollspy.min.js') }}"></script>        
        <!-- Menu -->
        <script src="{{ asset('web/js/menu.js') }}"></script>
        <!-- Portfolio -->
        <script src="{{ asset('web/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('web/js/isotope.js') }}"></script>
        <script src="{{ asset('web/js/portfolio-filter.js') }}"></script>      
        <!-- Animate js -->
        <script src="{{ asset('web/js/aos.js') }}"></script>
        <script src="{{ asset('web/js/aos.init.js') }}"></script> 
        <!-- Comingsoon -->
        <script src="{{ asset('web/js/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('web/js/countdown.init.js') }}"></script>    
        <!-- Parallax js -->
        <script src="{{ asset('web/js/parallax.js') }}"></script>
        <!-- SLIDER -->
        <script src="{{ asset('web/js/owl.carousel.min.js') }} "></script>
        <script src="{{ asset('web/js/owlcarousel.init.js') }} "></script>
        <!-- BackSlideShow -->
        <script src="{{ asset('web/js/jquery.backstretch.min.js') }}"></script>    
        <script src="{{ asset('web/js/backstretch.init.js') }}"></script>    
        <!-- Datepicker -->
        <script src="{{ asset('web/js/moment.js') }}"></script> 
        <script src="{{ asset('web/js/bootstrap-datetimepicker.js') }}"></script> 
        <script src="{{ asset('web/js/bootstrap-datepicker.min.js') }}"></script>    
        <script src="{{ asset('web/js/datetimepicker.init.js') }}"></script>    
        <script src="{{ asset('web/js/datepicker-autoclose.init.js') }}"></script> 
        <!-- Main Js -->
        <script src="{{ asset('web/js/app.js') }}"></script>
    </body>

</html>
<script>
    if($(window).width() < 999){
        $(".desktop_view").hide();
        $(".mobile_view").show();
    }else{
        $(".mobile_view").hide();
        $(".desktop_view").show();
    }
</script>