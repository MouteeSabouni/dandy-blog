<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('likables', function (Blueprint $table) {
            $table->primary(['user_id' , 'likable_id', 'likable_type']);
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->morphs('likable'); // Adds likeable_id and likeable_type columns
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likables');
    }
};
