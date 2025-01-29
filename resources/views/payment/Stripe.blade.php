<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style type="text/css">
        .panel-title {
        display: inline;
        font-weight: bold;
        }
        .display-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }
    </style>
</head>
<body>

<div class="container">

    
<br><br><br><br>
    <div class="row">
    
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default credit-card-box">
            
                <div class="panel-body">
                    <h1>Stripe Payment Gateway  </h1>
                    
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

                    <form 
                    role="form" 
                    action="{{ route('stripe.post') }}" 
                    method="post" 
                    class="require-validation"
                    data-cc-on-file="false"
                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                    id="payment-form">
                    @csrf
                
                    <div class='form-row row'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Name on Card</label>
                            <input class='form-control' size='4' type='text'>
                        </div>
                    </div>
                
                    <div class='form-row row'>
                        <div class='col-xs-12 form-group card required'>
                            <label class='control-label'>Card Number</label>
                            <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                        </div>
                    </div>
                
                    <div class='form-row row'>
                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                            <label class='control-label'>CVC</label>
                            <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Expiration Month</label>
                            <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Expiration Year</label>
                            <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                        </div>
                    </div>
                
                    <div class="error hide">
                        <div class="alert alert-danger"></div>
                    </div>
                
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block" id='submit'type="submit">Pay: {{ $total }}$ </button>
                        </div>
                    </div>
                </form>
                
                </div>
            </div>        
        </div>
    </div>
      
</div>
  
</body>
  
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
  
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var stripe = Stripe("{{ env('STRIPE_KEY') }}");
        var elements = stripe.elements();

        var card = elements.create("card");
        card.mount("#card-element");

        var form = document.getElementById("payment-form");

        form.addEventListener("submit", function (event) {
            event.preventDefault();

            stripe.createToken(card).then(function (result) {
                if (result.error) {
                    document.getElementById("card-errors").textContent = result.error.message;
                } else {
                    var hiddenInput = document.createElement("input");
                    hiddenInput.setAttribute("type", "hidden");
                    hiddenInput.setAttribute("name", "stripeToken");
                    hiddenInput.setAttribute("value", result.token.id);
                    form.appendChild(hiddenInput);

                    form.submit();
                }
            });
        });
    });
</script>

</html>