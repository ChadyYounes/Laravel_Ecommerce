<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*************************** */
    public function getRole() {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function getCurrency()
    {
        return $this->belongsTo(Currency::class,'base_currency','id');
    }
    public function getProfile() {
        return $this->hasOne(Profile::class);
    }

    public function getStores()
    {
        return $this->hasMany(Store::class);
    }
    public function getShoppingCart()
    {
        return $this->hasOne(ShoppingCart::class);
    }
    public function getFollowedStores()
    {
        return $this->hasMany(StoreFollower::class,'user_id','id');
    }
    public function isFollowing($storeId)
    {
        // Check if the user has a relationship with the given store
        return $this->getFollowedStores()->where('store_id', $storeId)->where('user_id',Auth::id())->exists();
    }
    public function getReviews()
    {
        return $this->hasMany(ProductReview::class,'user_id','id');
    }

    

}
