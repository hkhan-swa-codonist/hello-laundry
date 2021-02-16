@include('templates.header')
<section class="bg-pages" data-jarallax='{"speed": 0.5}' style="background-image:url({{ asset('web/images/cover_image.jpg') }})">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container page-next-level">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="text-sm-left">
                            <h5 class="title-pager text-uppercase mb-0">  </h5>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container--> 
        </div>
    </div>
</section>
    <section>
      <div class="container">
        <div class="row" style="margin-top:50px">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
            <h2 class="display-3 text-black">Error Occured</h2>
            <p class="lead">Connection timeout error. Sorry for the inconvenience. </p>
            <p><a href="/profile/orders" class="btn btn-md height-auto px-4 py-3 btn-custom">Back to My Orders</a></p>
          </div>
        </div>
      </div>
    </section>
