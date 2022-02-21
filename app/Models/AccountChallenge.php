<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountChallenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'challenge_id',
        'points',
    ];
}
