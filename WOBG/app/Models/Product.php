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
        "max_players",
        'product_category_id',
        'produc_subcategory_id',
    ];

    // limit the number of characters in description
    public function getShortenedDescription(): string
    {
        if (strlen($this->description) > 155) {
            return substr($this->description, 0, 155) . "...";
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
        return $this->belongsTo(ProductSubcategory::class, 'product_sub_category_id');
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class)->orderBy('id');
    }

    public function mainPhoto()
    {
        return $this->hasOne(ProductPhoto::class)->where('name', "ilike", "%" . "main" . "%");
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
