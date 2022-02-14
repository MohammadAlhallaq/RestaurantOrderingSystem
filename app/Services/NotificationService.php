<?php

namespace App\Services;

use App\Models\Account;
use App\Notifications\FirebaseNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NotificationService{

    public static function NotifyAdmin($type ,$account_id, $title, $message, $message2){
        $firebaseToken = Account::whereNotNull('device_token')->where('account_type_id', 1)->pluck('device_token')->all();
        $notify = new FirebaseNotification($title, $message, $firebaseToken);
        $result = $notify->sendNotification();
        if ($result) {
            DB::table('notifications')->insert([
                'type' => $type,
                "notifiable" => $account_id,
                'notifiable_type' => 'restaurant',
                "notified_type" => 'admin',
                'data' => $message2,
                'created_at' => Carbon::now()->toDateTimeString()

            ]);
        }
    }


    public static function NotifyRestaurant($type ,$source_id, $destination_id, $title, $message, $message2){
        $firebaseToken = Account::whereNotNull('device_token')->where('account_type_id', 2)->where('id', $destination_id)->pluck('device_token');
        $notify = new FirebaseNotification($title, $message, $firebaseToken);
        $result = $notify->sendNotification();
        if ($result) {
            DB::table('notifications')->insert([
                'type' => $type,
                "notifiable" => $source_id,
                'notifiable_type' => 'customer',
                'notified' => $destination_id,
                "notified_type" => 'restaurant',
                'data' => $message2,
                'created_at' => Carbon::now()->toDateTimeString()
            ]);
        }
    }
}

