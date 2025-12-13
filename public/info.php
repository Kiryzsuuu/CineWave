<?php
echo "<h1>CineWave Laravel App</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Laravel Path: " . __DIR__ . "/../</p>";
echo "<p>Bootstrap exists: " . (file_exists(__DIR__ . '/../bootstrap/app.php') ? 'YES' : 'NO') . "</p>";
echo "<p>Vendor exists: " . (file_exists(__DIR__ . '/../vendor/autoload.php') ? 'YES' : 'NO') . "</p>";

// Test Laravel bootstrap
try {
    require_once __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    echo "<p style='color: green;'>✅ Laravel Bootstrap: SUCCESS</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Laravel Bootstrap Error: " . $e->getMessage() . "</p>";
}
?>