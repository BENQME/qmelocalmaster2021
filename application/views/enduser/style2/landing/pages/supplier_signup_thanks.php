<?php //print_r($page_data) ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
<style>
#contact_form input[type="email"],
#contact_form input[type="tel"],
#contact_form input[type="url"],
#contact_form input[type="text"] {
    width: 420px;
    max-width: 100%;
    height: 44px;
    padding: 0 16px;
    border: 1px solid #cecece;
}

#contact_form label.error{
    font-size: 13px;
    color: red;
    font-weight: normal;
    margin-top: 5px;
}
#contact_form  label{
font-weight: 600;
    font-size: 17px;
}
#contact_form textarea.form-control {
    min-height: 150px;
}
#contact_form  button[type="submit"] {
    height: 44px;
    color: #fff !important;
    background: #c11d2d !important;
    float: right;
}
select {
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: linear-gradient(45deg, transparent 50%, gray 50%), linear-gradient(135deg, gray 50%, transparent 50%), linear-gradient(to right, #ccc, #ccc);
    background-position: calc(100% - 30px) 20px, calc(100% - 25px) 20px, calc(100% - 3.5em) 0;
    background-size: 5px 5px, 5px 5px, 1px 40px;
    background-repeat: no-repeat;
height: 43px;
}
</style>
<section class="content-section no-space">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
      <div class="page_content">
        <?php if($page_data->pageContent) echo $page_data->pageContent; ?>
        
        
        
        
        <!-- Load Stripe.js on your website. -->
<script src="https://js.stripe.com/v3"></script>
 
<!-- Create a button that your customers click to complete their purchase. Customize the styling to suit your branding. -->
<button
  style="background-color:#6772E5;color:#FFF;padding:8px 12px;border:0;border-radius:4px;font-size:1em"
  id="checkout-button-price_1Is6NEIzU95M70v0SZ0aBbkN"
  role="link"
  type="button"
>
  Full Page Checkout
</button>
 <button
  style="background-color:#6772E5;color:#FFF;padding:8px 12px;border:0;border-radius:4px;font-size:1em"
  id="checkout-button-price_1Is6MhIzU95M70v0Uqm9DlSm"
  role="link"
  type="button"
>
  Half Page Checkout
</button>

<div id="error-message"></div>
 
<script>
(function() {
  var stripe = Stripe('pk_live_51GzvSGIzU95M70v0RA9a9B4dLNsVopOYeNWoA0Wti7g8DY7Y9wWtG2WS5Kg6ffr6HWwMAWgWoa7T1OacWFRSiFlG00fl9tJKre');
 
  var checkoutButton = document.getElementById('checkout-button-price_1Is6NEIzU95M70v0SZ0aBbkN');
  checkoutButton.addEventListener('click', function () {
    /*
     * When the customer clicks on the button, redirect
     * them to Checkout.
     */
    stripe.redirectToCheckout({
      lineItems: [{price: 'price_1Is6NEIzU95M70v0SZ0aBbkN', quantity: 1}],
      mode: 'payment',
      /*
       * Do not rely on the redirect to the successUrl for fulfilling
       * purchases, customers may not always reach the success_url after
       * a successful payment.
       * Instead use one of the strategies described in
       * https://stripe.com/docs/payments/checkout/fulfill-orders
       */
      successUrl: window.location.protocol + '//mbnusa.biz/page/success',
      cancelUrl: window.location.protocol + '//mbnusa.biz/page/canceled',
    })
    .then(function (result) {
      if (result.error) {
        /*
         * If `redirectToCheckout` fails due to a browser or network
         * error, display the localized error message to your customer.
         */
        var displayError = document.getElementById('error-message');
        displayError.textContent = result.error.message;
      }
    });
  });
})();
</script>
 <script>
(function() {
  var stripe = Stripe('pk_live_51GzvSGIzU95M70v0RA9a9B4dLNsVopOYeNWoA0Wti7g8DY7Y9wWtG2WS5Kg6ffr6HWwMAWgWoa7T1OacWFRSiFlG00fl9tJKre');
 
  var checkoutButton = document.getElementById('checkout-button-price_1Is6MhIzU95M70v0Uqm9DlSm');
  checkoutButton.addEventListener('click', function () {
    /*
     * When the customer clicks on the button, redirect
     * them to Checkout.
     */
    stripe.redirectToCheckout({
      lineItems: [{price: 'price_1Is6MhIzU95M70v0Uqm9DlSm', quantity: 1}],
      mode: 'payment',
      /*
       * Do not rely on the redirect to the successUrl for fulfilling
       * purchases, customers may not always reach the success_url after
       * a successful payment.
       * Instead use one of the strategies described in
       * https://stripe.com/docs/payments/checkout/fulfill-orders
       */
      successUrl: window.location.protocol + '//mbnusa.biz/page/success',
      cancelUrl: window.location.protocol + '//mbnusa.biz/page/canceled',
    })
    .then(function (result) {
      if (result.error) {
        /*
         * If `redirectToCheckout` fails due to a browser or network
         * error, display the localized error message to your customer.
         */
        var displayError = document.getElementById('error-message');
        displayError.textContent = result.error.message;
      }
    });
  });
})();
</script>


        </div>
      </div>
      <!-- end col-8 -->
      <div class="col-lg-4">
        <aside class="sidebar sticky-top">
        <?php echo sidebar('home_bottom')?>
          
        </aside>
        <!-- end sidebar --> 
      </div>
      <!-- end col-4 --> 
    </div>
    <!-- end row --> 
  </div>
  <!-- end container --> 
</section>
<script>
$(document).ready(function () {
$.validator.addMethod("phoneUS", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return this.optional(element) || phone_number.length > 9 && phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
}, "Please specify a valid phone number");
	$("#contact_form").validate(
	{

   Contacts_Phone_Number: {
        required: true,
                phoneUS: true
    }
	}
	);
});
</script>
