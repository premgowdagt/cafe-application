<?php
// Check if the request is for the /metrics endpoint
if ($_SERVER['REQUEST_URI'] == '/metrics') {
    // Expose Prometheus metrics
    header('Content-Type: text/plain');

    // Example of basic metrics, you can add more here as needed
    echo "# HELP php_requests_total Total number of requests\n";
    echo "# TYPE php_requests_total counter\n";
    echo "php_requests_total{method=\"get\"} 12345\n"; // Example request count (replace with actual logic)
    echo "php_requests_total{method=\"post\"} 6789\n"; // Example request count (replace with actual logic)

    // Example of PHP-FPM metrics (if applicable)
    echo "# HELP php_fpm_requests_total Total PHP-FPM requests\n";
    echo "# TYPE php_fpm_requests_total counter\n";
    echo "php_fpm_requests_total{status=\"accepted\"} 1500\n"; // Example value
    echo "php_fpm_requests_total{status=\"handled\"} 1490\n";  // Example value

    // Exit after serving the metrics
    exit;
}

// Default behavior for normal index.php page
echo "<h1>Prem welcome to Cafe</h1>";
echo "<p><a href='menu.php'>View Menu</a></p>";
echo "<p><a href='order.php'>Place an Order</a></p>";
?>
