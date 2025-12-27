<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Company extends BaseModel
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_name',
        'company_address',
        'contact_person_name',
        'contact_person_number',
        'is_deleted',
        'logo_guid',
        'stamp_image_guid',
        'invoice_contact_person',
        'invoice_phone_no',
        'tax_registration_number',
        'invoice_due_period',
        'invoice_number_format',
        'invoice_last_increment_number',
        'terms_n_conditions',
        'time_format'
    ];
}