<!DOCTYPE html>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<?php
session_start();
require("database.php");
if (!isset($_SESSION['username'])) {header('location: logout.php');}
?>
<div class="d-flex justify-content-center">
                <div class=" col-md-6  my-5 table-responsive p-5">
                    <table class="table table-striped table-bordered table-hover ">
                    <?php
$sum = 0;
$username = $_SESSION['username'];
$query = " SELECT * FROM cart where username='".$username."';";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) >= 1) {
    ?>
                        <thead>
                            <tr>
                                <th>Item Number</th>
                                <th>Item Name</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tbody>
                                <?php
$index=1;
while ($row = mysqli_fetch_array($result)) {
        $sum += $row["price"];
        //$id = $row["id"] . ", ";
        echo "<tr><td>" . "#" . $index . "</td><td>" . $row["name"] . "</td><td>$ " . $row["price"] . "</td></tr>";
        $index++;
    }
    
    //$id = rtrim($id, ", ");
    echo "<tr><td></td><td>Total</td><td>$ " . $sum . "</td></tr>";
    if(isset($_GET["action"]) && $_GET["action"]=="checkout" ){
        while ($row = mysqli_fetch_array($result)) {
            $query = "insert into orders values('".$username."',".$row['prdt_id'].",".$row['price'].";";
            $result = mysqli_query($conn, $query);
        }
        $query = "delete from cart where username='".$username."';";
        $result = mysqli_query($conn, $query);
        echo '<script>
                alert("order placed successfully");
                window.location = "index.php";

                </script>
            ';

    }

    ?>
                            </tbody>
                            <?php
} else {
    echo "<div> <img src='images/emptycart.png' class='image-fluid' height='150' width='150'></div><br/>";
    echo "<div class='text-bold  h5'>Add items to the cart first!<div>";

}
?>
                        <?php
?>
                        </tbody>
                    </table>
                    <a href="checkout.php?action=checkout" id="checkout" class='btn btn-primary'>Confirm Order</a>
                    </html>
