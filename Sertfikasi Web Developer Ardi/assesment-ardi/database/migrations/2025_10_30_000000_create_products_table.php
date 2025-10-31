<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail')->nullable(); // path gambar (public/storage atau /images)
            $table->string('category');              // mis. Iphone 13 Pro
            $table->string('product');          // mis. Iphone
            $table->unsignedBigInteger('harga');     // harga dalam rupiah
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('products');
    }
};
