<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'publisher',
        "description",
        "includes",
        "language",
        "release_date",
        "min_age",
        "min_play_time",
        "min_players",
        "max_players"
    ];

    // limit the number of characters in description
    public function getShortenedDescription(): string
    {
        if (strlen($this->description) > 100) {
            return substr($this->description, 0, 100) . "...";
        }
        return $this->description;
    }


    // function to separate lines in includes by new line and return array
    public function getParsedIncludes(): array
    {
        return explode("\n", $this->includes);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(ProductSubcategory::class, 'product_subcategory_id');
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class)->whereIn("name", ["main_900", "back_900", "play_900"]);

//        return $this->hasMany(ProductPhoto::class);
    }

    public function mainPhoto()
    {
        return $this->hasOne(ProductPhoto::class)->where("name", "main_900");
    }

//    public function productPagePhotos()
//    {
//        return $this->hasMany(ProductPhoto::class)->whereIn("name", ["main_900", "back_900", "play_900"]);
//    }

    public function mainPhotos()
    {
        return $this->hasMany(ProductPhoto::class)->where('name', "ilike", "%" . "main" . "%");
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }


}
