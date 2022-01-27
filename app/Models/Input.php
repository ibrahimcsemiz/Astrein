<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_plan_id',
        'day',
        'value',
        'value_2',
    ];
}
