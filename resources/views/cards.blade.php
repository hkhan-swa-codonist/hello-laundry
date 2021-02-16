@include('templates.header')
<link rel="stylesheet" href="{{ asset('card/DatPayment.css') }}"/>
<link rel="stylesheet" href="{{ asset('card/example.css') }}"/>
<style>
    .StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>
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
                            <ul class="page-two page-next mb-0"><li><a href="/home">Home</a></li><li><span>My Cards</span> </li> </ul>
                        </div>  
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container--> 
        </div>
    </div>
</section>
<!-- HOME END--> 
<div class="col-md-12">
    <div class="row">
    <div class="col-md-6">
        <div style="margin-top:30px;"></div>
        @foreach($my_cards as $value)
        <div class="list-group mb-3">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 text-theme">XXXX-XXXX-XXXX-{{$value->last_four}}</h5>
              
              <button type="button" onclick="window.location='{{ url("/delete_card/$value->id") }}'" class="btn btn-custom" >Delete</button>
            </div>
        </div>
        @endforeach
        @if(!count($my_cards))
            <center><h5 class="mb-1 text-theme">You card list is empty</h5></center>
        @endif
    </div>
    <div class="col-md-6">
        <form action="/" method="POST" id="payment-form" class="datpayment-form">
            <div class="dpf-title">
                Add Card
                <div class="accepted-cards-logo"></div>
            </div>
            <div class="dpf-card-placeholder"></div>
            <div class="dpf-input-container">
                <div class="dpf-input-row">
                    <label class="dpf-input-label">Number</label>
                    <div class="dpf-input-container with-icon">
                        <span class="dpf-input-icon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                        <input type="text" class="dpf-input" size="20" data-type="number">
                    </div>
                </div>

                <div class="dpf-input-row">
                    <div class="dpf-input-column">
                        <input type="hidden" size="2" data-type="exp_month" placeholder="MM">
                        <input type="hidden" size="2" data-type="exp_year" placeholder="YY">

                        <label class="dpf-input-label">Expiry</label>
                        <div class="dpf-input-container">
                            <input type="text" class="dpf-input" data-type="expiry">
                        </div>
                    </div>
                    <div class="dpf-input-column">
                        <label class="dpf-input-label">CVC</label>
                        <div class="dpf-input-container">
                            <input type="text" class="dpf-input" size="4" data-type="cvc">
                        </div>
                    </div>
                </div>

                <div class="dpf-input-row">
                    <label class="dpf-input-label">Name</label>
                    <div class="dpf-input-container">
                        <input type="text" size="4" class="dpf-input" data-type="name">
                    </div>
                </div>

                <button type="submit" class="dpf-submit">
                        <span class="btn-active-state">
                            Submit
                        </span>
                        <span class="btn-loading-state">
                            <i class="fa fa-refresh "></i>
                        </span>
                </button>
            </div>
        </form>
    </div>
</div>
<div class="col-lg-12 col-md-6 mt-sm-30">



</div>

<script>
    function add_card(data){
        $.ajax({
          url: '/add_card',
          type: 'POST',
          data: {
              _token: "{{ csrf_token() }}", 
              number:data.number, 
              expiry_month:data.expiry_month, 
              cvc:data.cvc, 
              expiry_year:data.expiry_year
          },
          success: function (data) { 
              if(data == 1){
                  window.location = "/my_cards";
              }else{
                  alert('Sorry something went wrong');
              }
          }
       });
    }
</script>
<script>
// Create a Stripe client.
var stripe = Stripe("{{ env('STRIPE_KEY') }}");

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="{{ asset('card/DatPayment.js') }}"></script>
<script type="text/javascript">
    var payment_form = new DatPayment({
        form_selector: '#payment-form',
        card_container_selector: '.dpf-card-placeholder',

        number_selector: '.dpf-input[data-type="number"]',
        date_selector: '.dpf-input[data-type="expiry"]',
        cvc_selector: '.dpf-input[data-type="cvc"]',
        name_selector: '.dpf-input[data-type="name"]',

        submit_button_selector: '.dpf-submit',

        placeholders: {
            number: '•••• •••• •••• ••••',
            expiry: '••/••',
            cvc: '•••',
            name: 'Name'
        },

        validators: {
            number: function(number){
                return Stripe.card.validateCardNumber(number);
            },
            expiry: function(expiry){
                var expiry = expiry.split(' / ');
                return Stripe.card.validateExpiry(expiry[0]||0,expiry[1]||0);
            },
            cvc: function(cvc){
                return Stripe.card.validateCVC(cvc);
            },
            name: function(value){
                return value.length > 0;
            }
        }
    });

    var demo_log_div = document.getElementById("demo-log");

    payment_form.form.addEventListener('payment_form:submit',function(e){
        var form_data = e.detail;
        payment_form.unlockForm();
        if(form_data){
            add_card(form_data);
        }
    });

    payment_form.form.addEventListener('payment_form:field_validation_success',function(e){
        var input = e.detail;

        demo_log_div.innerHTML += "<br>field_validation_success:"+input.getAttribute("data-type");

    });

    payment_form.form.addEventListener('payment_form:field_validation_failed',function(e){
        var input = e.detail;

        demo_log_div.innerHTML += "<br>field_validation_failed:"+input.getAttribute("data-type");
    });
</script>
<!-- Faq End -->
