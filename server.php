<?php
// Simple PHP development server router
// This file helps serve the web application properly

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Serve static files directly
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false;
}

// Route everything else to index.php
require_once __DIR__ . '/public/index.php';