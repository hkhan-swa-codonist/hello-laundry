@include('templates.header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    .btn.btn-blue {
        background: #409EFF;
        color: white !important;
        white-space: nowrap;
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
    }

    .btn-blue.height {
        height: 48px;
        margin-right: 25%;
    }

    .btn.btn-blue:hover {
        background: #09285b;
    }

    input.largerCheckbox {
        width: 30px;
        height: 30px;
    }

    .active-date-time {
        color: white !important;
        margin: 5px !important;
    }

    .inactive-date-time {
        color: #115e7a !important;
        background-color: white !important;
        border-color: #115e7a !important;
        margin: 5px !important;
        font-weight: bold !important;
    }

    .parent {
        position: relative;
    }

    .child {
        position: absolute;
        left: 50%;
        top: 50%;
        margin-left: -60px;
        margin-top: -60px;
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }

    /*Laundry Form Style*/
    .vue_laundry_form .steps-bar {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .vue_laundry_form .step {
        text-align: center;
        padding-right: 115px;
    }

    .vue_laundry_form .step h3 {
        color: #C0C4CC;
        border: solid 2px #C0C4CC;
        border-radius: 50%;
        height: 28px;
        width: 27px;
        margin: auto;
        padding: 0 6px;
        font-size: 18px;
        position: relative;
        background: white;
    }

    .vue_laundry_form .step.active h3 {
        color: #409EFF;
        border-color: #409EFF;
    }

    .vue_laundry_form .step h3:before {
        content: '';
        position: absolute;
        top: 11px;
        right: 0;
        height: 2px;
        width: 184px;
        background: #C0C4CC;
        z-index: -1;
    }

    .vue_laundry_form .step:first-child h3:before {
        display: none;
    }

    .vue_laundry_form .step.active h3:before {
        background: #409EFF;
    }

    .vue_laundry_form .step h4 {
        color: #C0C4CC !important;
        font-size: 16px;
        line-height: 38px;
    }

    .vue_laundry_form .step.active h4 {
        color: #09285b !important;
        font-size: 16px;
        line-height: 38px;
    }

    .vue-sidebar .v-order-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .vue-sidebar {
        background: white;
        padding: 30px;
        box-shadow: 0 0 20px rgb(219 224 234);
        box-shadow: 0 0 20px rgb(219 224 234 / 60%)
    }

    .vue-sidebar .v-order-box .order-step h4 {
        color: #409EFF;
        font-size: 18px;
    }

    .vue-sidebar .v-order-box .order-edit i {
        color: #409EFF;
    }

    .vue-sidebar .sidebar-title {
        position: relative;
        width: max-content;
        margin: auto;
        margin-bottom: 15px;
    }

    .vue-sidebar .sidebar-title:after {
        content: '';
        position: absolute;
        top: 18px;
        left: -25px;
        width: 20px;
        background: #409EFF;
        height: 2px;
    }

    .vue-sidebar .sidebar-title:before {
        content: '';
        position: absolute;
        top: 18px;
        right: -25px;
        background: #409EFF;
        width: 20px;
        height: 2px;
    }

    hr.dashed {
        border-top: 1px dashed #C0C4CC;
        margin: 10px 0;
    }

    .step-title {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .step-title .first {
        color: black;
        padding-right: 10px;
    }

    .step-title .last {
        color: #409EFF;
    }

    .form-buttons {
        justify-content: space-between;
        display: flex;
    }

    input#postCode {
        width: 80%;
    }

    .vue_laundry_form input, .vue_laundry_form select {
        height: 48px !important;
        box-shadow: 0 0 20px rgb(219 224 234 / 60%) !important;
        border: none !important;
    }

    .vue_laundry_form select, .vue_laundry_form textarea {
        width: 100%;
        box-shadow: 0 0 20px rgb(219 224 234 / 60%) !important;
        border: none !important;
    }

    .services-container .service-box {
        padding: 25px;
        margin: 20px 0;
        transition: all 0.2s linear;
        position: relative;
    }

    .services-container .service-box:hover {
        transform: translateY(-10px);
    }

    .services-container .service-box img {
        width: 120px;
        margin-right: 30px;
    }

    .service-box i.fa {
        padding: 10px 11px;
        background: #09285b;
        border-radius: 50%;
        transition: all 0.2s linear;
        color: white;
        box-shadow: 2px 4px 8px 0px rgb(205 213 230);
        position: absolute;
        top: -18px;
        right: -18px;
        cursor: pointer;
    }

    .service-box i.fa:hover {
        background: #409EFF;
    }

    i.fa-minus {
        display: none;
    }

    .shadow-box {
        box-shadow: 0 0 20px rgb(219 224 234 / 60%);
    }

    .service-box .media-body p {
        width: 90%;
    }

    .added {
        display: none;
    }

    .added.active {
        display: block;
        color: white;
        background: #409EFF;
        padding: 2px 12px;
        width: max-content;
        position: absolute;
        top: 41%;
        right: -20px;
    }

    i.fa-minus.show {
        display: block;
    }

    i.wash {
        display: none;
    }

    i.wash.show {
        display: block;
    }

    .wash-modal .modal-footer {
        justify-content: flex-start;
        border: none;
    }

    .wash-modal .close {
        background: #409EFF;
        color: white;
        width: 36px;
        padding: 6px;
        border-radius: 50%;
        opacity: 1;
        position: absolute;
        top: 20px;
        right: 20px;
    }

    .modal-dialog {
        max-width: 800px;
    }

    ul.services-list {
        list-style: none;
        padding: 0;
    }

    .services-list p {
        color: #6c757d;
        border: 2px dashed #ddd;
        padding: 5px 10px;
        margin-bottom: 8px;
        width: max-content;
    }

    .wash-modal .modal-title {
        font-size: 1.999em;
        margin: auto;
    }
</style>
<!-- HOME START-->
<section class="bg-pages" data-jarallax='{"speed": 0.5}'
         style="background-image:url({{ asset('web/images/cover_image.jpg') }})">
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
<style>
    .services .service-four {
        padding: 1%;
        height: 235px;
        border-radius: 10px;
    }

    .list-group-item {

        border: none;
    }

    .p-10 {
        padding: 10px !important;
    }
</style>
<!-- Services Start -->
<section class="section pb-less-30 services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 mb-4 pb-2">
                <div class="card shadow p-3 bg-white rounded" style="border-radius:10px!important;">
                    <div class="card-body">
                        <p>
                            Please select the service you need. We will weigh or count the items you give us. We will
                            prepare the invoice after we receive your items, you can check our price list or use our
                            price estimator anytime. our minimum order is $20.00</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @php
                $cart_data = Session::get('cart', []);
            @endphp
            @foreach($data as $key => $value)
                @php
                    {{ $image = env('IMG_URL').$value->image; }}
                @endphp
                <?php
                if ($value['is_category'] == 1) {
                    $function_call = "check_category($value->id);";
                } else {
                    $function_call = "add_to_cart($value->id);";

                }
                ?>
                <div class="col-lg-6 col-md-6 col-12 mb-4 pb-2">
                    <div class="service-four text-center shadow">
                        <div class="icon-interior mb-4">
                            <img src="{{ $image }}" class="img-fluid mx-auto d-block" alt="">
                        </div>
                        <div class="content">
                            <h4 class="title text-uppercase">{{ $value->service_name }}</h4>
                            <p class="text-muted">{{ $value->description }}</p>
                            @if($value->is_category == 1)
                                @if(@$cart_data[$value->id])
                                    <a style="color:#FF0000" id="bt_{{$value->id}}"
                                       onclick="check_category({{$value->id}})"> Remove From Cart</i></a>
                                @else
                                    <a style="color:#064ea3" id="bt_{{$value->id}}"
                                       onclick="check_category({{$value->id}})"> Add To Cart</i></a>
                                @endif
                            @else
                                @if(@$cart_data[$value->id])
                                    <a style="color:#FF0000" id="bt_{{$value->id}}" onclick="{{$function_call}}"> Remove
                                        From Cart</i></a>
                                @else
                                    <a style="color:#064ea3" id="bt_{{$value->id}}" onclick="{{$function_call}}"> Add To
                                        Cart</i></a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div><!--end col-->
            @endforeach
        </div><!--end row-->

        <div class="row p-10">
            <div class="form-group">
                <label for="exampleFormControlTextarea2">Any Other Request?</label>
                <div id="modal_detail">
                </div>
                <textarea class="form-control rounded-0" id="any_other_request" name="any_other_request" rows="3"
                          placeholder="Type your request here"></textarea>
            </div>
        </div>

        <div id="laundryForm" class="vue_laundry_form">
            <div class="row">
                <div class="col-md-8">
                    <div class="steps-bar">
                        <div class="step" :class="{active: step == 1 || step == 2 || step ==3 || step==4}">
                            <h3>1</h3>
                            <h4>Address</h4>
                        </div>
                        <div class="step" :class="{active: step == 2 || step ==3 || step==4}">
                            <h3>2</h3>
                            <h4>Services</h4>
                        </div>
                        <div class="step" :class="{active: step ==3 || step==4}">
                            <h3>3</h3>
                            <h4>Collection</h4>
                        </div>
                        <div class="step" :class="{active: step==4}">
                            <h3>4</h3>
                            <h4>Payment</h4>
                        </div>
                    </div>

                    <form id="vLaundryForm" action="">
                        <!--TAB Address-->
                        <div class="address-form" v-show="step == 1">
                            <div class="step-title">
                                <h1 class="first">Address</h1>
                                <h1 class="last">Details</h1>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="form-group">
                                    <label for="postCode">Enter Your Postcode*</label>
                                    <input v-model="laPostcode" type="text" class="form-control" id="postCode"
                                           name="postCode">
                                    {{--<div class="invalid-feedback">Please fill out this field.</div>--}}
                                </div>
                                <span id="get_address_button" class="btn btn-blue height">
                                    Get Address
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="address1">Select Your Address*</label>
                                <select class="marital-select" id="address1" name="address1" required
                                        v-model="laAddress">
                                    <option value="address0" selected>Address of The Post Code City 1</option>
                                    <option value="address1">Address of The Post Code City 2</option>
                                    <option value="address2">Address of The Post Code City 3</option>
                                </select>
                                {{--<div class="invalid-feedback">Please select Marital Status.</div>--}}
                            </div>
                            <div class="form-group">
                                <label for="extraDetails">Please Specify Any Extra Address Details</label>
                                <textarea class="form-control" id="extraDetails" name="extraDetails"
                                          rows="3"></textarea>
                            </div>

                            <div class="form-buttons">
                                <button class="btn btn-blue" @click="nextStep($event,2)" style="margin-left: auto">
                                    Next Step
                                </button>
                            </div>
                        </div>
                        <!--TAB Services-->
                        <div class="address-form" v-show="step == 2">
                            <div class="step-title">
                                <h1 class="first">Services</h1>
                                <h1 class="last">Details</h1>
                            </div>
                            <div class="services-container">
                                <div class="service-box shadow-box">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="<?php echo e(asset('/web/images/service1_icon.svg')); ?>"
                                                 class="media-object">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Wash, Dry and Fold</h4>
                                            <p> 30 ° wash, tumble dried at medium heat, not ironed (priced per load of 6
                                                kg) </p>
                                        </div>
                                    </div>
                                    <div class="added">Added</div>
                                    <i class="fa fa-plus" data-toggle="modal" data-target="#washModal"
                                       @click="washService($event,'add')"></i>
                                    <i class="fa fa-minus" @click="washService($event,'remove')"></i>
                                </div>
                                <div class="service-box shadow-box">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="<?php echo e(asset('/web/images/service1_icon.svg')); ?>"
                                                 class="media-object">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Wash & Iron</h4>
                                            <p> All items will be machine washed, ironed, and deliver on hangers (Priced
                                                per item) </p>
                                        </div>
                                    </div>
                                    <div class="added">Added</div>
                                    <i class="fa fa-plus show" @click="clickService($event,'add','Wash & Iron')"></i>
                                    <i class="fa fa-minus" @click="clickService($event,'remove','Wash & Iron' )"></i>
                                </div>
                                <div class="service-box shadow-box">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="<?php echo e(asset('/web/images/service1_icon.svg')); ?>"
                                                 class="media-object">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Dry cleaning </h4>
                                            <p>Cleaned, ironed, and returned to you on a hanger by default (Priced per
                                                item) </p>
                                        </div>
                                    </div>
                                    <div class="added">Added</div>
                                    <i class="fa fa-plus show" @click="clickService($event,'add','Dry cleaning')"></i>
                                    <i class="fa fa-minus" @click="clickService($event,'remove','Dry cleaning' )"></i>
                                </div>
                                <div class="service-box shadow-box">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="<?php echo e(asset('/web/images/service1_icon.svg')); ?>"
                                                 class="media-object">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Duvets & Bulk Items </h4>
                                            <p> Larger items that require different cleaning process(Up to 72
                                                hours) </p>
                                        </div>
                                    </div>
                                    <div class="added">Added</div>
                                    <i class="fa fa-plus show"
                                       @click="clickService($event,'add','Duvets & Bulk Items')"></i>
                                    <i class="fa fa-minus"
                                       @click="clickService($event,'remove','Duvets & Bulk Items' )"></i>
                                </div>
                                <div class="service-box shadow-box">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="<?php echo e(asset('/web/images/service1_icon.svg')); ?>"
                                                 class="media-object">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Ironing Only </h4>
                                            <p> This items are already washed , we just iron them for you(Priced per
                                                item) </p>
                                        </div>
                                    </div>
                                    <div class="added">Added</div>
                                    <i class="fa fa-plus show" @click="clickService($event,'add','Ironing Only')"></i>
                                    <i class="fa fa-minus" @click="clickService($event,'remove','Ironing Only' )"></i>
                                </div>
                                <div class="service-box shadow-box">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="<?php echo e(asset('/web/images/service1_icon.svg')); ?>"
                                                 class="media-object">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Clothing Alterations </h4>
                                            <p> We offer a range of services including Trouser, Dress, Skirt, Suit,
                                                Jacket and Children’s Clothing. Up to 72 Hours. </p>
                                        </div>
                                    </div>
                                    <div class="added">Added</div>
                                    <i class="fa fa-plus show"
                                       @click="clickService($event,'add','Clothing Alterations')"></i>
                                    <i class="fa fa-minus"
                                       @click="clickService($event,'remove','Clothing Alterations' )"></i>
                                </div>
                                <div class="service-box shadow-box">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="<?php echo e(asset('/web/images/service1_icon.svg')); ?>"
                                                 class="media-object">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Shoe Repairs </h4>
                                            <p> Shoe and boot repair services including zip repairs and rubber sole
                                                replacement (resoling) as well as boot re-heeling.</p>
                                        </div>
                                    </div>
                                    <div class="added">Added</div>
                                    <i class="fa fa-plus show" @click="clickService($event,'add','Shoe Repairs')"></i>
                                    <i class="fa fa-minus" @click="clickService($event,'remove','Shoe Repairs' )"></i>
                                </div>
                            </div>

                            <div class="form-buttons">
                                <a class="btn btn-blue" @click="prevStep($event,1)">
                                    Back
                                </a>
                                <button class="btn btn-blue" @click="nextStep($event,3)">
                                    Next Step
                                </button>
                            </div>
                        </div>
                        <!--TAB Collection-->
                        <div class="address-form" v-show="step == 3">
                            <div class="step-title">
                                <h1 class="first">Collection</h1>
                                <h1 class="last">Details</h1>
                            </div>
                            <div class="collection-form">
                                <div class="form-row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="colOption">Collection Option*</label>
                                            <select class="marital-select" id="colOption" name="colOption" required
                                                    v-model="colOption">
                                                <option value="address0" selected>Address of The Post Code City 1</option>
                                                <option value="address1">Address of The Post Code City 2</option>
                                                <option value="address2">Address of The Post Code City 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-buttons">
                                <a class="btn btn-blue" @click="prevStep($event,2)">
                                    Back
                                </a>
                                <button class="btn btn-blue" @click="nextStep($event,4)">
                                    Next Step
                                </button>
                            </div>
                        </div>
                        <!--TAB Payment-->
                        <div class="address-form" v-show="step == 4">
                            <div class="step-title">
                                <h1 class="first">Payment</h1>
                                <h1 class="last">Details</h1>
                            </div>


                            <div class="form-buttons">
                                <a class="btn btn-blue" @click="prevStep($event,3)">
                                    Back
                                </a>
                                <button class="btn btn-blue" @click="nextStep($event,1)">
                                    Next Step
                                </button>
                            </div>
                        </div>

                    </form>


                </div>

                <div class="col-md-4">
                    <div class="vue-sidebar">
                        <h5 class="sidebar-title text-center">Summary</h5>
                        <div class="v-order-box">
                            <div class="order-step">
                                <h4 @click="toStep($event,1)">Address</h4>
                                {{--<p>Dynamic</p>--}}
                            </div>
                            <div class="order-edit" @click="toStep($event,1)"><i class="fa fa-edit"></i></div>
                        </div>
                        <hr class="dashed">
                        <div class="v-order-box">
                            <div class="order-step">
                                <h4 @click="toStep($event,2)">Services</h4>
                                {{--<p>Dynamic</p>--}}
                                <ul class="services-list">
                                    <li v-for="service in services"><p>${service}</p></li>
                                </ul>
                            </div>
                            <div class="order-edit" @click="toStep($event,2)"><i class="fa fa-edit"></i></div>
                        </div>
                        <hr class="dashed">
                        <div class="v-order-box">
                            <div class="order-step">
                                <h4 @click="toStep($event,3)">Collection</h4>
                                {{--<p>Dynamic</p>--}}
                            </div>
                            <div class="order-edit" @click="toStep($event,3)"><i class="fa fa-edit"></i></div>
                        </div>
                        <hr class="dashed">
                        <div class="v-order-box">
                            <div class="order-step">
                                <h4>Delivery</h4>
                                {{--<p>Dynamic</p>--}}
                            </div>
                            <div class="order-edit"><i class="fa fa-edit"></i></div>
                        </div>
                        <hr class="dashed">
                        <div class="v-order-box">
                            <div class="order-step">
                                <h4 @click="toStep($event,4)">Payment</h4>
                                {{--<p>Dynamic</p>--}}
                            </div>
                            <div class="order-edit" @click="toStep($event,4)"><i class="fa fa-edit"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Area Start-->
            {{--Wash Modal--}}
            <div class="modal fade wash-modal" id="washModal" tabindex="-1" role="dialog"
                 aria-labelledby="washModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Please select your preference for wash</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="services-container">
                                <div class="service-box shadow-box default">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="<?php echo e(asset('/web/images/service1_icon.svg')); ?>"
                                                 class="media-object">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Mixed Wash & Tumble Dry – Up To 6 Kg</h4>
                                            <p> One wash / No color separate (Each 6kg £14.00) </p>
                                        </div>
                                    </div>
                                    <div class="added active">Added</div>
                                    <i class="fa fa-plus wash" @click="washServicePrefer($event,'Mixed','-')"></i>
                                </div>
                                <div class="service-box shadow-box">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="<?php echo e(asset('/web/images/service1_icon.svg')); ?>"
                                                 class="media-object">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Separate Wash & Tumble Dry – Up To 12 Kg</h4>
                                            <p>Requires two washes for dark and light colors (up to 12kg of light and
                                                dark clothes £28.00)</p>
                                        </div>
                                    </div>
                                    <div class="added">Added</div>
                                    <i class="fa fa-plus wash show"
                                       @click="washServicePrefer($event,'Separate','-')"></i>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-blue" @click="washServicePrefer($event,'-','add')"
                                    data-dismiss="modal">
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{--Modal Area End--}}
        </div>
    </div>
    <!--end container-->
    <!--<button type="button" class="btn btn-default" onclick="open_success();">Open</button>-->
    <input type="hidden" id="success_hidden" data-toggle="modal" data-target="#success"/>

