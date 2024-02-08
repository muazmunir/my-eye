<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'model'
    ];

    public function callLogs()
    {
        return $this->hasMany(CallLog::class);
    }

    public function messageLogs()
    {
        return $this->hasMany(MessageLog::class);
    }
}
