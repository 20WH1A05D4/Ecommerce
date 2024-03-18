                                                        Ecommerce 	Documentation
EC2 public IP to access website		:  65.0.19.46			

Github link for Code:							:  https://github.com/20WH1A05D4/Ecommerce				


Our E-commerce Clothing Website is built using PHP, MySQL, HTML, and CSS. It provides a user-friendly interface for browsing and purchasing clothing items. Users can register, login, browse products, add items to cart, and checkout.

-> User Registration and Login
-> Navigate to the website and click on the "Register" link to create a new account.
-> After registration, you can login with your credentials using the "Login" link.
-> Browsing Products
      Once logged in, you can browse through the available clothing in men and women category.
-> Adding Items to Cart
      Use the "Add to Cart" button to add the item to your shopping cart.
-> Checkout
      Navigate to the shopping cart page to review your selected items.
      Proceed to checkout.
-> Complete the checkout process to place your order.
-> Obtaining and Using JWT Tokens for Authentication
      Our website uses JWT (JSON Web Tokens) for authentication. After successful login, the server generates a JWT token and sends it to the client. The client          includes this token in subsequent requests to access protected endpoints.

->To obtain and use JWT tokens:

1. Register or login to the website.
2. Upon successful login, the server sends a JWT token in the response.

-> Website Hosting
1. Launching an EC2 Instance
2. Connecting to the EC2 Instance
3. Setting Up the Environment i.e install all the required installations (php,mysql etc)
4. Deploying the E-commerce Website
Upload your website files to the EC2 instance.
Move the website files to the web server's document root directory (/var/www/html).
5. Accessing the Website
Open a web browser and enter the EC2 instance's public IP address
You will see the homepage of your E-commerce Clothing Website.
Test the functionality of the website, including registration, login, browsing products, and placing orders.

->API Endpoints:
USERS:
65.0.19.46/shopnow.php/getusers
PRODUCTS:
65.0.19.46/shopnow.php/getproducts
ADMIN:
65.0.19.46/shopnow.php/postproducts
65.0.19.46/shopnow.php/updateproducts
65.0.19.46/shopnow.php/deleteproducts
CART:
65.0.19.46/shopnow.php/getcart
65.0.19.46/shopnow.php/postcart



