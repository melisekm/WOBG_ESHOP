<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'phone_number',
        'first_name',
        "surname",
        "total",
        "postal_code",
        "country",
        "street",
        "city",
        "payment",
        "shipping"
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
