<?php

  // Initialize shopping cart class 
  include_once ('/home/desarsgr/public_html/php/cartAction.php'); 
  $cart = new Cart;

  require_once ('/home/desarsgr/public_html/php/config.php');
  $product_id = htmlspecialchars($_GET["product"]);
  $query_product_details = "SELECT * FROM `plants_info` WHERE id = '$product_id'";
  $result_product_detail = mysqli_query($db,$query_product_details) or die('Could not query');
  $rows_product_detail=$result_product_detail->fetch_assoc();

  //pictures
  $sql_picture = "SELECT * FROM plant_pictures WHERE id = $product_id ORDER BY ID ASC ";
  $result = mysqli_query($db,$sql_picture) or die('Could not query');
  //  $get = $result->fetch_assoc();
 
?> 
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Desar's Green Hands | Landscaping Services</title>
    <meta name="description" content="Desar's Green Hands | Landscaping Services">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!-- Lightbox-->
    <link rel="stylesheet" href="../vendor/lightbox2/css/lightbox.min.css">
    <!-- Range slider-->
    <link rel="stylesheet" href="../vendor/nouislider/nouislider.min.css">
    <!-- Bootstrap select-->
    <link rel="stylesheet" href="../vendor/bootstrap-select/css/bootstrap-select.min.css">
    <!-- Owl Carousel-->
    <link rel="stylesheet" href="../vendor/owl.carousel2/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="../vendor/owl.carousel2/assets/owl.theme.default.css">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="../css/custom.css">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico?v=2"  />
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page-holder bg-light">
      <!-- navbar-->
      <header class="header bg-white">
        <div class="container px-0 px-lg-3">
          <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="http://desarsgreenhands.com/"><span class="font-weight-bold text-uppercase text-dark">Desar's Green Hands</span></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <!-- Link--><a class="nav-link" href="http://desarsgreenhands.com/">Home</a>
                </li>
                <li class="nav-item">
                  <!-- Link--><a class="nav-link" href="../shop.php/?category=all">Shop</a>
                </li>
              </ul>
              <ul class="navbar-nav ml-auto">               
                <li class="nav-item"><a class="nav-link" href="../cart.php"> <i class="fas fa-dolly-flatbed mr-1 text-gray"></i>Cart<small class="text-gray">(<?php echo ($cart->total_items() > 0)?$cart->total_items().'':'0'; ?>)</small></a></li>
              </ul>
            </div>
          </nav>
        </div>
      </header>
      <section class="py-5">
        <div class="container">
          <div class="row mb-5">
            <div class="col-lg-6">
              <!-- PRODUCT SLIDER-->
              <div class="row m-sm-0">
                <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0">
                  <div class="owl-thumbs d-flex flex-row flex-sm-column" data-slider-id="1">
                  <?php 
                    // if( isset($get['picture']))
                    // {
                    while ($get = mysqli_fetch_array($result))
                    {
                      // echo $get[2];
                      echo '<div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="img-fluid w-100" src="data:image/jpg;base64,' . base64_encode($get[2]) . '" style="height:100px;"/></div>';
                    }
                    ?>
                  </div>
                </div>
                <div class="col-sm-10 order-1 order-sm-2">
                  <div class="owl-carousel product-slider" data-slider-id="1">
                  <?php
                  $counter = 0;
                  $sql_picture1 = "SELECT * FROM plant_pictures WHERE id = $product_id ORDER BY ID ASC ";
                  $result1 = mysqli_query($db,$sql_picture1) or die('Could not query');
                  // if(mysqli_fetch_array($result1))
                  // {
                    while ($get1 = mysqli_fetch_array($result1))
                    {
                      echo '<a class="d-block" href="data:image/jpg;base64,' . base64_encode($get1[2]) . '" data-lightbox="product" title="' . $rows_product_detail['name_of_plant'] . '"><img class="img-fluid"  src="data:image/jpg;base64,' . base64_encode($get1[2]) . '"></a>';
                      $counter++;
                    }
                  // }
                  if(!mysqli_fetch_array($result1))
                  {
                    echo '<a class="d-block" href="../../img/no-image.png" data-lightbox="product" title=""><img class="img-fluid"  src="../../img/no-image.png"></a>';
                  }
                  ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- PRODUCT DETAILS-->
            <div class="col-lg-6">
              <form action ="../php/cartAction.php?action=addToCart&id=<?php echo $rows_product_detail['id']; ?>" method="post">
                <fieldset>
              <h1><?php echo $rows_product_detail['name_of_plant']?></h1>
              <p class="text-muted lead">$<?php echo $rows_product_detail['price_of_plant']?></p>
              <p class="text-small mb-4"><?php echo $rows_product_detail['description_of_plant']?></p>
              <div class="row align-items-stretch mb-4">
                <div class="col-sm-5 pr-sm-0">
                  <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                    <div class="quantity">
                      <a class="dec-btn p-0"><i class="fas fa-caret-left"></i></a>
                      <input name="quantity_of_plant" class="form-control border-0 shadow-0 p-0" type="text" value="1">
                      <a class="inc-btn p-0"><i class="fas fa-caret-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3 pl-sm-0"><input class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" type="submit" value="Add to Cart"></div>
              </div>
              <ul class="list-unstyled small d-inline-block">
                <?php
                  $query_plant_type = "SELECT * FROM `plant_type` ORDER BY id ASC";
                  $result_plant_type = mysqli_query($db,$query_plant_type) or die('Could not query'); ?>
                <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Category:</strong>
                <?php  
                  while($rows_plant_type = mysqli_fetch_assoc($result_plant_type)) 
                  {
                    if( $rows_plant_type['id'] == $rows_product_detail['type_of_plant'])
                    {
                      echo $rows_plant_type['type_of_plant'];
                    }
                  }
                ?></li>
                <li class="px-3 py-2 mb-2 bg-gray text-muted"><strong class="text-uppercase text-dark">Available Color:</strong> <?php echo $rows_product_detail['color_of_plant'];?></li>
                <li class="px-3 py-2 mb-2 bg-white text-muted"><strong class="text-uppercase text-dark">Bloom Time:</strong> <?php echo $rows_product_detail['bloom_time_of_plant'];?></li>
                <li class="px-3 py-2 mb-2 bg-gray text-muted"><strong class="text-uppercase text-dark">Height Range:</strong> <?php echo $rows_product_detail['height_range_of_plant'];?></li>
                <li class="px-3 py-2 mb-2 bg-white text-muted"><strong class="text-uppercase text-dark">Space Range:</strong> <?php echo $rows_product_detail['space_range_of_plant'];?></li>
                <li class="px-3 py-2 mb-2 bg-gray text-muted"><strong class="text-uppercase text-dark">Lowest Temperature:</strong> <?php echo $rows_product_detail['lowest_temperature_of_plant'];?></li>
                <li class="px-3 py-2 mb-2 bg-white text-muted"><strong class="text-uppercase text-dark">Plant Light:</strong> <?php echo $rows_product_detail['plant_light_of_plant'];?></li>
                <li class="px-3 py-2 mb-2 bg-gray text-muted"><strong class="text-uppercase text-dark">USDA Zone:</strong> <?php echo $rows_product_detail['usda_of_plant'];?></li>
                <li class="px-3 py-2 mb-2 bg-white text-muted"><strong class="text-uppercase text-dark">Pests and Diseases:</strong> <?php echo $rows_product_detail['pest_of_plant'];?></li>
              </ul>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </section>

      <!-- FOOTER SECTION-->
      <footer class="bg-dark text-white" style="margin-top:46px">
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
      <script src="../vendor/jquery/jquery.min.js"></script>
      <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="../vendor/lightbox2/js/lightbox.min.js"></script>
      <script src="../vendor/nouislider/nouislider.min.js"></script>
      <script src="../vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
      <script src="../vendor/owl.carousel2/owl.carousel.min.js"></script>
      <script src="../vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
      <script src="../js/front.js"></script>
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