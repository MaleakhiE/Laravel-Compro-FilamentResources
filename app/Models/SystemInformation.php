<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'logo',
        'address',
        'phone',
        'email',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'whatsapp',
        'copyright',
    ];
}
