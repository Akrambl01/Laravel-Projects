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
        // file in the database is stored as a blob
        // blob: is a binary large object that can store a large amount of data
        // or we can use path to store the file in the database, and store the file in the storage folder
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('image',150)->nullable()->after("bio");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};

// to add a column to the table we have to use the command line : php artisan make:migration migrationName --table=tableName
// migrationName as a convention should be like this : add_columnName_to_tableName_table 