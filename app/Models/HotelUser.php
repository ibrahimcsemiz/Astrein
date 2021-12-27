<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelUser extends Model
{
    use HasFactory;

    protected $table = 'hotel_user';

    protected $fillable = [
        'user_id',
        'hotel_id',
    ];

    public static function exists($user, $hotel, $type = '')
    {
        if ($type == ''){
            return self::where('user_id', $user)->where('hotel_id', $hotel)->count() > 0;
        } elseif ($type == 'idle') {
            return self::where('user_id', $user)->where('hotel_id', $hotel)->count() == 0;
        }

        return false;
    }
}
