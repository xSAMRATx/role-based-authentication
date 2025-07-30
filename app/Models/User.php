<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role)
    {
        return $this->role && $this->role->name === $role;
    }

    public function hasPermission($permission)
    {
        if (!$this->role)
            return false;

        if ($this->role->name === 'admin')
            return true;

        return $this->role->permissions->contains('name', $permission);
    }


    public function permissions()
    {
        return $this->role ? $this->role->permissions : collect();
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }
}
