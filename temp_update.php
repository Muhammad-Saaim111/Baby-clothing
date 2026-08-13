<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$c = \App\Models\AbandonedCart::orderBy('id', 'desc')->first();
if($c) {
    $c->funnel_step = 3; // Assume FOMO was already sent (or skipped)
    $c->last_active_at = now()->subHours(4); // 3.5+ hours passed
    $c->save();
    echo "Updated Cart ID {$c->id} for Step 4\n";
}
