<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens ;

    public $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $visible = ['username', 'email', 'phone_number', 'status_id', 'created_at', 'address'];

    protected $fillable = [
        'username',
        'email',
        'phone_number',
        'status_id',
        'password',
        'verification_link',
        'main_id',
        'platform_id',
        'login_token',
        'platform_kind',
        'verification_link'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function address(){
        return $this->hasMany(CustomerAddress::class, 'customer_id');
    }

    public function order(){
        return $this->hasMany(Order::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }
}
