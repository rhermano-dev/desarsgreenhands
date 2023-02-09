<?php
    include ('/home/desarsgr/public_html/admin/php/session.php');
    
    include ('/home/desarsgr/public_html/php/config.php');

    $product_id = htmlspecialchars($_GET["id"]);
    $query_product_details = "SELECT * FROM `plants_info` WHERE id = '$product_id'";
    $result_product_detail = mysqli_query($db,$query_product_details) or die('Could not query');
    $rows_product_detail=$result_product_detail->fetch_assoc();
// $sql = "SELECT * FROM plant_pictures WHERE id = $product_id";
// $sth = $db->query($sql);
// $result=mysqli_fetch_array($sth);
// echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['image'] ).'"/>';
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="../css/font-face.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="../vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="../vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="../vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="../images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="https://admin.desarsgreenhands.com/">
                                <i class="fas fa-chart-bar"></i>Overview</a>
                            <a href="https://admin.desarsgreenhands.com/listplants.php">
                                <i class="fas fa-chart-bar"></i>List of Products</a>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-copy"></i>Orders</a>
                                <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                    <li>
                                        <a href="https://admin.desarsgreenhands.com/orders.php">
                                    <i class="fas fa-chart-bar"></i>Pending Orders</a>
                                    </li>
                                    <li>
                                        <a href="https://admin.desarsgreenhands.com/delivered.php">
                                        <i class="fas fa-chart-bar"></i>Finished Orders</a>
                                    </li>
                                </ul>
                            </li>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="../images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="https://admin.desarsgreenhands.com/">
                                <i class="fas fa-chart-bar"></i>Overview</a>
                            <a href="https://admin.desarsgreenhands.com/listplants.php">
                                <i class="fas fa-chart-bar"></i>List of Products</a>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-copy"></i>Orders</a>
                                <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                    <li>
                                        <a href="https://admin.desarsgreenhands.com/orders.php">
                                    <i class="fas fa-chart-bar"></i>Pending Orders</a>
                                    </li>
                                    <li>
                                        <a href="https://admin.desarsgreenhands.com/delivered.php">
                                        <i class="fas fa-chart-bar"></i>Finished Orders</a>
                                    </li>
                                </ul>
                            </li>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <div class="modal fade" id="deletePlant" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="smallmodalLabel">Small Modal</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<p>
								Are you sure you want to delete?
							</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<a href="../php/delete_plant.php/?id=<?php echo $product_id ?>"> <button type="button" class="btn btn-primary">Confirm</button></a>
						</div>
					</div>
				</div>
			</div>

        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap" style=" position: relative; z-index: 597; float: right;">

                        <div class="header-button" >
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="../images/icon/avatar-01.jpg" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <? echo $login_name; ?>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="../images/icon/avatar-01.jpg" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <? echo $login_name; ?>
                                                    </h5>
                                                    <span class="email"><? echo $login_email; ?></span>
                                                </div>
                                            </div>

                                            <div class="account-dropdown__footer">
                                                <a href="php/logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">EDIT PICTURE</h2>
                                </div>
                                <br />
                                <?php 
                                 $query = "SELECT * FROM plant_pictures WHERE id = $product_id";
                                 if ($result = mysqli_query($db, $query)) {
                                     while ($row = mysqli_fetch_assoc($result)) {
                                         echo '<img src="data:image/jpg;base64,' . base64_encode($row['picture']) . '" width="300" height="300" style="object-fit: fill;">';
                                     }
                                 }?>
                                 <br />
                                <form action="https://desarsgreenhands.com/admin/php/post_edit_plant_pictures.php/?id=<?php echo $product_id ?>" method="post" enctype="multipart/form-data">
                                    <fieldset>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="file-multiple-input" class=" form-control-label">Pictures for Plant</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="file" name="files[]" class="form-control-file" multiple>
                                            </div>
                                        </div>
                                        <input  class="btn btn-success btn-lg" style=" position: relative; z-index: 597; float: right;" type="submit" value="submit">
                                        <!-- <button type="button" class="btn btn-success btn-lg" style=" position: relative; z-index: 597; float: right;">Add</button> -->
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OF MAIN CONTENT-->
        </div>
        
    </div>

    <!-- Jquery JS-->
    <script src="../vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="../vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="../vendor/slick/slick.min.js">
    </script>
    <script src="../vendor/wow/wow.min.js"></script>
    <script src="../vendor/animsition/animsition.min.js"></script>
    <script src="../vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="../vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="../vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="../vendor/circle-progress/circle-progress.min.js"></script>
    <script src="../vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="../vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="../js/main.js"></script>

</body>

</html>