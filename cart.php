<?php 
// Initialize shopping cart class 
include_once ('/home/desarsgr/public_html/php/cartAction.php'); 
$cart = new Cart;

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
                <h1 class="h2 text-uppercase mb-0">Cart</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="https://desarsgreenhands.com/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <h2 class="h5 text-uppercase mb-4">Shopping cart</h2>
          <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
              <!-- CART TABLE-->
              <div class="table-responsive mb-4">
                <table class="table">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Product</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Price</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Quantity</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Total</strong></th>
                      <th class="border-0" scope="col"> </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    
                      if($cart->total_items() > 0){ 
                          // Get cart items from session 
                          $cartItems = $cart->contents(); 
                          foreach($cartItems as $item){
                            $sub_total +=  $item['subtotal'];
                    ?>
                    <tr>
                      <th class="pl-0 border-0" scope="row">
                        <div class="media align-items-center">
                          <div class="media-body ml-3" ><strong class="h6"><a class="reset-anchor animsition-link" href="detail.php/?product=<?php echo $item['id'];?>"><?php echo $item["name_of_plant"]; ?></a></strong></div>
                        </div>
                      </th>
                      <td class="align-middle border-0">
                        <p class="mb-0 small" style="display:inline; word-wrap: break-word;">$<p class="mb-0 small" id="price_of_plant<?php echo $item["id"]; ?>"  style="display:inline; word-wrap: break-word;"><?php echo $item["price_of_plant"]; ?></p></p>
                      </td>
                      <td class="align-middle border-0">
                        <div class="border d-flex align-items-center justify-content-between px-3"><span class="small text-uppercase text-gray headings-font-family">Quantity</span>
                          <div class="quantity">
                            <button class="dec-btn p-0"  onclick="decValue('<?php echo $item["rowid"]; ?>',<?php echo $item['id']; ?>)" ><i class="fas fa-caret-left"></i></button>
                            <input class="form-control form-control-sm border-0 shadow-0 p-0" type="text" id="quantity_of_plant<?php echo $item["id"]; ?>" value="<?php echo $item["qty"]; ?>" onchange="onChange('<?php echo $item["rowid"]; ?>',<?php echo $item['id']; ?>)"/>
                            <button class="inc-btn p-0"  onclick="incValue('<?php echo $item["rowid"]; ?>',<?php echo $item['id']; ?>)"><i class="fas fa-caret-right"></i></button>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle border-0">
                        <p class="mb-0 small" id="sub_total_of_item<?php echo $item["id"]; ?>"><?php echo $item["subtotal"]; ?></p>
                      </td>
                      <td class="align-middle border-0"><a class="reset-anchor" href="#"><button onclick="return confirm('Are you sure?')?window.location.href='/php/cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>':false;"><i class="fas fa-trash-alt small text-muted"></i></button></a></td>
                    </tr>
                    <?php }
                      }
                      // uncomment to know current items in cart
                      // print("<pre>".print_r($cartItems,true)."</pre>");
                    // $address1 = $address->contents(); 
                    // print("<pre>".print_r($address1,true)."</pre>");
                     ?>
                  </tbody>
                </table>
              </div>
              <!-- CART NAV-->
              <div class="bg-light px-4 py-3">
                <div class="row align-items-center text-center">
                  <div class="col-md-6 mb-3 mb-md-0 text-md-left"><a class="btn btn-link p-0 text-dark btn-sm" href="../shop.php/?category=all"><i class="fas fa-long-arrow-alt-left mr-2"> </i>Continue shopping</a></div>
                  <div class="col-md-6 text-md-right"><a class="btn btn-outline-dark btn-sm" href="https://desarsgreenhands.com/checkout.php" >Procceed to checkout<i class="fas fa-long-arrow-alt-right ml-2"></i></a></div>
                </div>
              </div>
            </div>
            <!-- ORDER TOTAL-->
            <div class="col-lg-4">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Cart total</h5>
                  <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Subtotal</strong><span class="text-muted small" id="sub_total">$<?php echo $sub_total; ?></span></li>
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Sales Tax</strong><span class="text-muted small" id="sales_tax">$<?php $sales_tax = round(($sub_total * .0855), 2); echo $sales_tax; ?></span></li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between mb-4"><strong class="text-uppercase small font-weight-bold">Total</strong><span id="order_total">$<?php echo $sub_total + $sales_tax; ?></span></li>
                    <li>
                    </li>
                  </ul>
                  <?php  ?>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <!-- FOOTER SECTION-->
      <footer class="bg-dark text-white" style="margin-top:61px">
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

      <script>
        function decValue(id,x) {
          var price_of_plant = parseInt(document.getElementById("price_of_plant"+x).innerHTML);
          var quantity_of_plant = parseInt(document.getElementById("quantity_of_plant"+x).value)-1;
          var a = price_of_plant*quantity_of_plant;
          document.getElementById("sub_total_of_item"+x).innerHTML = (a);
          total();
          updateCartItem(quantity_of_plant,id);
        }
        function incValue(id,x) {
          var a = id;
          var price_of_plant = parseInt(document.getElementById("price_of_plant"+x).innerHTML);
          var quantity_of_plant = parseInt(document.getElementById("quantity_of_plant"+x).value)+1;
          var a = price_of_plant*quantity_of_plant;
          document.getElementById("sub_total_of_item"+x).innerHTML = (a);
          total();
          updateCartItem(quantity_of_plant,id);
        }
        function onChange(id,x) {
          var a = id;
          var price_of_plant = parseInt(document.getElementById("price_of_plant"+x).innerHTML);
          var quantity_of_plant = parseInt(document.getElementById("quantity_of_plant"+x).value)+1;
          var a = price_of_plant*quantity_of_plant;
          document.getElementById("sub_total_of_item"+x).innerHTML = (a);
          total();
          updateCartItem(quantity_of_plant,id);
        }
        function total()
        {
          var total = document.querySelectorAll('[id^="sub_total_of_item"]');
          var subtotal = 0 ;
          for ( var i = 0; i < total.length; i++ )
          {
            subtotal += parseInt(total[i].childNodes[0].nodeValue);
          }
          document.getElementById("sub_total").innerHTML = "$" + subtotal;

          var tax = Math.round(subtotal * 8.55) / 100;
          document.getElementById("sales_tax").innerHTML = "$" + tax;

          var orderTotal = Math.round((subtotal + tax) * 100) / 100;
          document.getElementById("order_total").innerHTML = "$" + orderTotal;
        }
      </script>
      <script>
      function updateCartItem(obj,id){
          $.get("/php/cartAction.php", {action:"updateCartItem", id:id, qty:obj}, function(data){
              if(data == 'ok'){
                  location.reload();
              }else{
                  // alert('Cart update failed, please try again.');
              }
          });
        }
      </script>
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
      <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </div>
  </body>
</html>