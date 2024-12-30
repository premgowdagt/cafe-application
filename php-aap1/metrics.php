<?php
// Simple metrics for testing
header('Content-Type: text/plain');
echo "# Metrics\n";
echo "http_requests_total{method=\"get\",status=\"200\"} 1027\n";
echo "http_requests_total{method=\"post\",status=\"500\"} 3\n";
?>
