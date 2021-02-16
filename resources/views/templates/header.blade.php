 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>{{ env('APP_NAME') }}</title>
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
  <!--====== Line Icons CSS ======-->
  <link rel="stylesheet" href="{{ asset('web/css/LineIcons.css') }}">

  <!-- <link href="{{ asset('web/css/bootstrap-datetimepicker.css') }}" rel="stylesheet" />           -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.2.0/css/bootstrap-timepicker.css" rel="stylesheet">
  <script src="{{ asset('web/js/jquery.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.2.0/js/bootstrap-timepicker.js"></script>
</head>
<style type="text/css">
 a:hover {
  cursor:pointer;
}
.header-link ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
}

.header-link li {
  float: left;
}

.header-link li a {
  display: block;
  color: white!important;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.header-link li a span:hover {
 color: #000000!important;
}
.header-link li a i:hover {
 color: #000000!important;
}
.font-12{
  font-size: 14px;
}
.header-img-custom{
  width:120%;
}
.pad-10{
  padding:10px!important;
}
.no-right-padding{
  padding-right: 0px!important;
}
</style>

</head>

<body>
  <style>
  </style>
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
          <!-- Logo container-->
          
          <header id="topnav" class="defaultscroll fixed-top navbar-sticky sticky">
            <div style="height:50px; width:100%; margin:0px!important;" class="row bg-dark">
              <div class="container">
                <div class="row no-right-padding">
                  <div class="col-md-12 header-link no-right-padding" >
                   <ul style="margin:auto; float:right">
                     <li>
                      <a role="button">
                        <i class="white-text fas fa-envelope"></i>
                        <span class="white-text  font-12" >info@hellolaundry.co.uk</span>
                      </a>
                    </li>
                    <li>
                     <a  role="button no-right-padding">
                      <i class="white-text  fas fa-phone"></i>
                      <span class="white-text font-12">01708 252143</span>
                    </a>
                  </li>

                </ul>
              </div>

            </div>
          </div>
        </div>
        <div class="container">

          <div>
            <a href="/pricing" class="logo">
              <img src="{{ asset('web/web_images/logo.png') }}" class="logo-img" alt="LAUNDER HUT" >
              <!-- <span style="font-size: 14px; ">{{ env('APP_NAME') }}</span> -->
            </a>
          </div>
          <!-- End Logo container-->
          <div class="menu-extras">
            <div class="menu-item">
              <!-- Mobile menu toggle-->
              <a class="navbar-toggle">
                <div class="lines">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
              </a>
              <!-- End mobile menu toggle-->
            </div>
          </div>
          @if(Auth::id())
          <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">
                     <li class="has-submenu">
                        <a href="/">HOW IT WORKS</a>
                      </li>
                      <li class="has-submenu">
                        <a href="services">Order Laundry</a>
                      </li>
                    <!-- <li class="has-submenu">
                        <a href="/my_cards">My Cards</a>
                    </li> -->
                    <!--<li class="has-submenu">
                        <a href="/faq">Help</a>
                      </li>-->
                      <li class="has-submenu">
                        <a>{{ Auth::user()->customer_name }}</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                          <li><a href="/profile/profile" > Profile</a></li>
                          <li><a href="/profile/orders"> My Orders</a></li>
                          <li><a href="/profile/address" id="address_tab" > Address</a></li>
                        </ul>
                      </li>
                     <!--  <li class="has-submenu">
                        <a class="nav-link dropdown-toggle arrow-none" href="/cart" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <i class="fas fa-shopping-cart noti-icon"></i>
                        <sup><span class="shop-cart" id="cart_count" >{{ count(Session::get('cart', [])) }}</span></sup>
                      </a>
                    </li> -->
                    <li class="has-submenu">
                     <a href="/logout">Logout</a>
                   </li>
                 </ul>
                 <!-- End navigation menu-->
               </div>
               @else
               <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                 <li class="has-submenu">
                  <a href="/home">Home</a>
                </li>
               <!--  <li class="has-submenu">
                  <a href="/pricing">Pricing</a>
                </li> -->
                <li class="has-submenu">
                  <a href="/login">Login</a>
                </li>
              </ul>
              <!-- End navigation menu-->
            </div>
            @endif


          </div>
        </header>
        <!-- End Navigation Bar-->
