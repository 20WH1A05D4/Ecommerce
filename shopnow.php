<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "MySQL";
$database = "ecommerce";

// Create database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set headers to allow cross-origin resource sharing (CORS)
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

// Extract endpoint and additional parameters from the request URL
 $request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
 $endpoint = isset($request_uri[1]) ? $request_uri[1] : '';
 $method = $_SERVER['REQUEST_METHOD'];
 echo $endpoint;
// //$additional_params = array_slice($request_uri, 3);

// // Define API endpoints
 switch ($endpoint) {
    case 'getusers':
         //echo "users_endpoint";
         getUsers($conn);
         break;
     case 'getproducts':
         //echo "products_endpoint";
         getProducts($conn);
         break;
     case 'postproducts':
         //echo "products_endpoint";
         postProducts($conn,$method);
         break;
    case 'deleteproducts':
        //echo "products_endpoint";
        deleteProducts($conn,$method);
        break;
    case 'updateproducts':
        //echo "products_endpoint";
        updateProducts($conn,$method);
        break;
     case 'getcart':
         //echo "products_endpoint";
         getCartItems($conn);
         break;
     case 'postcart':
         //echo "products_endpoint";
         postCartItems($conn,$method);
         break;

     default:
         header("HTTP/1.1 404 Not Found");
         echo json_encode(array("message" => $request_uri));
         break;
 }

// // Close database connection
 $conn->close();

 function getUsers($conn) {
        $query = "SELECT * FROM users";
    $result = $conn->query($query);

    // Check if the query was successful
    if ($result) {
        // Fetch the results as an associative array
        $users = array();
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        // Display or use the fetched data as needed
        echo json_encode($users);
    } else {
        echo json_encode(array("error" => "Error fetching users: " . $conn->error));
    }
}
 function getProducts($conn){
    $query = "SELECT * FROM products";
    $result = $conn->query($query);
// Check if the query was successful
if ($result) {
    // Fetch the results as an associative array
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    // Display or use the fetched data as needed
    echo json_encode($products);
    
} 
}

function postProducts($conn,$method){
    //echo $method;
    if($method=="POST"){
        $postData = json_decode(file_get_contents("php://input"), true);
        $id=$postData["id"];
        $name=$postData["name"];
        $price=$postData["price"];
        $imgurl=$postData["imgurl"];
        $cat=$postData["category"];
        // $created=$postData["created_at"];
        // $updated=$postData["updated_at"];
        $query = "insert into products values(null, '".$name."', ".$price.", ".$imgurl.", '".$cat."');";
        echo $query;
        // $query = ("insert into products values(null,%s,%s,%d,%s,%s,%s)",$name,$desc,$price,$cat,$created,$updated);
        $result = $conn->query($query);
        if ($result) {
            echo "Insertion successful!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
    else{
        echo "method not allowed";
    }
}
function deleteProducts($conn, $method) {
    if ($method == "DELETE") {
        // Get product ID from request body
        $postData = json_decode(file_get_contents("php://input"), true);
        $id = $postData["id"];

        // Check if ID is provided
        if (!isset($id)) {
            echo json_encode(array("error" => "Product ID is required for deletion"));
            return;
        }

        // Prepare and execute the delete query
        $query = "DELETE FROM products WHERE id = $id";
        $result = $conn->query($query);

        // Check if deletion was successful
        if ($result) {
            echo json_encode(array("message" => "Product deleted successfully"));
        } else {
            echo json_encode(array("error" => "Error deleting product: " . $conn->error));
        }
    } else {
        // If method is not DELETE, return method not allowed error
        echo json_encode(array("error" => "Method not allowed"));
    }
}
function updateProducts($conn, $method) {
    if ($method == "PUT") {
        // Get updated product details from request body
        $postData = json_decode(file_get_contents("php://input"), true);
        $id = $postData["id"];
        $name = $postData["name"];
        $price = $postData["price"];
        $imgurl = $postData["imgurl"];
        $category = $postData["category"];

        // Check if ID is provided
        if (!isset($id)) {
            echo json_encode(array("error" => "Product ID is required for update"));
            return;
        }

        // Prepare and execute the update query
        $query = "UPDATE products SET name = '$name', price = $price, imgurl = '$imgurl', category = '$category' WHERE id = $id";
        $result = $conn->query($query);

        // Check if update was successful
        if ($result) {
            echo json_encode(array("message" => "Product updated successfully"));
        } else {
            echo json_encode(array("error" => "Error updating product: " . $conn->error));
        }
    } else {
        // If method is not PUT or PATCH, return method not allowed error
        echo json_encode(array("error" => "Method not allowed"));
    }
}
function getCartItems($conn){
    $query = "SELECT * FROM cart";
    $result = $conn->query($query);
// Check if the query was successful
if ($result) {
    // Fetch the results as an associative array
    $cart = array();
    while ($row = $result->fetch_assoc()) {
        $cart[] = $row;
    }

    // Display or use the fetched data as needed
    echo json_encode($cart);
    
} 
}

function postCartItems($conn,$method){
    //echo $method;
    if($method=="POST"){
        $postData = json_decode(file_get_contents("php://input"), true);
        $username=$postData["username"];
        $prdt_id=$postData["prdt_id"];
        $name=$postData["name"];
        $price=$postData["price"];
        $imgurl=$postData["imgurl"];
        // $created=$postData["created_at"];
        // $updated=$postData["updated_at"];
        $query = "insert into cart values('".$username."',".$prdt_id.", '".$name."', ".$price.", '".$imgurl."');";
        // $query = ("insert into products values(null,%s,%s,%d,%s,%s,%s)",$name,$desc,$price,$cat,$created,$updated);
        $result = $conn->query($query);
        if ($result) {
            echo "Insertion successful!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
    else{
        echo "method not allowed";
    }
}

?>
