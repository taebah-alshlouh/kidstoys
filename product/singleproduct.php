<?php  

include_once '../Configration/connection.php';
include_once './function.inc.php';
date_default_timezone_set("Asia/Amman");

session_start();
if(!empty($_SESSION['email'])){
  echo "<style> .restrict{display:none;} </style>";
  echo "<style> .restrict1{display:inline;} </style>";

}else{echo "<style> .restrict{display:inline;} </style>";
echo "<style> .restrict1{display:none;} </style>";
}

if(isset($_GET['add'])){
  $quantity=$_GET['quantity'];
    $add_id = $_GET['add'];
    $id=$_GET['id'];
    $adding="INSERT INTO `cart`(`product_id`, `quantity`) VALUES ('$id','$quantity');";
    mysqli_query($conn,$adding);

 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
    <link rel="stylesheet" href="../nav.css">
    <link rel="stylesheet" href="../index1.css">

   
     <title>Details</title>
</head>
<body>
<div class="container-fluied">
        <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">

      <!-- Brand -->
      <a class="navbar-brand waves-effect" href="">
        <img src="../img/logo_kids.gif" alt="logo" width="50px">
      </a>

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link waves-effect" href="../index1.php"><strong>Home</strong>
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="../product/product.php"><strong>Products</strong></a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="../Welcome/ContactUs.php"><strong>Contact Us</strong></a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="../Welcome/AboutUs.php"><strong>About Us</strong></a>
          </li>
        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item restrict">
            <a href="../Login/Login.php" class="nav-link waves-effect">
            <strong> Login</strong>
            </a>
          </li>
          <li class="nav-item restrict">
            <a href="../Regestration/Signup.php" class="nav-link waves-effect"><strong>Signup</strong>
            </a>
          </li>
          <li class="nav-item restrict1">
            <a class="nav-link waves-effect" href="../User/User.php">
            <i class="fa fa-user" aria-hidden="true"></i>
              <span class="clearfix d-none d-sm-inline-block"><strong>Account</strong></span>
            </a>
          </li>
         
         

          <li class="nav-item">
            <a class="nav-link waves-effect" href="../Cart/cart.php">
              <i class="fas fa-shopping-cart"></i>
              <span class="clearfix d-none d-sm-inline-block"><strong>Cart</strong></span>
            </a>
          </li>
          <li class="nav-item restrict1">
            <a href="../Login/logout.php" class="nav-link waves-effect"><strong>Logout</strong>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar -->
 <section class="section-content padding-y" style="margin-top:10%">
    
    <div class="container">

        <div class="card">
            <div class="row no-gutters">
                <?php
               ##########################################################################
                $product_query = "SELECT * FROM `products` WHERE product_id =$_GET[id]";
                $product_result = mysqli_query($conn, $product_query);
                if (mysqli_num_rows($product_result) > 0) {
                    while ($row = mysqli_fetch_assoc($product_result)) {
                ?>
                        <aside class="col-md-6">
                            <form  method="GET">
                                 <div class="img-big-wrap">
                                        <img src="<?php echo $row['img']; ?>" style= "width:92%; height:80%; margin-left:3%;" >
                                    </div> <!-- img-big-wrap.// -->
                        </aside>
                        <main class="col-md-6 border-left">
                            <article style="padding:3rem ;" class="content-body">
                                <h2 class="title" style= "color:darkred">Product name<?php echo $row['product_name']; ?></h2>

                                <div class="mb-3">
                                    <p style= "color:darkred"> Price: <?php echo $row['price']; ?> $</p>
                                </div>

                                <p><h4>Description:</h4> <?php echo $row['description']; ?></p>
                                <div class="col">
                                    <p class="card-text">Quantity:
                                        <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;">
                                    </p>
                                </div> <!-- col.// -->
                                <br>

                                <input type="hidden" name="hidden_product_name" value="<?php echo $row["product_name"]; ?>">
                                <input type="hidden" name="id" value="<?php echo $row['product_id'] ?>">
                                <input type="hidden" name="hidden_img" value="<?php echo $row["img"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                                <input style="background-color:#e55951 ; height:3rem; font-size:larger;color:white; margin-left:3%;" type="submit" name="add" class="btn" value="Add to cart">
                            </article> <!-- product-info-aside .// -->
                           
                        <!-- col.// -->
                <?php  }
                } else {
                    echo "<h3>NO DATA FOUND.</h3>";
                } 
                ?>
             </main>
            </form> 
            <br>   <br>   <br>     
    <div class="container" style="margin-top:8% ; margin-left:54%; margin-bottom:5%">
     <?php

    echo "<form  method='POST' action='".setComments($conn)."'>
        <input type='hidden' value='User Comment :'>
        <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
        <textarea name='msg'  cols='30' rows='5'></textarea><br>
        <button class='btn btn-info'  style='margin-top:2%;background-color:#e55951' 'type='submit' name='CommentSubmit' >Comment</button>
    </form>" ;

    GetComments($conn);
    ?>

    </div>
</div>
        </div></div></section>
<!-- ...................................... -->
        
<!-- Start Footer bottom Area -->
<footer >
  <div class="footer-area-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="footer-icons">
            <ul>
              <li>
                <a href=""><i style="font-size:27px ; margin-top:4%" class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li>
                <a href="https://www.linkedin.com/company/toysrus/">
                <i style="font-size:27px ; margin-top:4%" class="fab fa-linkedin-in"></i>
                </a>
              </li>
              <li>
                <a href="https://github.com/samaralkhamis/Project5PHP">
                <i style="font-size:27px ; margin-top:4%" class="fab fa-github-alt"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-md-12 col-md-12">
          <div class="credits">
            <a href="#">Privacy Policy</a> | Terms & Condition
          </div>
          <div class="copyright text-center">
            <p>
              &copy; Copyright 2022 .  <strong>KIDSTOYS</strong><br>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

                
</body>
</html>