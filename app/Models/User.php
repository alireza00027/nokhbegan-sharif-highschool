<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'natural_id',
        'is_admin',
        'change_password',
        'grade',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    //relationShips
    public function exams() {
        return $this->hasMany(Exam::class, 'user_id');
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function financial() {
        return $this->belongsTo(Financial::class, 'financial_id');
    }
    public function schedules() {
        return $this->hasMany(Schedule::class, 'user_id');
    }
    //method
    public function getGadeText() {
        switch ($this->grade) {
            case 'seventh':
                return 'هفتم';
                break;
            case 'eighth':
                return 'هشتم';
                break;
            case 'ninth':
                return 'نهم';
                break;
            default:
                return 'معلم';
                break;
        }
    }

    public function hasRole($name) {
        $roles = $this->roles()->pluck('name')->toArray();
        return in_array($name, $roles);
    }
}
