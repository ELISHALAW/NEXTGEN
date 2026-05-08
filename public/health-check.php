<?php
/**
 * Deployment Health Check
 * 
 * Place this file in your public directory as public/health-check.php
 * Access it at: https://your-app.onrender.com/health-check.php
 * 
 * This script will verify that all critical components are working
 */

header('Content-Type: application/json');

$health = [
    'status' => 'ok',
    'timestamp' => date('Y-m-d H:i:s'),
    'checks' => []
];

// Check PHP Version
$health['checks']['php_version'] = [
    'status' => 'ok',
    'version' => phpversion()
];

// Check if Laravel is properly configured
try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require __DIR__ . '/../bootstrap/app.php';
    
    $health['checks']['laravel'] = [
        'status' => 'ok',
        'message' => 'Laravel framework loaded successfully'
    ];
    
    // Check if APP_KEY is set
    $appKey = env('APP_KEY');
    if ($appKey) {
        $health['checks']['app_key'] = [
            'status' => 'ok',
            'message' => 'APP_KEY is configured'
        ];
    } else {
        $health['checks']['app_key'] = [
            'status' => 'error',
            'message' => 'APP_KEY is not configured'
        ];
        $health['status'] = 'warning';
    }
    
    // Check environment
    $health['checks']['environment'] = [
        'status' => 'ok',
        'env' => env('APP_ENV', 'unknown')
    ];
    
    // Check debug mode (should be false in production)
    $debugMode = env('APP_DEBUG', false);
    $health['checks']['debug_mode'] = [
        'status' => $debugMode ? 'warning' : 'ok',
        'debug' => $debugMode,
        'message' => $debugMode ? 'DEBUG MODE IS ENABLED - Disable in production!' : 'Debug mode is properly disabled'
    ];
    
    // Check storage directory permissions
    $storagePath = __DIR__ . '/../storage';
    if (is_writable($storagePath)) {
        $health['checks']['storage_writable'] = [
            'status' => 'ok',
            'message' => 'Storage directory is writable'
        ];
    } else {
        $health['checks']['storage_writable'] = [
            'status' => 'error',
            'message' => 'Storage directory is NOT writable'
        ];
        $health['status'] = 'warning';
    }
    
    // Check public directory
    if (is_writable(__DIR__)) {
        $health['checks']['public_writable'] = [
            'status' => 'ok',
            'message' => 'Public directory is writable'
        ];
    } else {
        $health['checks']['public_writable'] = [
            'status' => 'warning',
            'message' => 'Public directory is not writable (this is usually fine)'
        ];
    }
    
} catch (Exception $e) {
    $health['status'] = 'error';
    $health['checks']['laravel'] = [
        'status' => 'error',
        'message' => $e->getMessage()
    ];
}

http_response_code($health['status'] === 'error' ? 500 : 200);
echo json_encode($health, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
?>
