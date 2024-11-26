<?php

namespace App;

use App\Model\Cart;
use App\Model\Order;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone_no', 'dob', 'address', 'shipping_address', 'billing_address', 'martial_status', 'type', 'status', 'post_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function type(){
        if ($this->type == 1) {
            return '<button class="btn btn-success btn-xs">Admin</button>';
        }elseif ($this->type == 2) {
            return '<button class="btn btn-primary btn-xs">Customer</button>';
        }
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'cart_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
