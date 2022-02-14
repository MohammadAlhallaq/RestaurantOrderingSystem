<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class verifyAccount extends Model
{
    use HasFactory;

    protected $fillable = ['account_id', 'token'];


    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
