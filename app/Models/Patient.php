<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\FormatDates;

class Patient extends Model
{
    use HasFactory,FormatDates;

    protected $table = "patients";
    protected $fillable = [
        'name',
        'id_type',
        'id_no',
        'gender',
        'dob',
        'address',
        'medium_acquisition'
    ];
}
