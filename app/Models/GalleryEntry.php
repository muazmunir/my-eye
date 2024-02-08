<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryEntry extends Model
{
    use HasFactory;

    protected $fillable = ['device_id', 'file_path', 'file_type'];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
