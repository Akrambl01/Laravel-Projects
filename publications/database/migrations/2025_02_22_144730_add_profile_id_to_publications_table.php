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
        Schema::table('publications', function (Blueprint $table) {
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->dropForeign(['profile_id']);
            $table->dropColumn('profile_id');
        });
    }
};

// Relationships in Laravel Eloquent ORM allow you to define the relationship between two models.
/**
 * One to One 1-1
 * One to Many 1-*
 * One to many inverse *-1 : that means the foreign key is in the other table ex : could many publications belong to one profile
 * Many to Many *-* 
 */