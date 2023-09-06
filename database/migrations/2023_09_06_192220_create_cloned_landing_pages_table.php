<?php

use App\Models\ClonedLandingPageCategory;
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
        Schema::create('cloned_landing_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ClonedLandingPageCategory::class)->nullable();

            $table->text('url');

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
        Schema::dropIfExists('cloned_landing_pages');
    }
};
