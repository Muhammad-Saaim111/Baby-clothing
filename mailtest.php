<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Mail;

try {
    Mail::raw('This is a test email from Laravel.', function ($message) {
        $message->to('saaimch204@gmail.com')
                ->subject('Test Email');
    });
    echo "Mail sent successfully.\n";
} catch (\Exception $e) {
    echo "Error sending mail: " . $e->getMessage() . "\n";
}
