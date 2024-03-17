<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Image Categories</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<style>
    .center {
      text-align: center;
      border: 3px solid green;
    }

    .center1 {
  display: block;
  margin-left: auto;
  margin-right: 50%;
  width: 100%;
}
.add-to-cart-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .add-to-cart-btn:hover {
            background-color: #0056b3;
        }

    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
    }
    .category {
        width: 100%;
        height: 500px; /* Height adjusted automatically */
    }
    .category img {
        width: 100%;
        height: 500px; /* Height adjusted automatically */
    }
    

        
    .full-screen-image {
  height: calc(150vh - 60px); /* Adjust the height based on your header height */
  background-image: url('https://media.licdn.com/dms/image/D4D12AQFjUbYvd3Fv6Q/article-cover_image-shrink_720_1280/0/1695998540146?e=2147483647&v=beta&t=RNmMfCNRMOmPoQnNxuy7YIcciaG01x5xNqUN1aPSPX0'); /* Replace 'your-image.jpg' with your image path */
  background-size: cover;
  background-position: center;
}
        
    

</style>
<!--<form class="container-fluid justify-content-start">
    <nav class="navbar bg-body-tertiary">-->

</head>
<body>
<h1 class="center">SHOP NOW</h1>
<div align="center">
    <div class="d-flex justify-content-center">
                <a href="index.php"><button class="btn btn-outline-success me-2" type="button">HOME</button></a>
                <a href="men.php"> <button class="btn btn-outline-success me-2" type="button">MEN</button></a>
                <a href="women.php"><button class="btn btn-outline-success me-2" type="button">WOMEN</button></a>
                <a href="cart.php"><button class="btn btn-outline-success me-2" type="button">CART</button></a>

                <?php
                    if(isset($_SESSION["username"])){
                        echo '<a href="logout.php"><button class="btn btn-outline-success me-2" type="button">LOGOUT</button></a>';

                    }
                    else{
                        echo '<a href="login.php"><button class="btn btn-outline-success me-2" type="button">LOGIN</button></a>';
                        echo '<a href="signup.php"><button class="btn btn-outline-success me-2" type="button">REGISTER</button></a>';


                    }
                ?>
            </div>
        <div class="products">
        <div class="full-screen-image">
            <!--<img src="https://media.licdn.com/dms/image/D4D12AQFjUbYvd3Fv6Q/article-cover_image-shrink_720_1280/0/1695998540146?e=2147483647&v=beta&t=RNmMfCNRMOmPoQnNxuy7YIcciaG01x5xNqUN1aPSPX0" class="product-image">->
        </div>
                </div>
</body>
</html>
