<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$products = get_products();
$used_ids = [];
foreach ($products as $p) {
    preg_match('/(media__\d+)/', $p['image_path'], $matches);
    if (!empty($matches[1])) {
        $used_ids[] = $matches[1];
    }
}
$used_ids = array_unique($used_ids);

$dir = public_path('assets/images/products/');
$files = scandir($dir);
$deleted = 0;
foreach ($files as $file) {
    if ($file === '.' || $file === '..' || $file === 'front.jpg' || $file === 'back.jpg' || $file === 'lifestyle.jpg') continue;
    
    $is_used = false;
    foreach ($used_ids as $uid) {
        if (strpos($file, $uid) === 0) {
            $is_used = true;
            break;
        }
    }
    
    if (!$is_used) {
        unlink($dir . $file);
        $deleted++;
        echo "Deleted: $file\n";
    }
}
echo "Total deleted $deleted unused files.\n";
