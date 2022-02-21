<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountAss extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id',
        'link_file',
        'assignment_id',
    ];
}
