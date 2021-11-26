<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        "surname",
        "city",
        "street",
        "country",
        "postal_code",
        "phone_number",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // pozrie v medzivazobnej tabulke a vytvori objekt ekvivalentny tomu co mame v session
    // bude to objekt cart, ktory je asociativne pole id produktov, ktore obsahuju pole a v nom element quantity
    public function getProductsInCartWithQuantity()
    {
        $user_products = $this->products()->get();
        $cart_items = [];
        foreach ($user_products as $user_product) {
            $cart_items[$user_product->id] = [
                "quantity" => $user_product->pivot->quantity
            ];
        }
        return $cart_items;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}
