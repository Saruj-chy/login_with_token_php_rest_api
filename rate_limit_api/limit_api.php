<?php
$maxRequests = 10; // Max  10 requests allowed
$windowTime  = 60;   // Time window in seconds (1 min)
$post        = [];

$ip = $_SERVER['REMOTE_ADDR']; 
$rateLimitDir = __DIR__ . '/rate_limit_logs'; // Folder to store logs
if (!file_exists($rateLimitDir)) {
    mkdir($rateLimitDir, 0755, true);
}
$logFile = "$rateLimitDir/" . md5($ip) . ".log";
$now      = time();
$requests = [];
if (file_exists($logFile)) {
    $requests           = explode("\n", trim(file_get_contents($logFile)));
    $firstLoadTime       = $requests[0];
    // $diff               = $now - $firstLoadTime;

    // Remove old requests
    $requests = array_filter($requests, function ($firstLoadTime) use ($now, $windowTime) {
        return ($now - (int) $firstLoadTime) < $windowTime;
    });
}

if (count($requests) >= $maxRequests) {
    http_response_code(429);
    $post['success'] = 429;
    $post['message'] = "Rate limit exceeded. Try again later.";
    
} else {
    $requests[] = $now;
    file_put_contents($logFile, implode("\n", $requests));
    header('Content-Type: application/json');
    $post['success'] = 200;
    $post['message'] = "Request OK";
}

echo json_encode($post);
?>