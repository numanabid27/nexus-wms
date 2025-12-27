<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class BillingDetail extends BaseModel
{
    use HasApiTokens, HasFactory, Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'billing_id',
        'collection_id',
         'driver_id',
         'helper_ids',
         'total_price'
    ];
    // public function driver()
    // {
    //     return $this->belongsTo(User::class, 'driver_id');
    // }
    
    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }
    
    
    public function billing_detail_skip()
    {
        return $this->hasMany(BillingDetailSkip::class);
    }
    
    
    
   // Pseudo-relationship for helpers
    public function helpers()
    {
        // Note: uses FIND_IN_SET for comma-separated ids
        return $this->hasMany(User::class, 'id', 'helper_ids')
            ->whereRaw("FIND_IN_SET(users.id, billing_details.helper_ids)");
    }
    
    
    
}