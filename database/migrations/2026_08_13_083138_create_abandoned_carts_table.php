<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('abandoned_carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('email')->nullable();
            $table->longText('cart_data')->nullable(); // Store JSON representation of the cart
            $table->decimal('total_value', 10, 2)->default(0);
            $table->integer('funnel_step')->default(0); // 0=Active, 1=Reminder Sent, 2=Discount Sent, 3=FOMO Sent, 4=Cleared, 5=Recovered
            $table->foreignId('generated_coupon_id')->nullable()->constrained('coupons')->onDelete('set null');
            $table->timestamp('last_active_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abandoned_carts');
    }
};
