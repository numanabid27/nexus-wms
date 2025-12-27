<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends BaseModel
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'company_name',
        'tax_registration_number',
        'client_id',
        'phone_no',
        'email',
        'mobile_no',
        // 'tag_uid',
        'address',
        'po_number',
        // 'skip_location',
        'billing_model',
        // 'waste_type',
        'schedule',
        // 'municipality_fee',
        'is_deleted',
        'skip_provided',
        'gate_fee'
    ];
    
    
    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
    
    public function customer_uid()
    {
        return $this->hasMany(CustomerUid::class);
    }
}