<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedTinyInteger('category_id')->nullable();
            $table->string('slug');
            $table->string('title');
            $table->string('meta_description');
            $table->text('content');
            $table->string('thumbnail');
            $table->string('image');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('page_categories')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
