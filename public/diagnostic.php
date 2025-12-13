<?php
// Test PHP and environment on Azure
header('Content-Type: text/plain');

echo "=== CineWave Azure Diagnostic ===\n\n";

echo "1. PHP Version: " . phpversion() . "\n";
echo "2. PHP Extensions:\n";
$required = ['mongodb', 'openssl', 'pdo', 'mbstring', 'tokenizer', 'xml', 'ctype', 'json', 'bcmath', 'curl'];
foreach ($required as $ext) {
    echo "   - $ext: " . (extension_loaded($ext) ? "✓ Loaded" : "✗ NOT Loaded") . "\n";
}

echo "\n3. Environment Variables:\n";
$envVars = ['APP_ENV', 'APP_DEBUG', 'DB_CONNECTION', 'MONGODB_DSN', 'MONGODB_DATABASE'];
foreach ($envVars as $var) {
    $value = getenv($var) ?: $_ENV[$var] ?? $_SERVER[$var] ?? 'NOT SET';
    if ($var === 'MONGODB_DSN' && $value !== 'NOT SET') {
        // Mask password
        $value = preg_replace('/:([^:@]+)@/', ':****@', $value);
    }
    echo "   - $var: $value\n";
}

echo "\n4. File System:\n";
echo "   - Document Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'N/A') . "\n";
echo "   - Current Dir: " . getcwd() . "\n";
echo "   - Script: " . ($_SERVER['SCRIPT_FILENAME'] ?? 'N/A') . "\n";

$paths = [
    '/home/site/wwwroot',
    '/home/site/wwwroot/public',
    '/home/site/wwwroot/vendor',
    '/home/site/wwwroot/storage',
    '/home/site/wwwroot/bootstrap/cache'
];
foreach ($paths as $path) {
    echo "   - $path: " . (is_dir($path) ? "✓ Exists" : "✗ Not Found") . "\n";
}

// Test MongoDB Connection
echo "\n5. MongoDB Connection Test:\n";
$dsn = rawurldecode(getenv('MONGODB_DSN') ?: $_ENV['MONGODB_DSN'] ?? $_SERVER['MONGODB_DSN'] ?? '');
if (!empty($dsn)) {
    try {
        if (extension_loaded('mongodb')) {
            $manager = new MongoDB\Driver\Manager($dsn);
            $command = new MongoDB\Driver\Command(['ping' => 1]);
            $manager->executeCommand('admin', $command);
            echo "   ✓ MongoDB connection successful!\n";
        } else {
            echo "   ✗ MongoDB extension not loaded\n";
        }
    } catch (Exception $e) {
        echo "   ✗ MongoDB Error: " . $e->getMessage() . "\n";
    }
} else {
    echo "   ✗ MONGODB_DSN not set\n";
}

echo "\n=== End Diagnostic ===\n";
