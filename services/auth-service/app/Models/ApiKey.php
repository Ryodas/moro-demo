<?php
// services/auth-service/app/Models/ApiKey.php
namespace App\Models;

use TanaryoCloud\Shared\Models\BaseModel;

class ApiKey extends BaseModel
{
    protected $fillable = [
        'key',
        'user_id',
        'plan',
        'is_active',
        'last_used_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_used_at' => 'datetime'
    ];
}
