<?php
session_start();
require("database.php");
if (!isset($_SESSION['username'])) {header('location: logout.php');}
?>
<!DOCTYPE html>
<html>
<head>
    
    <title>Cart</title>
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
    </style>
    <style>
        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 30px;
        }

        .product {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 10px;
            padding: 15px;
            width: 400px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .product-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-price {
            color: #ff6600;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
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

        
    </style>
</head>
<body>
    
<h1 class="center">SHOP NOW</h1>
    <div class="d-flex justify-content-center">
        <nav class="navbar bg-body-tertiary">
            <form class="container-fluid justify-content-start">
                <a href="index.php"><button class="btn btn-outline-success me-2" type="button">HOME</button></a>
                <a href="men.php"> <button class="btn btn-outline-success me-2" type="button">MEN</button></a>
                <a href="women.php"><button class="btn btn-outline-success me-2" type="button">WOMEN</button></a>
                <?php 
                $username=$_SESSION['username'];
                $query = "SELECT * FROM cart WHERE username='" . $username . "';";
                $result = mysqli_query($conn, $query)or die($mysqli_error($conn));
                $num = mysqli_num_rows($result);
                if($num!=0){
                    echo '<a href="checkout.php"><button class="btn btn-outline-success me-2" type="button">CHECKOUT</button></a>';
                }
?>
                <a href="logout.php"><button class="btn btn-outline-success me-2" type="button">LOGOUT</button></a>
            </form>
        </nav>
    </div>
        <h1 align="center">Cart</h1>
    </h2>
    <!-- <h3 id="admres" style="color: red; text-align: center;"></h3> -->
    <?php
        // if (isset($_SESSION['admres'])) {
        //     echo '<script>
        //         let resTag = document.getElementById("admres");
        //         resTag.innerHTML = "'.$_SESSION['admres'].'"
        //         setTimeout(function () {resTag.innerText = ""}, 5000);
        //         </script>
        //     ';
        //     unset($_SESSION['admres']);
        // }
        require("database.php");
        $query = "SELECT * FROM cart";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        // $num = mysqli_num_rows($result);
        if($num==0){
            echo '<div align="center">';
            echo '<h1>Cart is empty</h1>';
            echo '<a href="index.php"> <button class="btn btn-outline-success me-2" type="button">Go to home</button></a>';
            echo '</div>';


        }
        else{
        echo '<div class="products">';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="product">';
            echo '<img src="' . $row["imgurl"] . '" class="product-image">';
            echo '<div class="product-title">' . $row["name"] . '</div>';
            echo '<div class="product-price">$' . $row["price"] . '</div>';
            echo '<form method="POST" action="addToCart.php">';
            echo '<input type="text" name="prdt_id" value="'.$row['prdt_id'].'" hidden />';
            echo '<input type="submit" name="action" class="add-to-cart-btn" value="Remove" />';
            echo '</form>';
            echo '</div>';
        }
        echo '</div>';
    }
    ?>

    </body>
</html>