</section><!--end section-->

<!-- Modal -->
<div class="modal fade" id="address_model" role="dialog" style="overflow: scroll;overflow-y: scroll;overflow-x:hidden">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-custom" data-dismiss="modal" data-toggle="modal"
                        data-target="#new_address_model">Add Address
                </button>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="address_list">
                @foreach($addresses as $value)
                    <div class="row">
                        <div class="col-md-8 ">
                            <h6>{{ $value->address }}</h6>
                        </div>
                        <div class="col-md-2">
                            <center>
                                <button type="button" class="btn btn-default" data-dismiss="modal"
                                        onclick="choose_address('{{$value->id}}','{{$value->address}}');">Select
                                </button>
                            </center>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="new_address_model" role="dialog"
     style="overflow: scroll;overflow-y: scroll;overflow-x:hidden">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="search-container" style="margin:20px;">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea2">Enter Pincode to Search Address</label>
                                <input class="form-control map-input" placeholder="Search by pincode"
                                       id="search_address" name="search_address" list="address_description"
                                       autocomplete="off" type="text"/>
                                <datalist id="address_description">
                                </datalist>
                                <input type="hidden" name="selected_address" id="selected_address" value=""/>
                                <input type="hidden" name="select_address_text" id="select_address_text" value=""/>
                                <input type="hidden" name="select_address_description" id="select_address_description"
                                       value=""/>
                                <input type="hidden" name="unique_id" id="unique_id" value=""/>
                                <input type="hidden" name="city" id="city" value=""/>
                                <input type="hidden" name="country" id="country" value=""/>
                                <input type="hidden" name="postcode" id="postcode" value=""/>
                            </div>

                            <div class="form-group" id="sub_input" style="display:none;">
                                <input class="form-control map-input" id="search1" name="search1"
                                       list="address_description1" autocomplete="off" type="text"/>
                                <datalist id="address_description1">
                                </datalist>
                            </div>
                            <div id="values_display"
                                 style="display:none; border-style: solid; border-color:rgb(222, 226, 230);padding-bottom:10px">
                                <div class="row" style="padding-top:10px; padding-left:10px">
                                    <div class="col-2">
                                        <label for="exampleFormControlTextarea2">City: </label>
                                    </div>
                                    <div class="col-8">
                                        <label for="exampleFormControlTextarea2" id="text_city"></label>
                                    </div>
                                </div>
                                <div class="row " style="padding-left:10px">
                                    <div class="col-2">
                                        <label for="exampleFormControlTextarea2">Country: </label>
                                    </div>
                                    <div class="col-8">
                                        <label for="exampleFormControlTextarea2" id="text_country"></label>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom:10px; padding-left:10px">
                                    <div class="col-2">
                                        <label for="exampleFormControlTextarea2">Postcode: </label>
                                    </div>
                                    <div class="col-8">
                                        <label for="exampleFormControlTextarea2" id="text_postcode"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding-left:10px!important;">
                                <label for="exampleFormControlTextarea2">Address Type: </label>

                            </div>
                            <div class="row p-10">
                                <select class="selectpicker" id="address_type" style="width: 100%;height: 38px;">
                                    <option selected>Please select address type</option>
                                    <option value="1">Home</option>
                                    <option value="2">Work</option>
                                    <option value="3">Other</option>
                                </select>
                            </div>
                            <div class="row p-10">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea2">Manual Address</label>
                                    <textarea class="form-control rounded-0" id="manual_address" name="manual_address"
                                              rows="3" placeholder="Enter Manual Address here"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--  <div class="search-container" style="margin:20px;">
                             <div class="form-group">
                                 <label for="exampleFormControlTextarea2">Enter Pincode to Search Address</label>
                               <input class="form-control map-input" placeholder="Search by pincode" id="search_address" name="search_address" list="address_description" autocomplete="off" type="text" />
                               <datalist id="address_description">
                               </datalist>
                                   <input type="hidden" name="selected_address" id="selected_address" value="" />
                                   <input type="hidden" name="select_address_text" id="select_address_text" value="" />
                                   <input type="hidden" name="select_address_description" id="select_address_description" value="" />
                                   <input type="hidden" name="unique_id" id="unique_id" value="" />
                                   <input type="hidden" name="city" id="city" value="" />
                                   <input type="hidden" name="country" id="country" value="" />
                                   <input type="hidden" name="postcode" id="postcode" value="" />
                             </div>

                                 <label for="exampleFormControlTextarea2">Address Type</label>
                             <div class="row p-10">
                             <select class="form-select" id="address_type">
                             <option selected>Please Select Address Type</option>
                             <option value="1">Home</option>
                             <option value="2">Work</option>
                             <option value="3">Other</option>
                             </select>
                           </div>
                             <div class="row p-10">
                               <div class="form-group">
                                 <label for="exampleFormControlTextarea2">Manual Address</label>
                                 <textarea class="form-control rounded-0" id="manual_address" name="manual_address" rows="3" placeholder="Enter Manual Address here"></textarea>
                               </div>
                           </div>
                             </div> -->
                    </div>

                </div><!--end row-->
            </div>
            <div class="modal-footer">
                <button type="button" onclick="address_submit();" class="btn btn-info">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<!-- Modal -->
