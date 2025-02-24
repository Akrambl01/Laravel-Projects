<?php

namespace App\Models;

use App\Models\Publication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    // to use date fields in the model (created_at, updated_at, deleted_at) as carbon instances
    // carbon instances are instances of the Carbon class(package) that is used to work with dates in laravel
    protected $dates = ["deleted_at"];
    // to make the fields fillable ( to be able to insert data in the database using the create() method)
    protected $fillable = ["name", "email", "password", "bio", "image"];
    // to can use factory method
    use HasFactory;

    // to use soft delete
    use SoftDeletes;

    public function getImageAttribute($value)
    // this functions is used to get the image from the database and if the image is null it will return the default image value when i use the image attribute in the view
    {
        return $value ? $value : "profiles/user.png";
    }

    public function publications()
    {
        // this function is used to define the relationship between the profile model and the publication model
        // the relationship is one to many (one profile has many publications)
        // the first parameter is the model that we want to relate to (Publication::class)
        // the second parameter is the foreign key (profile_id) in the publications table
        // the third parameter is the local key (id) in the profiles table
        return $this->hasMany(Publication::class, "profile_id", "id");
    }

    // Automatically soft delete publications when a profile is soft deleted
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($profile) {
            $profile->publications()->delete(); // Soft delete all related publications
        });
    }
    
}

// the model is a class that represents a table in the database and it is used to interact with the database
// to create a model using the command line : php artisan make:model ModelName
// to create a model with a migration file using the command line : php artisan make:model ModelName -m
// to create a model with a migration file and a factory file using the command line : php artisan make:model ModelName -mf

// the orm is a way to interact with the database using objects instead of writing sql queries:
// - to insert data in the database we can use the create() method
// - to get all the data from the database we can use the all() method
// - to get the data from the database with the id = $id we can use the find() method

// how orm works with model and migration:  
// 1- create a model using the command line : php artisan make:model ModelName
// 2- create a migration file using the command line : php artisan make:migration create_table_name_table
// 3- in the migration file we can define the schema of the table that we want to create in the database
// 4- run the migration using the command line : php artisan migrate or php artisan migrate:fresh (to delete all the tables in the database and create them again)
// 5- in the model we can define the fields that we want to insert in the database using the create() method





