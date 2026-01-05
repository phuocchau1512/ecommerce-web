<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // KHỚP KIỂU DỮ LIỆU VỚI DB CŨ
            $table->unsignedBigInteger('order_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('variant_id');

            $table->string('product_name');
            $table->string('variant_name');

            $table->integer('quantity');
            $table->decimal('price', 15, 2);

            $table->timestamps();

            // FOREIGN KEYS (VIẾT TAY – KHÔNG DÙNG constrained())
            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade');

            $table->foreign('variant_id')
                ->references('id')->on('product_variants')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
