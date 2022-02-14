<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnotherAccount extends Model
{

    protected $table = 'account';

    protected $fillable = [
        'account_name',
        'email',
        'password',
        'account_type',
        'phone_number',
        'account_type_id',
        'status_id',
        'resturant_category_id',
        'package_expiration_at',
        'main_id',
        'device_token'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function adminNotifications()
    {
        $query = Notification::query()->join('account', 'notifications.notifiable', '=', 'account.id')
            ->where('notifiable_type', 'restaurant')
            ->select('account.id', 'account.account_name','account.logo_path', 'notifications.data', 'notifications.type', 'notifications.created_at')
            ->orderBy('notifications.id', 'desc')->get();
        return $query;
    }

    public function restaurantNotifications(){
        $query = Notification::query()->join('customers', 'notifications.notifiable', '=', 'customers.id')
            ->where('notified', auth()->id())
            ->where('notifiable_type', 'customer')
            ->select('customers.username', 'notifications.data', 'notifications.type', 'notifications.created_at')
            ->orderBy('notifications.id', 'desc')->get();
        return $query;

    }


    public function currency()
    {
        return $this->belongsToMany(Currency::class, 'account_currency', 'account_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'resturant_category_id')->select('id', 'category_name','category_name_ar', 'category_photo');
    }

    public function sub_category()
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
        return $this->hasOne(Address::class,'account_id')->select('id', 'area_id', 'address', 'latitude', 'longitude', 'account_id');
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
}
