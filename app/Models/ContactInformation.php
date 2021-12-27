<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    use HasFactory;

    protected $table = 'contact_information';

    protected $fillable = [
        'telephone',
        'city',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
