<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$admin = User::where('email', 'admin@aimee.com')->first();
if ($admin) {
    $admin->password = Hash::make('admin123');
    $admin->save();
}

$user = User::where('email', 'thisisbusiness131322@gmail.com')->first();
if ($user) {
    $user->password = Hash::make('password123');
    $user->save();
}

echo "Passwords successfully updated!\n";
