<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    protected $table = 'user';
    protected $fillable = [
        'email',
        'nama',
        'password',
        'jabatan',
        'no_rekening',
        'bank',
        'ttd',
        'no_telp'
    ];
    public function role_has_user()
    {
        return $this->hasMany(Role_Has_User::class, 'fk_user', 'id');
    }
}
