<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Billing extends BaseModel
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'customer_uid_id',
         'company_id',
         'invoice_number',
         'date_from',
         'date_to',
         'generated_by',
         'generated_date',
         'municipality_fee',
         'total_bill',
         'note',
         'invoice_generated',
         'invoice_generated_by',
         'invoice_generated_date',
         'is_paid',
         'paid_date',
         'extra_charges',
         'discount',
         'gate_fee'
    ];
    
    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function customer_uid()
    {
        return $this->belongsTo(CustomerUid::class, 'customer_uid_id');
    }
    public function generated_by()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
    public function billing_detail()
    {
        return $this->hasMany(BillingDetail::class);
    }
    
    public function billing_municipality()
    {
        return $this->hasMany(BillingMunicipality::class);
    }
    
}