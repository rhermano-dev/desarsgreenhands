<?php 
// Initialize shopping cart class 
include_once ('/home/desarsgr/public_html/php/cartAction.php'); 
$cart = new Cart;

include_once ('/home/desarsgr/public_html/php/addressAction.php'); 
$address1 = new Address;

require_once ('/home/desarsgr/public_html/php/config.php');

$query_products = "SELECT * FROM `plants_info` ORDER BY id ASC";
$result_products = mysqli_query($db,$query_products) or die('Could not query');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Desar's Green Hands | Landscaping Services</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Lightbox-->
    <link rel="stylesheet" href="vendor/lightbox2/css/lightbox.min.css">
    <!-- Range slider-->
    <link rel="stylesheet" href="vendor/nouislider/nouislider.min.css">
    <!-- Bootstrap select-->
    <link rel="stylesheet" href="vendor/bootstrap-select/css/bootstrap-select.min.css">
    <!-- Owl Carousel-->
    <link rel="stylesheet" href="vendor/owl.carousel2/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/owl.carousel2/assets/owl.theme.default.css">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="img/favicon.ico?v=2"  />
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    
        
  </head>
  <body>
    <div class="page-holder">
      <!-- navbar-->
      <header class="header bg-white">
        <div class="container px-0 px-lg-3">
          <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="https://desarsgreenhands.com/"><span class="font-weight-bold text-uppercase text-dark">Desar's Green Hands</span></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <!-- Link--><a class="nav-link" href="https://desarsgreenhands.com/">Home</a>
                </li>
                <li class="nav-item">
                  <!-- Link--><a class="nav-link" href="../shop.php/?category=all">Shop</a>
                </li>
              </ul>
              <ul class="navbar-nav ml-auto">               
                <li class="nav-item"><a class="nav-link" href="cart.php"> <i class="fas fa-dolly-flatbed mr-1 text-gray"></i>Cart<small class="text-gray">(<?php echo ($cart->total_items() > 0)?$cart->total_items().'':'0'; ?>)</small></a></li>
              </ul>
            </div>
          </nav>
        </div>
      </header>
      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Checkout</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="https://desarsgreenhands.com/">Home</a></li>
                    <li class="breadcrumb-item"><a href="cart.php">Cart</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <!-- BILLING ADDRESS-->
          <h2 class="h5 text-uppercase mb-4">Billing details</h2>
          <div class="row">
            <div class="col-lg-8">
              <form id="form" action="php/addressAction.php?action=addAddress" method="post">
                <fieldset>
                  <div class="row">
                    <div id="paymentResponse"></div>
                    <div class="col-lg-6 form-group">
                      <label class="text-small text-uppercase" for="firstName">First name</label>
                      <input class="form-control form-control-lg" id="firstName" name="firstname" type="text" placeholder="Enter your first name" required>
                    </div>
                    <div class="col-lg-6 form-group">
                      <label class="text-small text-uppercase" for="lastName">Last name</label>
                      <input class="form-control form-control-lg" id="lastName" name="lastname" type="text" placeholder="Enter your last name" required>
                    </div>
                    <div class="col-lg-6 form-group">
                      <label class="text-small text-uppercase" for="email">Email address</label>
                      <input class="form-control form-control-lg" id="email" name="email" type="email" placeholder="e.g. ray@gmail.com" required>
                    </div>
                    <div class="col-lg-6 form-group">
                      <label class="text-small text-uppercase" for="phone">Phone number</label>
                      <input class="form-control form-control-lg" id="phone" name="phone" type="tel" placeholder="e.g. +02 245354745" pattern="[0-9]{10}" required>
                    </div>
                    <div class="col-lg-12 form-group">
                      <label class="text-small text-uppercase" for="address">Address line 1</label>
                      <input class="form-control form-control-lg" id="address1" name="address1" type="text" placeholder="House number and street name" required>
                    </div>
                    <div class="col-lg-12 form-group">
                      <label class="text-small text-uppercase" for="address">Address line 2</label>
                      <input class="form-control form-control-lg" id="address2" name="address2" type="text" placeholder="Apartment, Suite, Unit, etc (optional)">
                    </div>
                    <div class="col-lg-6 form-group">
                      <label class="text-small text-uppercase" for="city">Town/City</label>
                      <input class="form-control form-control-lg" id="city" name="city" type="text" required>
                    </div>
                    <div class="col-lg-6 form-group">
                      <label class="text-small text-uppercase" for="state">State/County</label>
                      <input class="form-control form-control-lg" id="state" name="state" type="text" required>
                    </div>
                    <div class="col-lg-12 form-group">
                      <!-- <button class="btn btn-dark" id="placeOrder">Place Order</button> -->
                      <input class="btn btn-dark"  id="placeOrder" type="submit">
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
            <!-- ORDER SUMMARY-->
            <div class="col-lg-4">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Your order</h5>
                  <ul class="list-unstyled mb-0">
                  <?php
                     
                      if($cart->total_items() > 0)
                      { 
                        $cart_total = 0;
                        // Get cart items from session 
                        $cartItems = $cart->contents(); 
                        foreach($cartItems as $item)
                        {
                          $cart_total +=  $item['subtotal'];
                  ?>
                        <li class="d-flex align-items-center justify-content-between"><strong class="small font-weight-bold"><?php echo $item["name_of_plant"]; ?></strong><span class="text-muted small">$<?php echo $item["subtotal"]; ?></span></li>
                        <?php }
                      ?>
                    <li class="d-flex align-items-center justify-content-between"><strong class="small font-weight-bold">Sales Tax</strong><span class="text-muted small">$<?php $sales_tax = round(($cart_total * .0855), 2); echo $sales_tax; ?></span></li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Total</strong><span>$<?php echo  $cart_total + $sales_tax; ?></span></li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <!-- FOOTER SECTION-->
      <footer class="bg-dark text-white">
        <div class="container py-4">
          <div class="row py-5">
            
            
            <div class="col-md-4">
              <h6 class="text-uppercase mb-3">Social media</h6>
              <ul class="list-unstyled mb-0">
                <li><a class="footer-link" href="https://www.facebook.com/Desars-Green-Hands-103012938231043">Facebook</a></li>
                <li><a class="footer-link" href="#">Instagram</a></li>
                <li><a class="footer-link" href="#">Pinterest</a></li>
              </ul>
            </div>
          </div>
          <div class="border-top pt-4" style="border-color: #1d1d1d !important">
            <div class="row">
              <div class="col-lg-6">
                <p class="small text-muted mb-0">&copy; 2020 All rights reserved.</p>
              </div>
            </div>
          </div>
        </div>
      </footer>
      <!-- JavaScript files-->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="vendor/lightbox2/js/lightbox.min.js"></script>
      <script src="vendor/nouislider/nouislider.min.js"></script>
      <script src="vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
      <script src="vendor/owl.carousel2/owl.carousel.min.js"></script>
      <script src="vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
      <script src="js/front.js"></script>
      <script>
        // ------------------------------------------------------- //
        //   Inject SVG Sprite - 
        //   see more here 
        //   https://css-tricks.com/ajaxing-svg-sprite/
        // ------------------------------------------------------ //
        function injectSvgSprite(path) {
        
            var ajax = new XMLHttpRequest();
            ajax.open("GET", path, true);
            ajax.send();
            ajax.onload = function(e) {
            var div = document.createElement("div");
            div.className = 'd-none';
            div.innerHTML = ajax.responseText;
            document.body.insertBefore(div, document.body.childNodes[0]);
            }
        }
        // this is set to BootstrapTemple website as you cannot 
        // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
        // while using file:// protocol
        // pls don't forget to change to your domain :)
        injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
        
      </script>
      <script src="https://js.stripe.com/v3/"></script>
        <script>
        function test(){
          var buyBtn = document.getElementById('placeOrder');
          var responseContainer = document.getElementById('paymentResponse');
          // buyBtn.disabled = true;
              
          // Create a Checkout Session with the selected product
          var createCheckoutSession = function (stripe) {
              return fetch("billing.php", {
                  method: "POST",
                  headers: {
                      "Content-Type": "application/json",
                  },
                  body: JSON.stringify({
                      checkoutSession: 1,
                  }),
              }).then(function (result) {
                  return result.json();
              });
          };

          // Handle any errors returned from Checkout
          var handleResult = function (result) {
              if (result.error) {
                  responseContainer.innerHTML = '<p>'+result.error.message+'</p>';
              }
              buyBtn.disabled = false;
              buyBtn.textContent = 'Buy Now';
          };

          // Specify Stripe publishable key to initialize Stripe.js
          var stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

          buyBtn.addEventListener("click", function (evt) {

              buyBtn.disabled = true;
              buyBtn.textContent = 'Please wait...';

              let allAreFilled = true;
              document.getElementById("form").querySelectorAll("[required]").forEach(function(i) {
                if (!allAreFilled) return;
                if (!i.value) allAreFilled = false;
              })
              if (!allAreFilled) {
                alert('Fill all the fields');
                buyBtn.disabled = false;
                buyBtn.textContent = 'Place Order';
              }
              else
              {

                createCheckoutSession().then(function (data) {
                  if(data.sessionId){
                      stripe.redirectToCheckout({
                          sessionId: data.sessionId,
                      }).then(handleResult);
                  }else{
                      handleResult(data);
                  }
              });
              }
          });
        }
        </script>
      <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </div>
  </body>
</html>