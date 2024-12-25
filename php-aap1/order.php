<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<h1>Order Confirmed</h1>";
    echo "<p>Thank you for your order!</p>";
} else {
    echo "<h1>Place Your Order</h1>";
    echo "<form method='POST' action='order.php'>";
    echo "<label for='name'>Name:</label><br>";
    echo "<input type='text' id='name' name='name' required><br>";
    echo "<label for='product'>Product:</label><br>";
    echo "<input type='text' id='product' name='product' required><br>";
    echo "<label for='quantity'>Quantity:</label><br>";
    echo "<input type='number' id='quantity' name='quantity' required><br><br>";
    echo "<input type='submit' value='Order'>";
    echo "</form>";
}
?>