<div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Please Select Your Reference for Wash</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="success" role="dialog" style="overflow: scroll;overflow-y: scroll;overflow-x:hidden">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <center>
                    <h4 class="text-info"><b>ORDER COMPLETE!</b></h4>
                    <h5>Your order is now being processed.</h5>
                    <h5> THANK YOU FOR USING </h5>
                    <img style="margin-top: 15px;" src="{{ asset('web/images/logo.png') }}" alt="missing_logo"
                         height="40">
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>


<!-- Services End -->
@include('templates.footer')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    function view_cart() {
        window.location = "/cart";
    }

</script>

<script>
    $(document).ready(function () {
        var search_address = $('#search_address').val();
        $("#search_address").on("input", function (e) {
            var val = $(this).val();
            if (val === "") return;
            console.log(val);
            var opt = ($("#address_description option[value='" + $('#search_address').val() + "']").attr('id'));
            if (opt === '' || opt === undefined) {
                $.get("https://api.getaddress.io/find/" + val + "?expand=true&api-key=BDlwYLXECkKRiarfDRiKSw29967", function (res) {
                    var datalist = $("#address_description");
                    datalist.empty();
                    console.log(res.addresses);
                    if (res.addresses.length) {
                        for (var i = 0, len = res.addresses.length; i < len; i++) {
                            var option = $('<option></option>', {
                                "value": res.addresses[i]['formatted_address'] + ' ' + res['postcode'].split(" ").join(""),
                                "id": res.addresses[i]['town_or_city'] + ',' + res.addresses[i]['country'] + ',' + res['postcode'] + ',' + res.addresses[i]['formatted_address']
                            });
                            datalist.append(option);
                        }
                    }
                });
            } else if (opt != '') {
                var optArray = opt.split(',');
                var city = optArray[0];
                var country = optArray[1];
                var postcode = optArray[2];
                var formatted_address = optArray[3];
                document.getElementById("values_display").style.display = "block";
                $("#city").val(city);
                $("#text_city").text(city);
                $("#country").val(country);
                $("#text_country").text(country);
                $("#postcode").val(postcode);
                $("#text_postcode").text(postcode);
                $("#select_address_text").val(formatted_address);
                $("#selected_address").val(formatted_address);
                $("#select_address_description").val(formatted_address);
                $("#unique_id").val(postcode);
            }

        });

        $('#get_address_button').click(function () {
            $.ajax(
                {
                    type: "POST",
                    url: "api/address/bypostcode",
                    data: {
                        _token: "{{ csrf_token() }}",
                        postcode: $("#postCode").val(),
                    },
                    success: function (result) {
                        conosle.log("hello");
                    }
                });
        });

        $('.userinfo').click(function () {

            var userid = $(this).data('id');

            // AJAX request
            $.ajax({
                url: 'ajaxfile.php',
                type: 'post',
                data: {userid: userid},
                success: function (response) {
                    // Add response in Modal body
                    $('.modal-body').html(response);

                    // Display Modal
                    $('#empModal').modal('show');
                }
            });
        });
    })
