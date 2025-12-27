<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class BaseModel extends Authenticatable
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();

        static::observe(\App\Observers\GlobalObserver::class);
    }
}
