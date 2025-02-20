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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('email',70)->unique();
            $table->string('password',60);
            $table->text('bio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};

// the migration: is a file that contains the schema of the table that we want to create in the database 
// to create a table in the database we have to use the command line : php artisan make:migration migrationName
// to run the migration we have to use the command line : php artisan migrate or php artisan migrate:fresh (to delete all the tables in the database and create them again)

// the role of migrations is to create the tables in the database and to modify them and to delete them...
// migrations like a version control for the database