</script>

<script type="text/javascript">

    $('#success').on('hidden.bs.modal', function () {
        window.location.href = "/profile/orders";
    });

    $('#pickup_date_div').datepicker({
        format: 'dd-mm-yyyy',
        startDate: 'today',
        endDate: '+30d'
    })
    $('#pickup_date_div').on('changeDate', function (e) {
        $('#pickup_date').val(
            $('#pickup_date_div').datepicker('getFormattedDate')
        );
        $('#pickup_date_text').text(
            $('#pickup_date').val()
        );
        pickup_time_slot();

    });

    $('#delivery_date_div').datepicker({
        format: 'dd-mm-yyyy',
        startDate: 'today',
        endDate: '+30d'
    });

    $('#delivery_date_div').on('changeDate', function (e) {
        $('#delivery_date').val(
            $('#delivery_date_div').datepicker('getFormattedDate')
        );

        if (Date.parse($('#pickup_date_div').datepicker('getFormattedDate')) >= Date.parse($('#delivery_date_div').datepicker('getFormattedDate'))) {
            $('#delivery_date').val('');
            $('#delivery_date_text').text('');
            $('#deliver_time').html('');
            $('#delivery_time').val('');
            alert("please select some other date");
        } else {
            $('#delivery_date_text').text(
                $('#delivery_date').val()
            );
            delivery_time_slot();

        }
    });

    $('#pickup_time').timepicker();

    $('.pickup_date').datepicker({
        format: 'mm-dd-yyyy',
        startDate: 'today',
    });

    $('.delivery_date').datepicker({
        format: 'mm-dd-yyyy',
        startDate: '+2d',
    });


    function open_success() {
        $("#success_hidden").click();
    }


    function selectTab(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    $("#tab_title_address").click();

    function current_address(address) {
        $("#current_address").val(address);
    }

    function address_next() {
        if ($("#address").val() != '') {
            $("#tab_title_pickup_date").click();
        } else {
            alert('Please select address');
        }
    }

    function date_pickup_next() {
        // if($("#pickup_date").val() != '' && ("#pickup_time").val() != ''){
        $("#tab_title_delivery_date").click();
        // }else{
        // alert('Please select date and time');
        // }
    }

    function date_delivery_next() {
        // if($("#delivery_date").val() != '' && ("#delivery_time").val() != ''){
        $("#tab_title_payment").click();
        // }else{
        // alert('Please select delivery date and time');
        // }
    }

    function pickup_time_slot() {
        var pickupdate = $("#pickup_date").val();

        if (pickupdate != '') {
            // alert(pickupdate);
            $.ajax({
                url: '/get_pickup_time_slot',
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    date: pickupdate
                },
                success: function (html_data) {
                    $('#pick_time').html(html_data);
                }
            });
        } else {
            // alert("none");
        }
    }

    function delivery_time_slot() {
        var deliverydate = $("#delivery_date").val();
        if (deliverydate != '') {
            // alert(deliverydate);
            $.ajax({
                url: '/get_delivery_time_slot',
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    date: deliverydate
                },
                success: function (html_data) {
                    $('#deliver_time').html(html_data);

                }
            });
        } else {
            // alert("none");
        }
    }

    function add_pickup_time(time) {
        $("#pickup_time").val(time);
        $("#pickup_time_text").text(time);
    }

    function add_delivery_time(time) {
        $("#delivery_time").val(time);
        $("#delivery_time_text").text(time);

    }

    function total_next() {
        $("#tab_title_payment").click();
    }


