<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\FormatDates;

class AccessKey extends Model
{
    use HasFactory,FormatDates;
    
    protected $table = "access_keys";
    protected $fillable = [
        'token',
    ];
}
