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
        Schema::create('medias', function (Blueprint $table) {
            $table->string('id', 25)->primary();
            $table->string('file_name');
            $table->longText('file_path'); // file path url for delete
            $table->longText('file_url'); // public url
            $table->string('extension');
            $table->string('alt')->nullable();
            $table->string('caption')->nullable();
            $table->string('type'); // image or document
            $table->longText('partials')->nullable(); // small, medium, large
            $table->longText('meta')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
};