</script>
<script>
    var dt = new Date();
    var yyyy = dt.getFullYear().toString();
    var mm = (dt.getMonth() + 1).toString(); // getMonth() is zero-based
    var dd = dt.getDate().toString();
    var min = yyyy + '-' + (mm[1] ? mm : "0" + mm[0]) + '-' + (dd[1] ? dd : "0" + dd[0]); // padding
    $('#delivery_date').prop('min', min);


    $(function () {
        $("#datepicker").datepicker();
    });

    function add_to_cart(service_id) {
        $.ajax({
            url: 'add_to_cart',
            type: 'POST',
            data: {_token: $("#csrf-token").val(), service_id: service_id},
            dataType: 'JSON',
            success: function (data) {
                if (data == 1) {
                    $("#bt_" + service_id).text('Remove From Cart');
                    $("#bt_" + service_id).css({'color': '#FF0000'});
                } else {
                    $("#bt_" + service_id).text('Add To Cart');
                    $("#bt_" + service_id).css({'color': '#064ea3'});
                }
            }
        });
    }

    function check_category(service_id) {
        window.location = "category/" + service_id;
        // $("#exampleModalCenter").modal();
        //   $.ajax({
        //     url: '/check_category',
        //     type: 'POST',
        //     data: {_token: $("#csrf-token").val(), service_id : service_id},
        //     dataType: 'JSON',
        //     success: function (html_data) { 
        //       $('#modal_detail').html(html_data);//selector are not valid you are missing to add # at the beginning 
        //     $('#exampleModalCenter').modal("show");  

        //     }
        // }); 
    }


    function payment_submit() {
        window.location = "/payment";

    }

