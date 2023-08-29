<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role';
    public function role_has_user()
    {
        $this->hasOne(Role_Has_User::class, 'fk_role');
    }
}
