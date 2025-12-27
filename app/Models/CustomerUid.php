<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CustomerUid extends BaseModel
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'location_name',
        'tag_uid',
        'skip_location'
    ];
    
    public function customer_skip()
    {
        return $this->hasMany(CustomerSkip::class);
    }
    
    public function customer() { 
        return $this->belongsTo(Customer::class); 
        
    }
    public function collections()
    {
        return $this->hasMany(Collection::class, 'customer_uid_id');
    }
}