</script>

<script type="text/javascript">

    $('#success').on('hidden.bs.modal', function () {
        window.location.href = "/profile/orders";
    });


    function address_submit() {
        var customer_id = '{{ Auth::id() }}';
        var address = $("#selected_address").val();
        var unique_id = $("#unique_id").val();
        var address_id = $("#address_id").val();
        var city = $("#city").val();
        var country = $("#country").val();
        var postcode = $("#postcode").val();
        var manual_address = $("#manual_address").val();
        var address_type = document.querySelector('#address_type').value;
        if (manual_address == "") {
            alert('Please enter manual address');
            return false;
        } else if (address == "") {
            alert('Please choose address');
            return false;
        } else if (address_type == "") {
            alert('Please choose address type');
            return false;
        } else {
            if (address_id == '' || address_id == undefined) {
                $.ajax({
                    url: '/save_address',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        customer_id: customer_id,
                        unique_id: unique_id,
                        address: address,
                        city: city,
                        country: country,
                        postcode: postcode,
                        manual_address: manual_address,
                        type: address_type,
                    },
                    success: function (data) {
                        $('#new_address_model').modal('hide');
                        document.getElementById("values_display").style.display = "none";
                        document.getElementById("sub_input").style.display = "none";
                        $('#search').val('');
                        $('#search1').val('');
                        $('#selected_address').val('');
                        $('#select_address_description').val('');
                        $('#select_address_text').val('');
                        $('#unique_id').val('');
                        $('#city').val('');
                        $('#country').val('');
                        $('#postcode').val('');
                        $('#manual_address').val('');
                        var obj = JSON.parse(data);
                        $("#address_list").append('<div class="row"><div class="col-md-8 "><h6>' + obj.address + '</h6></div><div class="col-md-2"><center><button type="button" class="btn btn-default" data-dismiss="modal" onclick="choose_address(' + "'" + obj.id + "'" + ',' + "'" + obj.address + "'" + ');">Select</button></center></div></div><hr>');
                        $('#address_model').modal('show');
                        //window.location = "/profile/address";
                    }
                });
            } else {
                $.ajax({
                    url: '/edit_address',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        customer_id: customer_id,
                        customer_address: $("#customer_address").val(),
                        address_id: address_id,
                        unique_id: unique_id,
                        address: address,
                        city: city,
                        country: country,
                        postcode: postcode,
                        manual_address: manual_address,
                        type: address_type
                    },
                    success: function (data) {
                        $('#new_address_model').modal('hide');
                        document.getElementById("values_display").style.display = "none";
                        $('#selected_address').val('');
                        $('#select_address_description').val('');
                        $('#select_address_text').val('');
                        $('#unique_id').val('');
                        $('#city').val('');
                        $('#country').val('');
                        $('#postcode').val('');
                        $('#manual_address').val('');
                        window.location = "/profile/address";
                    }
                });
            }
        }
    }


