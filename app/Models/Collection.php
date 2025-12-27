<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Collection extends BaseModel
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'customer_id',
        'customer_uid_id',
        'driver_id',
        'vehicle_id',
        'helper_ids',
        'before_image_guid',
        'after_image_guid',
        'status',
        'time_wasted',
        'signature_guid',
        'signatory_name',
        'pickup_date'
    ];
    
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
    
    public function collectionSkips()
    {
        return $this->hasMany(CollectionSkip::class);
    }
}