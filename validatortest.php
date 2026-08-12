<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$start = microtime(true);
$validator = \Illuminate\Support\Facades\Validator::make(
    ['email' => 'test@example.com'],
    ['email' => 'unique:users']
);
$validator->fails();
echo "Validator took " . (microtime(true) - $start) . " seconds\n";