</script>
<script>
    var dt = new Date();
    var yyyy = dt.getFullYear().toString();
    var mm = (dt.getMonth() + 1).toString(); // getMonth() is zero-based
    var dd = dt.getDate().toString();
    var min = yyyy + '-' + (mm[1] ? mm : "0" + mm[0]) + '-' + (dd[1] ? dd : "0" + dd[0]); // padding
    $('#delivery_date').prop('min', min);


    $(function () {
        $("#datepicker").datepicker();
    });

    function check_order_count() {
        var address = $("#address").val();
        var delivery_date = $("#delivery_date").val();
        var delivery_time = $("#delivery_time").val();
        var pickup_date = $("#pickup_date").val();
        var pickup_time = $("#pickup_time").val();
        var delivery_date = $("#delivery_date").val();
        if (address == "") {
            alert('Please choose address');
            return false;
        } else if (pickup_date == "") {
            alert('Please choose  pickup date');
            return false;
        } else if (pickup_time == "") {
            alert('Please choose  pickup time');
            return false;
        } else if (delivery_date == "") {
            alert('Please choose delivery date');
            return false;
        } else if (delivery_time == "") {
            alert('Please choose  delivery time');
            return false;
        } else {
            $.ajax({
                url: '/check_order_count',
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    pickup_date: pickup_date,
                    pickup_time: pickup_time,
                    delivery_date: delivery_date,
                    delivery_time: delivery_time,
                },
                success: function (data) {
                    var obj = JSON.parse(data);
                    if (obj.status == 1) {
                        check_payment();
                    } else {
                        alert(obj.message);
                    }
                }
            });
        }
    }

    function check_payment() {
        var payment_method = $('input[name=payment]:checked').val();
        if (payment_method == 1) {
            checkout();
        } else {
            check_card_availability();
        }
    }


    function checkout() {
        var address = $("#address").val();
        var delivery_date = $("#delivery_date").val();
        var delivery_time = $("#delivery_time").val();
        var pickup_date = $("#pickup_date").val();
        var pickup_time = $("#pickup_time").val();
        var any_collection_instruction = $("#any_collection_instruction").val();
        var any_delivery_instruction = $("#any_delivery_instruction").val();
        var any_other_request = $("#any_other_request").val();
        var customer_id = '{{ Auth::id() }}';
        var payment_method
            = $('input[name=payment]:checked').val();
        if (address == "") {
            alert('Please choose address');
            return false;
        } else if (pickup_date == "") {
            alert('Please choose  pickup date');
            return false;
        } else if (pickup_time == "") {
            alert('Please choose  pickup time');
            return false;
        } else if (delivery_date == "") {
            alert('Please choose  delivery date');
            return false;
        } else if (delivery_time == "") {
            alert('Please choose  pickup time');
            return false;
        } else {
            $.ajax({
                url: '/checkout',
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    customer_id: customer_id,
                    address_id: address,
                    pickup_date: pickup_date,
                    pickup_time: $("#pickup_time").val(),
                    delivery_date: delivery_date,
                    delivery_time: $("#delivery_time").val(),
                    payment_mode: payment_method,
                    other_requests: any_other_request,
                    collection_instructions: any_collection_instruction,
                    delivery_instructions: any_delivery_instruction,
                },
                success: function (data) {
                    if (data == 1) {
                        window.location = "/payment";
                        // window.location = "/thankyou";
                    }
                }
            });
        }
    }

    function choose_address(id, address) {
        $("#address").val(id);
        $("#address_text").text(address);
        /*document.getElementById("address_btn").style.display = "none";
        document.getElementById("checkout_btn").style.display = "block";*/
    }
