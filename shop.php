<?php

  // Initialize shopping cart class 
  include_once ('/home/desarsgr/public_html/php/cartAction.php'); 
  $cart = new Cart;

  include ('/home/desarsgr/public_html/php/config.php');

  $category = htmlspecialchars($_GET["category"]);
  if ($category == "all")
  {
    
    $query_products = "SELECT * FROM `plants_info` WHERE deleted = 0 ORDER BY id DESC";

    $query_count = "SELECT COUNT(id) AS Total FROM `plants_info`";
    $result_count = mysqli_query($db,$query_count) or die('Could not query');
    $rows_count=$result_count->fetch_assoc();
  }
  //TODO
  else if ($category == "search")
  {
    $search = htmlspecialchars($_GET["search"]); 
   
    $query_products = "SELECT * FROM `plants_info` WHERE name_of_plant like '%$search%' AND deleted = 0 ORDER BY id ASC";

    $query_count = "SELECT COUNT(id) AS Total FROM `plants_info` WHERE name_of_plant like '%$search%'";
    $result_count = mysqli_query($db,$query_count) or die('Could not query');
    $rows_count=$result_count->fetch_assoc();
  }
  else
  {
    $query_products = "SELECT * FROM `plants_info` WHERE type_of_plant = $category AND deleted = 0 ORDER BY id ASC";

    $query_count = "SELECT COUNT(id) AS Total FROM `plants_info` WHERE type_of_plant = $category ";
    $result_count = mysqli_query($db,$query_count) or die('Could not query');
    $rows_count=$result_count->fetch_assoc();

  }
  $result_products = mysqli_query($db,$query_products) or die('Could not query');

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

    <script>
      function searchButton() {
        //document.getElementById("demo").innerHTML = document.getElementById("searchData").value;
        window.location = "https://desarsgreenhands.com/shop.php/?category=search&search=" + document.getElementById("searchData").value;
      }
    </script>
  </head>
  <body>
    <div class="page-holder">
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
                  <!-- Link--><a class="nav-link active" href="../shop.php/?category=all">Shop</a>
                </li>
              </ul>
              <ul class="navbar-nav ml-auto">               
                <li class="nav-item"><a class="nav-link" href="../cart.php"> <i class="fas fa-dolly-flatbed mr-1 text-gray"></i>Cart<small class="text-gray">(<?php echo ($cart->total_items() > 0)?$cart->total_items().'':'0'; ?>)</small></a></li>
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
                <h1 class="h2 text-uppercase mb-0">Shop</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="http://desarsgreenhands.com/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <div class="container p-0">
            <div class="row">
              <!-- SHOP SIDEBAR-->
              <div class="col-lg-3 order-2 order-lg-1">
                <h3 class="text-uppercase mb-4">Categories</h3>
                <ul class="list-unstyled text-muted pl-lg-4 font-weight-normal">
                  <li class="mb-2"><a class="reset-anchor" href="../shop.php/?category=all">All</a></li>
                  <?php
                  $query_plant_type = "SELECT * FROM `plant_type` ORDER BY id ASC";
                  $result_plant_type = mysqli_query($db,$query_plant_type) or die('Could not query'); 
                  while($rows_plant_type = mysqli_fetch_assoc($result_plant_type)) 
                  {
                  ?>
                    <li class="mb-2"><a class="reset-anchor" href="../shop.php/?category=<?php echo $rows_plant_type['id'];?>"><?php echo $rows_plant_type['type_of_plant'];?></a></li>
                  <?php 
                  }
                  ?>
                </ul>
              </div>
              <!-- SHOP LISTING-->
              <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
                <div class="row mb-3 align-items-center">
                  <div class="col-lg-6 mb-2 mb-lg-0">
                  <div class="input-group">
                    <p class="text-small text-muted mb-0">Showing 1 of 
                        <?php
                            
                            echo $rows_count['Total'];
                        ?> 
                        results</p>
                  </div>
                  </div>
                  <div class="col-lg-6">
                    <ul class="list-inline d-flex align-items-right justify-content-lg-end mb-0">
                      <div class="input-group">
                        <input type="search" class="form-control rounded" id="searchData" placeholder="Search" aria-label="Search"
                        aria-describedby="search-addon" />
                        <button type="button" onclick="searchButton()" class="btn btn-outline-primary" type="submit">search</button>
                        <p id="demo"></p>
                      </div>

                    </ul>
                  </div>
                </div>
                <div class="row">
                  <!-- PRODUCT-->
                  <?php
                    while($rows=$result_products->fetch_assoc())
                    {
                      $id = $rows['id'];
                       $sql_picture = "SELECT picture FROM plant_pictures WHERE id = $id ORDER BY ID ASC LIMIT 1";
                       $result = mysqli_query($db,$sql_picture) or die('Could not query');
                       $get = $result->fetch_assoc();
                  ?>
                  <div class="col-lg-4 col-sm-6">
                    <div class="product text-center">
                      <div class="mb-3 position-relative">
                        <?php $dateRegistered = $rows['date_registered'];  $addDate = date('Y-m-d', strtotime($dateRegistered. ' + 1 Month')); if(date("Y-m-d") >= $dateRegistered && $addDate >= date("Y-m-d")) {?>
                        <div class="badge text-white badge-primary">New</div>
                        <?php }?>
                        <a class="d-block" href="../detail.php/?product=<?php echo $rows['id'];?>">
                        <?php if( isset($get['picture']))
                                {
                                  echo '<img class="img-fluid w-100" src="data:image/jpg;base64,' . base64_encode($get['picture']) . '" style="width:254.984px;height:281.141px;"/>';
                                }
                              else
                                {
                                  echo '<img class="img-fluid w-100" src="../img/no-image.png" style="width:254.984px;height:281.141px;"/>';
                                } 
                        ?>
                        </a>
                      </div>
                      <h6> <a class="reset-anchor" href="../detail.php/?product=<?php echo $rows['id'];?>">
                          <?php
                            echo $rows['name_of_plant'];
                          ?>
                          </a></h6>
                      <p class="small text-muted">$
                          <?php
                          echo $rows['price_of_plant'];
                          ?>
                      </p>
                    </div>
                  </div>
                  <?php
                    }
                    ?>

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