<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<head>
  <title>Online Bakery Ordering and Delivery System</title>
  <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

  <h1>Bakery Online Ordering and Delivery System</h1>
  
  <form id="order-form" action="place-order.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="phone">Phone:</label>
    <input type="tel" id="phone" name="phone" required>
    
    <label for="delivery-date">Delivery Date:</label>
    <input type="datetime-local" id="delivery-date" name="delivery_date" required>
    
    <input type="submit" value="Place Order">
  </form>
  
  <script src="script.js"></script>

        <?php
      
// Connect to the database
$servername = "localhost";
$username = "Myuser";
$password = "SA1@123”";
$dbname = "bakery";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// PHP code for user login
session_start();

if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if($username == "Myuser" && $password == "SA1@123") {
    $_SESSION['username'] = $username;
    header("Location: dashboard.php");
  } else {
    echo "Invalid username or password";
  }
}

// Add a new customer
$sql = "INSERT INTO customers (name, email, phone, address) VALUES ('John Doe', 'johndoe@example.com', '555-555-5555', '123 Main St')";
if ($conn->query($sql) === TRUE) {
  $customer_id = $conn->insert_id;
  echo "New customer created successfully. Customer ID is " . $customer_id;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Place an order
$order_date = date('Y-m-d H:i:s');
$delivery_date = date('Y-m-d H:i:s', strtotime('+1 day'));
$sql = "INSERT INTO orders (customer_id, order_date, delivery_date) VALUES ($customer_id, '$order_date', '$delivery_date')";
if ($conn->query($sql) === TRUE) {
  $order_id = $conn->insert_id;
  echo "New order created successfully. Order ID is " . $order_id;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Add items to the order
$sql = "INSERT INTO order_items (order_id, item_name, quantity, price) VALUES ($order_id, 'Chocolate Cake', 2, 25.00), ($order_id, 'Apple Pie', 1, 20.00)";
if ($conn->query($sql) === TRUE) {
  echo "Items added to order successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Update inventory
$sql = "UPDATE inventory SET quantity = quantity - 2 WHERE item_id = 1";
if ($conn->query($sql) === TRUE) {
  echo "Inventory updated successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// PHP code for tracking an order
$order_id = 12345;

// Query database for order status
$query = "SELECT status FROM orders WHERE id = $order_id";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $status = $row['status'];
  echo "Order status: $status";
} else {
  echo "Order not found";
}

// PHP code for managing orders
// Query database for all orders
$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {
  // Display orders in a table
  echo "<table>";
  echo "<tr><th>ID</th><th>Customer</th><th>Item</th><th>Quantity</th><th>Price</th><th>Status</th></tr>";
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['customer'] . "</td>";
    echo "<td>" . $row['item'] . "</td>";
    echo "<td>" . $row['quantity'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $row['status'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "No orders found";
}

// PHP code for managing deliveries
// Query database for all deliveries
$query = "SELECT * FROM deliveries";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {
  // Display deliveries in a table
  echo "<table>";
  echo "<tr><th>ID</th><th>Order ID</th><th>Delivery Date</th><th>Delivery Time</th><th>Status</th></tr>";
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['order_id'] . "</td>";
    echo "<td>" . $row['delivery_date'] . "</td>";
    echo "<td>" . $row['delivery_time'] . "</td>";
    echo "<td>" . $row['status'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "No deliveries found";
}

// PHP code for updating the menu
$item = "Croissant";
$price = 3.50;

// Update price of item in database
$query = "UPDATE menu SET price = $price WHERE item = '$item'";
mysqli_query($conn, $query);

// PHP code for managing discounts
// Query database for all discounts
$query = "SELECT * FROM discounts";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {
  // Display discounts in a table
  echo "<table>";
  echo "<tr><th>ID</th><th>Item</th><th>Discount</th></tr>";
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['item'] . "</td>";
    echo "<td>" . $row['discount'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "No discounts found";
}

// PHP code for managing inventory
// Query database for all inventory items and quantities
$query = "SELECT * FROM inventory";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {
  // Display inventory in a table
  echo "<table>";
  echo "<tr><th>Item</th><th>Quantity</th></tr>";
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['item'] . "</td>";
    echo "<td>" . $row['quantity'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "No inventory items found";
}

// PHP code for stock management
$item = "Croissant";
$quantity = 10;

// Update quantity of item in inventory
$query = "UPDATE inventory SET quantity = $quantity WHERE item = '$item'";
mysqli_query($conn, $query);

// Close the connection
$conn->close();
?>

        
    

