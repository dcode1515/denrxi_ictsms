<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       'firstname',
         'middle_initial',
         'lastname',
         'extension',
          'module_assign',
        'email',
        'contact_number',
        'position',
        'role',
        'password',
        'head_office_id',
        'office_id',
        'agree_and_terms_condition',
        'information_confirmed',
        'approval_status',
        'email_verified_at',
        'created_at',
        'updated_at',
      
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
       'email_verified_at' => 'datetime',
        'agree_and_terms_condition' => 'boolean',
        'information_confirmed' => 'boolean',
    ];
     public function headOffice()
    {
        return $this->belongsTo(HeadOffice::class, 'head_office_id');
    }
    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
     public function module_system()
    {
        return $this->belongsTo(SystemModule::class, 'module_assign');
    }
     public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

}
