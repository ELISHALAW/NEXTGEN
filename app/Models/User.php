<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// --- ADD THESE IMPORTS ---
use App\Notifications\ResetPasswordCustom;
use App\Notifications\VerifyEmailCustom; 
// -------------------------

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * This method tells Laravel to use your custom VerifyEmailCustom 
     * notification instead of the default one.
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailCustom());
    }

    /**
     * Since you have ResetPasswordCustom imported, 
     * you should also add this to make your custom password reset work!
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordCustom($token));
    }
}