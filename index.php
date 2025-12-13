<?php

/**
 * Laravel - Azure App Service Entry Point (Fallback)
 * 
 * For Linux App Service with nginx, requests should be routed
 * to public/index.php directly. This file acts as fallback.
 */

// Redirect to public folder if accessed directly
if (file_exists(__DIR__ . '/public/index.php')) {
    chdir(__DIR__ . '/public');
    require __DIR__ . '/public/index.php';
} else {
    http_response_code(500);
    echo 'Laravel application not found.';
}
