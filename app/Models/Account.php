<?php

namespace App\Models;

use App\Traits\AccountModelTrait;
use App\Traits\HasPermissionsTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Account extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, AccountModelTrait, HasPermissionsTrait;

    protected $table = 'account';

//    protected $fillable = [
//        'account_name',
//        'email',
//        'password',
//        'account_type',
//        'phone_number',
//        'account_type_id',
//        'status_id',
//        'resturant_category_id',
//        'package_expiration_at',
//        'main_id',
//        'device_token',
//        'work_status_id',
//        'min_order',
//        'closing_time',
//        'opening_time',
//    ];
    protected $guarded = [];


    protected $visible = ['account_name', 'email', 'phone_number', 'created_at'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public const IS_ADMIN = 1;
    public const IS_RESTAURANT = 2;
    public const SUPER_ADMIN = 146;


    public function items()
    {
        return $this->hasMany(item::class, 'restaurant_id');
    }

    public function currency()
    {
        return $this->belongsToMany(Currency::class, 'account_currency', 'account_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'resturant_category_id');
    }

    public function sub_category()
    {
        return $this->belongsToMany(SubCategory::class, 'restaurant_sub_category', 'restaurant_id')->withPivot('id', 'image_path');
    }

    public function sub_category_pivot()
    {
        return $this->hasMany(RestaurantSubCategory::class, 'restaurant_id')->select('id', 'restaurant_id', 'sub_category_id', 'image_path');

    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function code()
    {
        return $this->belongsTo(Sales::class, 'sales_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function verifyUser()
    {
        return $this->hasOne(verifyAccount::class);
    }

    public function bank()
    {
        return $this->hasOne(BankingDetails::class);
    }

    public function payment()
    {
        return $this->hasOne(AccountPaymentLog::class)->where('status', 'initial');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Comment_model::class, 'destination_id');
    }

    public function rates(): HasMany
    {
        return $this->hasMany(evaluation_model::class, 'restaurant_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'restaurant_id');
    }

    public function work_status()
    {
        return $this->belongsTo(work_status::class, 'work_status_id');
    }

    public function minPrice()
    {
        return $this->hasMany(MinPriceModel::class);
    }

}