</script>
<script>
    var app = new Vue({
        delimiters: ['${', '}'],
        el: '#laundryForm',
        data: {
            step: 1,
            services: [],
            preferance: 'Mixed',
            laPostcode: '',
            laAddress: '',


        },
        filters: {},
        computed: {},
        methods: {
            nextStep: function (e, step) {
                var self = this;
                e.preventDefault();
//                var formId = jQuery('#laundryForm').offset().top;
                self.step = step;
            },
            prevStep: function (e, step) {
                var self = this;
                e.preventDefault();
//                var formId = jQuery('#laundryForm').offset().top;
                self.step = step;
//                window.scrollTo(0, formId);
            },
            toStep: function (e, step) {
                var self = this;
                e.preventDefault();
                self.step = step;
            },
            clickService: function (e, action, service) {
                var self = this;
                if (action == 'add') {
                    jQuery(e.target).siblings('.added').addClass('active');
                    jQuery(e.target).siblings('i.fa-minus').addClass('show');
                    self.services.push(service);
                }
                if (action == 'remove') {
                    jQuery(e.target).removeClass('show');
                    jQuery(e.target).siblings('.added').removeClass('active');
                    var ind = self.services.indexOf(service);
                    if (ind > -1) {
                        self.services.splice(ind, 1);
                    }
                }


            },
            washService: function (e, action) {
                var self = this;
                var text = 'Wash, Dry and Fold - ';
                if (action == "add") {
                    jQuery(e.target).siblings('.added').addClass('active');
                    jQuery(e.target).siblings('i.fa-minus').addClass('show');
                }
                if (action == "remove") {
                    jQuery(e.target).removeClass('show');
                    jQuery(e.target).siblings('.added').removeClass('active');
                    text = text + self.preferance;
                    var ind = self.services.indexOf(text);
                    if (ind > -1) {
                        self.services.splice(ind, 1);
                    }
//                    self.preferance = 'Mixed';
//                    jQuery('#washModal').children('.service-box.default').children('.added').addClass('active');
//                    jQuery('#washModal').children('.service-box.default').children('.added').siblings('.wash').removeClass('show');
//                    jQuery('#washModal').children('.service-box.default').siblings('.service-box').children('.added').removeClass('active');
//                    jQuery('#washModal').children('.service-box.default').siblings('.service-box').children('.added').siblings('.wash').addClass('show');

                }

            },
            washServicePrefer: function (e, prefer, action) {
                var self = this;
                var text = 'Wash, Dry and Fold - ';
                if (prefer == 'Separate') {
                    jQuery(e.target).removeClass('show');
                    jQuery(e.target).siblings('.added').addClass('active');
                    jQuery(e.target).parent('.service-box').siblings('.service-box').children('i.fa').addClass('show');
                    jQuery(e.target).parent('.service-box').siblings('.service-box').children('.added').removeClass('active');
                    text = text + self.preferance;
                    self.preferance = prefer;
                    var ind = self.services.indexOf(text);
                    if (ind > -1) {
                        self.services.splice(ind, 1);
                    }
                }
                if (prefer == 'Mixed') {
                    jQuery(e.target).removeClass('show');
                    jQuery(e.target).siblings('.added').addClass('active');
                    jQuery(e.target).parent('.service-box').siblings('.service-box').children('i.fa').addClass('show');
                    jQuery(e.target).parent('.service-box').siblings('.service-box').children('.added').removeClass('active');
                    text = text + self.preferance;
                    self.preferance = prefer;
                    var ind = self.services.indexOf(text);
                    if (ind > -1) {
                        self.services.splice(ind, 1);
                    }
                }
                if (action == 'add') {
                    text = text + self.preferance;
                    self.services.push(text);
                }

            }
//            validateEmail: function (value) {
//                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)) {
//                    return true;
//                } else {
//                    return false;
//                }
//            },
//            hasNumber: function (myString) {
//                return /\d/.test(myString);
//            }
        },
        mounted: function () {
            var self = this;
        }
    });
</script>