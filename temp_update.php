<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$order = \App\Models\Order::create(['user_id' => 20, 'order_number' => 'ORD-TEST-124', 'status' => 'delivered', 'subtotal' => 1399, 'total' => 1399, 'first_name' => 'Testing', 'last_name' => 'User', 'email' => 'thisisbusiness131322@gmail.com', 'phone' => '1234567890', 'address' => 'Test', 'city' => 'Test', 'payment_method' => 'cod', 'shipping_cost' => 0]);
\App\Models\OrderItem::create(['order_id' => $order->id, 'product_id' => 4, 'product_name' => 'Navy Geometric Dino Sweatshirt', 'quantity' => 1, 'price' => 1399, 'size' => '7-8Y']);
echo 'Order created!';
