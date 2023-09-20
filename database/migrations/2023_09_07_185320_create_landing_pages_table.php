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
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->longText('html')->nullable();
            $table->longText('css')->nullable();
            $table->longText('assets')->nullable();

            $table->longText('data')->nullable();

            $table->text('custom_header')->nullable();
            $table->text('custom_footer')->nullable();

            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();

            $table->text('social_title')->nullable();
            $table->text('social_description')->nullable();
            $table->text('social_keywords')->nullable();
            $table->text('social_image')->nullable();

            $table->string('ftp_host')->nullable();
            $table->string('ftp_user')->nullable();
            $table->string('ftp_password')->nullable();
            $table->string('ftp_path')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_pages');
    }
};
