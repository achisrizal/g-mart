<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $guard = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function sendPasswordResetNotification($token)
    {
      $this->notify(new AdminResetPasswordNotification($token));
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.password.reset-admin')->with(['token'=>$token, 'email'=>$request->email]);
    }
    public $remember_token=false;
}