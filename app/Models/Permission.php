<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'permission_admin';
    protected $primaryKey = 'kd_permission_admin';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kd_permission_admin',
        'tier',
        'permission',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'permission_id', 'id');
    }
}
