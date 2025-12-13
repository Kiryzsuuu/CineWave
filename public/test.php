<?php
echo "PHP is working! Laravel path: " . __DIR__ . "/../";
echo "<br>Laravel bootstrap exists: " . (file_exists(__DIR__ . '/../bootstrap/app.php') ? 'YES' : 'NO');
echo "<br>Vendor autoload exists: " . (file_exists(__DIR__ . '/../vendor/autoload.php') ? 'YES' : 'NO');
phpinfo();
?>